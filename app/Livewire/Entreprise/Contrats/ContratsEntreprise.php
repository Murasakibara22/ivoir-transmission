<?php

namespace App\Livewire\Entreprise\Contrats;

use App\Livewire\UtilsSweetAlert;
use App\Models\Contrat;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

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

        $this->closeConfirmModal();
        $this->send_event_at_toast('Contrat confirmé avec succès', 'success', 'top-end');
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
