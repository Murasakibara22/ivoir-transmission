<?php

namespace App\Livewire\Dashboard\Vehicules;

use App\Livewire\UtilsSweetAlert;
use App\Models\Vehicule;
use App\Models\Entreprise;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AllVehicules extends Component
{
    use UtilsSweetAlert, WithPagination;

    // Filters
    public $search = '';
    public $entrepriseFilter = '';
    public $marqueFilter = '';
    public $statusFilter = '';

    // Modal
    public $showDetailsModal = false;
    public $selectedVehicule = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingEntrepriseFilter()
    {
        $this->resetPage();
    }

    public function updatingMarqueFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function getVehiculesProperty()
    {
        $query = Vehicule::with('entreprise')->latest();

        // Filtre par recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('matricule', 'like', '%' . $this->search . '%')
                  ->orWhere('marque', 'like', '%' . $this->search . '%')
                  ->orWhere('modele', 'like', '%' . $this->search . '%')
                  ->orWhere('libelle', 'like', '%' . $this->search . '%')
                  ->orWhere('chassis', 'like', '%' . $this->search . '%');
            });
        }

        // Filtre par entreprise
        if ($this->entrepriseFilter) {
            $query->where('entreprise_id', $this->entrepriseFilter);
        }

        // Filtre par marque
        if ($this->marqueFilter) {
            $query->where('marque', $this->marqueFilter);
        }

        // Filtre par statut
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return $query->paginate(15);
    }

    public function getStatsProperty()
    {
        return [
            'total' => Vehicule::count(),
            'actifs' => Vehicule::where('status', 'ACTIVATED')->count(),
            'inactifs' => Vehicule::where('status', 'INACTIVATED')->count(),
            'marques' => Vehicule::distinct('marque')->count('marque'),
        ];
    }

    public function getEntreprisesProperty()
    {
        return Entreprise::orderBy('name')->get();
    }

    public function getMarquesProperty()
    {
        return Vehicule::select('marque')
            ->distinct()
            ->orderBy('marque')
            ->pluck('marque')
            ->filter();
    }

    public function openDetailsModal($vehiculeId)
    {
        $this->selectedVehicule = Vehicule::with(['entreprise', 'historique_entretiens'])
            ->findOrFail($vehiculeId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedVehicule = null;
    }

    public function goToEntreprise($entrepriseId)
    {
        $entreprise = Entreprise::findOrFail($entrepriseId);
        return redirect()->route('dashboard.entreprise.show', $entreprise->slug);
    }

    #[On('vehicule-deleted')]
    public function handleVehiculeDeleted()
    {
        $this->send_event_at_toast('Véhicule supprimé avec succès', 'success', 'top-end');
    }

    public function exportVehicules()
    {
        // TODO: Implémenter l'export Excel/PDF
        $this->send_event_at_toast('Export en cours de développement', 'info', 'top-end');
    }

    public function render()
    {
        return view('livewire.dashboard.vehicules.all-vehicules', [
            'vehicules' => $this->vehicules,
            'stats' => $this->stats,
            'entreprises' => $this->entreprises,
            'marques' => $this->marques,
        ])->layout('layouts.app');
    }
}
