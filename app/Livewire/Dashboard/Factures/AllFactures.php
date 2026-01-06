<?php

namespace App\Livewire\Dashboard\Factures;

use App\Livewire\UtilsSweetAlert;
use App\Models\Facture;
use App\Models\Entreprise;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AllFactures extends Component
{
    use UtilsSweetAlert, WithPagination;

    // Filters
    public $search = '';
    public $entrepriseFilter = '';
    public $statusFilter = '';
    public $dateFilter = '';

    // Modal
    public $showDetailsModal = false;
    public $selectedFacture = null;

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

    public function getFacturesProperty()
    {
        $query = Facture::with(['entreprise', 'entretien', 'contrat'])->latest('date_emission');

        // Filtre par recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('ref', 'like', '%' . $this->search . '%')
                  ->orWhereHas('entreprise', function($sq) {
                      $sq->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Filtre par entreprise
        if ($this->entrepriseFilter) {
            $query->where('entreprise_id', $this->entrepriseFilter);
        }

        // Filtre par statut
        if ($this->statusFilter) {
            $query->where('status_paiement', $this->statusFilter);
        }

        // Filtre par date
        if ($this->dateFilter) {
            switch ($this->dateFilter) {
                case 'today':
                    $query->whereDate('date_emission', today());
                    break;
                case 'week':
                    $query->whereBetween('date_emission', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('date_emission', now()->month)
                          ->whereYear('date_emission', now()->year);
                    break;
                case 'overdue':
                    $query->where('date_echeance', '<', today())
                          ->where('status_paiement', Facture::PENDING);
                    break;
            }
        }

        return $query->paginate(15);
    }

    public function getStatsProperty()
    {
        return [
            'total' => Facture::count(),
            'en_attente' => Facture::where('status_paiement', Facture::PENDING)->count(),
            'payees' => Facture::where('status_paiement', Facture::PAID)->count(),
            'en_retard' => Facture::where('date_echeance', '<', today())
                ->where('status_paiement', Facture::PENDING)
                ->count(),
            'montant_total' => Facture::where('status_paiement', Facture::PENDING)->sum('montant_ttc'),
        ];
    }

    public function getEntreprisesProperty()
    {
        return Entreprise::orderBy('name')->get();
    }

    public function openDetailsModal($factureId)
    {
        $this->selectedFacture = Facture::with(['entreprise', 'entretien', 'contrat'])
            ->findOrFail($factureId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedFacture = null;
    }

    public function goToEntreprise($entrepriseId)
    {
        $entreprise = Entreprise::findOrFail($entrepriseId);
        return redirect()->route('dashboard.entreprise.show', $entreprise->slug);
    }

    public function marquerPayee($factureId)
    {
        $facture = Facture::findOrFail($factureId);
        $facture->update([
            'status_paiement' => Facture::PAID,
            'date_paiement' => now(),
        ]);

        $this->send_event_at_toast('Facture marquée comme payée', 'success', 'top-end');

        if ($this->selectedFacture && $this->selectedFacture->id === $factureId) {
            $this->selectedFacture = $facture->fresh(['entreprise', 'entretien', 'contrat']);
        }
    }

    public function downloadFacture($factureId)
    {
        // TODO: Implémenter le téléchargement PDF
        $this->send_event_at_toast('Génération du PDF en cours...', 'info', 'top-end');
    }

    public function exportFactures()
    {
        $this->send_event_at_toast('Export en cours de développement', 'info', 'top-end');
    }

    public function render()
    {
        return view('livewire.dashboard.factures.all-factures', [
            'factures' => $this->factures,
            'stats' => $this->stats,
            'entreprises' => $this->entreprises,
        ])->layout('layouts.app');
    }
}
