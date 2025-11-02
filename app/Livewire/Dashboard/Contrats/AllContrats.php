<?php

namespace App\Livewire\Dashboard\Contrats;

use App\Livewire\UtilsSweetAlert;
use App\Models\Contrat;
use App\Models\Entreprise;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AllContrats extends Component
{
    use UtilsSweetAlert, WithPagination;

    // Filters
    public $search = '';
    public $entrepriseFilter = '';
    public $statusFilter = '';
    public $frequenceFilter = '';

    // Modal
    public $showDetailsModal = false;
    public $selectedContrat = null;

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

    public function updatingFrequenceFilter()
    {
        $this->resetPage();
    }

    public function getContratsProperty()
    {
        $query = Contrat::with('entreprise')->latest();

        // Filtre par recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('libelle', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
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

        // Filtre par fréquence
        if ($this->frequenceFilter) {
            $query->where('frequence_entretien', $this->frequenceFilter);
        }

        return $query->paginate(15);
    }

    public function getStatsProperty()
    {
        return [
            'total' => Contrat::count(),
            'actifs' => Contrat::where('status', Contrat::ACTIVATED)->count(),
            'en_attente' => Contrat::where('status', Contrat::PENDING)->count(),
            'expires' => Contrat::where('status', Contrat::EXPIRED)->count(),
        ];
    }

    public function getEntreprisesProperty()
    {
        return Entreprise::orderBy('name')->get();
    }

    public function openDetailsModal($contratId)
    {
        $this->selectedContrat = Contrat::with(['entreprise', 'entretiens'])
            ->findOrFail($contratId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedContrat = null;
    }

    public function goToEntreprise($entrepriseId)
    {
        $entreprise = Entreprise::findOrFail($entrepriseId);
        return redirect()->route('dashboard.entreprise.show', $entreprise->slug);
    }

    public function activerContrat($contratId)
    {
        $contrat = Contrat::findOrFail($contratId);
        $contrat->update([
            'status' => Contrat::ACTIVATED,
            'garage_validated_at' => now(),
        ]);

        $this->send_event_at_toast('Contrat activé avec succès', 'success', 'top-end');

        if ($this->selectedContrat && $this->selectedContrat->id === $contratId) {
            $this->selectedContrat = $contrat->fresh();
        }
    }

    public function exportContrats()
    {
        $this->send_event_at_toast('Export en cours de développement', 'info', 'top-end');
    }

    public function render()
    {
        return view('livewire.dashboard.contrats.all-contrats', [
            'contrats' => $this->contrats,
            'stats' => $this->stats,
            'entreprises' => $this->entreprises,
        ])->layout('layouts.app');
    }
}
