<?php

namespace App\Livewire\Dashboard\Entretiens;

use App\Livewire\UtilsSweetAlert;
use App\Models\Entretien;
use App\Models\Entreprise;
use App\Models\HistoriqueEntretient;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AllEntretiens extends Component
{
    use UtilsSweetAlert, WithPagination;

    // Filters
    public $search = '';
    public $entrepriseFilter = '';
    public $statusFilter = '';
    public $dateFilter = '';

    // Modal
    public $showDetailsModal = false;
    public $selectedEntretien = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingEntrepriseFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function getEntretiensProperty()
    {
        $query = Entretien::with(['entreprise', 'contrat'])->latest('date_prevue');

        // Filtre par recherche
        if ($this->search) {
            $query->whereHas('entreprise', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('contrat', function($q) {
                $q->where('libelle', 'like', '%' . $this->search . '%');
            });
        }

        // Filtre par entreprise
        if ($this->entrepriseFilter) {
            $query->where('entreprise_id', $this->entrepriseFilter);
        }

        // Filtre par statut
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        // Filtre par date
        if ($this->dateFilter) {
            switch ($this->dateFilter) {
                case 'today':
                    $query->whereDate('date_prevue', today());
                    break;
                case 'week':
                    $query->whereBetween('date_prevue', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('date_prevue', now()->month)
                          ->whereYear('date_prevue', now()->year);
                    break;
                case 'overdue':
                    $query->where('date_prevue', '<', today())
                          ->whereNotIn('status', [Entretien::COMPLETED, Entretien::CANCELLED]);
                    break;
            }
        }

        return $query->paginate(15);
    }

    public function getStatsProperty()
    {
        return [
            'total' => Entretien::count(),
            'en_attente' => Entretien::where('status', Entretien::PENDING)->count(),
            'en_cours' => Entretien::where('status', Entretien::IN_PROGRESS)->count(),
            'termines' => Entretien::where('status', Entretien::COMPLETED)->count(),
            'en_retard' => Entretien::where('date_prevue', '<', today())
                ->whereNotIn('status', [Entretien::COMPLETED, Entretien::CANCELLED])
                ->count(),
        ];
    }

    public function getEntreprisesProperty()
    {
        return Entreprise::orderBy('name')->get();
    }

    public function openDetailsModal($entretienId)
    {
        $this->selectedEntretien = Entretien::with(['entreprise', 'contrat', 'historique_entretiens.vehicule'])
            ->findOrFail($entretienId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedEntretien = null;
    }

    public function goToEntreprise($entrepriseId)
    {
       $entreprise = Entreprise::findOrFail($entrepriseId);
        return redirect()->route('dashboard.entreprise.show', $entreprise->slug);
    }

    public function marquerVehiculeTermine($historiqueId)
    {
        $historique = HistoriqueEntretient::findOrFail($historiqueId);
        $historique->update(['status' => HistoriqueEntretient::DONE]);

        $entretien = $historique->entretien;
        $entretien->increment('nombre_vehicules_fait');
        $entretien->decrement('nombre_vehicules_restant');

        if($entretien->status === Entretien::PENDING) {
            $entretien->update(['status' => Entretien::IN_PROGRESS]);
        }

        $this->send_event_at_toast('Véhicule marqué comme terminé', 'success', 'top-end');

        // Recharger l'entretien
        if ($this->selectedEntretien && $this->selectedEntretien->id === $entretien->id) {
            $this->selectedEntretien = $entretien->fresh(['entreprise', 'contrat', 'historique_entretiens.vehicule']);
        }
    }

    public function exportEntretiens()
    {
        $this->send_event_at_toast('Export en cours de développement', 'info', 'top-end');
    }

    public function render()
    {
        return view('livewire.dashboard.entretiens.all-entretiens', [
            'entretiens' => $this->entretiens,
            'stats' => $this->stats,
            'entreprises' => $this->entreprises,
        ])->layout('layouts.app');
    }
}
