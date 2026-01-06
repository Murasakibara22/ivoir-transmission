<?php

namespace App\Livewire\Entreprise\Contrats;

use App\Models\Role;
use App\Models\User;
use App\Models\Contrat;
use Livewire\Component;
use App\Models\Entretien;
use App\Events\MessageSend;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;

use App\Mail\ContratConfirmed;
use App\Livewire\UtilsSweetAlert;
use App\Models\NotificationAdmin;
use App\Models\HistoriqueEntretient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContratsEntreprise extends Component
{
    use UtilsSweetAlert, WithPagination;

    // Filters
    public $statusFilter = '';
    public $search = '';

    // Modal
    public $showDetailsModal = false;
    public $selectedContrat = null;
    public $showConfirmModal = false;
    public $contratToConfirm = null;
    public $confirmation_note = '';

    public function mount()
    {
        // Vérifier que l'utilisateur est bien une entreprise
        if (!Auth::guard('entreprise')->check()) {
            return redirect()->route('entreprise.login');
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function getContratsProperty()
    {
        $entreprise = Auth::guard('entreprise')->user();

        $query = Contrat::where('entreprise_id', $entreprise->id)
            ->with(['entretiens'])
            ->latest();

        // Filtre par recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('libelle', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filtre par statut
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return $query->paginate(10);
    }

    public function getStatsProperty()
    {
        $entreprise = Auth::guard('entreprise')->user();

        return [
            'total' => Contrat::where('entreprise_id', $entreprise->id)->count(),
            'actifs' => Contrat::where('entreprise_id', $entreprise->id)
                ->where('status', Contrat::ACTIVATED)->count(),
            'en_attente' => Contrat::where('entreprise_id', $entreprise->id)
                ->where('status', Contrat::PENDING)->count(),
            'expires' => Contrat::where('entreprise_id', $entreprise->id)
                ->where('status', Contrat::EXPIRED)->count(),
        ];
    }

    public function openDetailsModal($contratId)
    {
        $this->selectedContrat = Contrat::with(['entretiens', 'factures'])
            ->findOrFail($contratId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedContrat = null;
    }

    public function openConfirmModal($contratId)
    {
        $this->contratToConfirm = Contrat::findOrFail($contratId);
        $this->showConfirmModal = true;
        $this->confirmation_note = '';
    }

    public function closeConfirmModal()
    {
        $this->showConfirmModal = false;
        $this->contratToConfirm = null;
        $this->confirmation_note = '';
    }

    public function confirmerContrat()
    {
        $this->validate([
            'confirmation_note' => 'nullable|string|max:500',
        ]);

        $this->contratToConfirm->update([
            'status' => Contrat::ACTIVATED,
            'entreprise_validated_at' => now(),
            'entreprise_validation_note' => $this->confirmation_note,
        ]);

        $this->creerPremierEntretien($this->contratToConfirm);

        // 📧 Envoi du mail à tous les Super Admins
        $superAdmins = User::where('role_id', '!=', Role::where('libelle', 'Utilisateur')->first()->id)->get();
        
        foreach ($superAdmins as $admin) {
            try {
                Mail::to($admin->email)->send(new ContratConfirmed($this->contratToConfirm));
            } catch (\Exception $e) {
                \Log::error('Erreur envoi email contrat confirmé: ' . $e->getMessage());
            }
        }

        // 🔔 Notification aux admins (comme pour les réservations)
        $message = "L'entreprise " . $this->contratToConfirm->entreprise->name . 
                " vient de confirmer le contrat '" . $this->contratToConfirm->libelle . 
                "' pour " . $this->contratToConfirm->nombre_vehicules . " véhicules";
        
        NotificationAdmin::create([
            'title' => 'Nouveau contrat confirmé',
            'subtitle' => $message,
            'type' => 'contrat',
            'meta_data_id' => $this->contratToConfirm->slug,
            'meta_data_type' => Contrat::class,
        ]);

        // 📡 Broadcast en temps réel aux admins
        $superAdmins->each(function ($admin) use ($message) {
            broadcast(new MessageSend($admin->id, $message, $this->contratToConfirm->slug));
        });

        $this->closeConfirmModal();
        $this->send_event_at_toast('Contrat confirmé avec succès', 'success', 'top-end');
    }


    private function creerPremierEntretien($contrat)
    {
        $entretien = Entretien::create([
            'contrat_id' => $contrat->id,
            'entreprise_id' => $contrat->entreprise_id,
            'date_prevue' => $contrat->date_premier_entretien,
            'numero_entretien' => 1,
            'nombre_vehicules_total' => $contrat->nombre_vehicules,
            'nombre_vehicules_fait' => 0,
            'nombre_vehicules_restant' => $contrat->nombre_vehicules,
            'cout_prevu' => $contrat->montant_entretien,
            'status' => Entretien::PENDING,
            'slug' => Str::random(10) . uniqid(),
        ]);

        // Créer un historique pour chaque véhicule
        $vehicules = Auth::guard('entreprise')->user()->vehicules()->limit($contrat->nombre_vehicules)->get();

        foreach ($vehicules as $vehicule) {
            HistoriqueEntretient::create([
                'vehicule_id' => $vehicule->id,
                'entreprise_id' => $contrat->entreprise_id,
                'entretien_id' => $entretien->id,
                'contrat_id' => $contrat->id,
                'type_entretient' => 'Entretien contractuel',
                'date_entretient' => $contrat->date_premier_entretien,
                'status' => HistoriqueEntretient::PENDING,
                'slug' => Str::random(10) . uniqid(),
            ]);
        }
    }

    public function refuserContrat()
    {
        $this->validate([
            'confirmation_note' => 'required|string|max:500',
        ], [
            'confirmation_note.required' => 'Veuillez indiquer la raison du refus'
        ]);

        $this->contratToConfirm->update([
            'status' => Contrat::CANCELLED,
            'entreprise_refused_at' => now(),
            'entreprise_refusal_reason' => $this->confirmation_note,
        ]);

        $this->closeConfirmModal();
        $this->send_event_at_toast('Contrat refusé', 'info', 'top-end');
    }

    public function downloadContrat($contratId)
    {
        // TODO: Implémenter le téléchargement PDF du contrat
        $this->send_event_at_toast('Génération du PDF en cours...', 'info', 'top-end');
    }

    public function render()
    {
        return view('livewire.entreprise.contrats.contrats-entreprise', [
            'contrats' => $this->contrats,
            'stats' => $this->stats,
        ])->layout('layouts.entreprise');
    }
}
