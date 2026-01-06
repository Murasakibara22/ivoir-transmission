<?php

namespace App\Livewire\Entreprise\Vehicules;

use App\Livewire\UtilsSweetAlert;
use Livewire\Component;
use Livewire\WithPagination;

class VehiculesList extends Component
{
    use UtilsSweetAlert, WithPagination;

    // Filters
    public $search = '';
    public $statusFilter = '';
    public $marqueFilter = '';
    public $viewMode = 'grid';

    // Modals
    public $showDetailModal = false;
    public $showHistoriqueModal = false;
    public $selectedVehicule = null;

    public function mount()
    {
        // Initialisation
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingMarqueFilter()
    {
        $this->resetPage();
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }

    public function showDetails($vehiculeId)
    {
        $this->selectedVehicule = auth('entreprise')->user()->vehicules()->find($vehiculeId);
        $this->showDetailModal = true;
    }

    public function showHistorique($vehiculeId)
    {
        $this->selectedVehicule = auth('entreprise')->user()->vehicules()
            ->with(['historique_entretiens' => function($query) {
                $query->orderBy('date_entretient', 'desc');
            }])
            ->find($vehiculeId);
        $this->showHistoriqueModal = true;
    }

    public function closeModals()
    {
        $this->showDetailModal = false;
        $this->showHistoriqueModal = false;
        $this->selectedVehicule = null;
    }

    public function getVehiculesProperty()
    {
        $query = auth('entreprise')->user()->vehicules()
            ->orderBy('created_at', 'desc');

        // Filtre par recherche
        if ($this->search) {
            $query->where(function($q) {
                $q->where('matricule', 'like', '%' . $this->search . '%')
                  ->orWhere('marque', 'like', '%' . $this->search . '%')
                  ->orWhere('modele', 'like', '%' . $this->search . '%')
                  ->orWhere('libelle', 'like', '%' . $this->search . '%');
            });
        }

        // Filtre par marque
        if ($this->marqueFilter) {
            $query->where('marque', $this->marqueFilter);
        }

        // Filtre par statut (basé sur historique_entretients)
        if ($this->statusFilter) {
            $query->whereHas('historique_entretiens', function($q) {
                switch ($this->statusFilter) {
                    case 'urgent':
                        $q->whereNotNull('prochain_entretien_date')
                          ->where('prochain_entretien_date', '<=', now()->addDays(5));
                        break;
                    case 'warning':
                        $q->whereNotNull('prochain_entretien_date')
                          ->whereBetween('prochain_entretien_date', [now()->addDays(6), now()->addDays(14)]);
                        break;
                    case 'good':
                        $q->whereNotNull('prochain_entretien_date')
                          ->where('prochain_entretien_date', '>', now()->addDays(14));
                        break;
                }
            });
        }

        return $query->paginate(12);
    }

    public function getStatsProperty()
    {
        $entrepriseId = auth('entreprise')->user()->id;

        $totalVehicules = auth('entreprise')->user()->vehicules()->count();

        // Urgent: maintenance dans les 5 prochains jours
        $urgent = \DB::table('historique_entretients as he')
            ->join('vehicules as v', 'he.vehicule_id', '=', 'v.id')
            ->where('v.entreprise_id', $entrepriseId)
            ->whereNotNull('he.prochain_entretien_date')
            ->where('he.prochain_entretien_date', '<=', now()->addDays(5))
            ->distinct('v.id')
            ->count('v.id');

        // À surveiller: maintenance entre 6 et 14 jours
        $aSurveiller = \DB::table('historique_entretients as he')
            ->join('vehicules as v', 'he.vehicule_id', '=', 'v.id')
            ->where('v.entreprise_id', $entrepriseId)
            ->whereNotNull('he.prochain_entretien_date')
            ->whereBetween('he.prochain_entretien_date', [now()->addDays(6), now()->addDays(14)])
            ->distinct('v.id')
            ->count('v.id');

        // À jour: maintenance dans plus de 14 jours
        $aJour = \DB::table('historique_entretients as he')
            ->join('vehicules as v', 'he.vehicule_id', '=', 'v.id')
            ->where('v.entreprise_id', $entrepriseId)
            ->whereNotNull('he.prochain_entretien_date')
            ->where('he.prochain_entretien_date', '>', now()->addDays(14))
            ->distinct('v.id')
            ->count('v.id');

        return [
            'total' => $totalVehicules,
            'urgent' => $urgent,
            'a_surveiller' => $aSurveiller,
            'a_jour' => $aJour,
        ];
    }

    public function getMarquesProperty()
    {
        return auth('entreprise')->user()->vehicules()
            ->select('marque')
            ->distinct()
            ->pluck('marque')
            ->filter()
            ->toArray();
    }

    public function getVehiculeStatus($vehicule)
    {
        // Récupérer le dernier historique d'entretien avec une date de prochain entretien
        $dernierEntretien = $vehicule->historique_entretiens()
            ->whereNotNull('prochain_entretien_date')
            ->orderBy('date_entretient', 'desc')
            ->first();

        if (!$dernierEntretien || !$dernierEntretien->prochain_entretien_date) {
            return 'unknown';
        }

        $dateProchaine = \Carbon\Carbon::parse($dernierEntretien->prochain_entretien_date);
        $joursRestants = now()->diffInDays($dateProchaine, false);

        if ($joursRestants < 0 || $joursRestants <= 5) {
            return 'urgent';
        } elseif ($joursRestants <= 14) {
            return 'warning';
        } else {
            return 'good';
        }
    }

    public function getStatusBadgeClass($status)
    {
        return match($status) {
            'urgent' => 'status-badge status-urgent',
            'warning' => 'status-badge status-warning',
            'good' => 'status-badge status-success',
            default => 'status-badge bg-slate-500/10 border-slate-500/20 text-slate-400',
        };
    }

    public function getStatusLabel($status)
    {
        return match($status) {
            'urgent' => 'Urgent',
            'warning' => 'Bientôt',
            'good' => 'À jour',
            default => 'Non défini',
        };
    }

    public function getStatusMessage($vehicule)
    {
        $dernierEntretien = $vehicule->historique_entretiens()
            ->whereNotNull('prochain_entretien_date')
            ->orderBy('date_entretient', 'desc')
            ->first();

        if (!$dernierEntretien || !$dernierEntretien->prochain_entretien_date) {
            return ['text' => 'Date de visite non définie', 'class' => 'text-slate-400'];
        }

        $dateProchaine = \Carbon\Carbon::parse($dernierEntretien->prochain_entretien_date);
        $status = $this->getVehiculeStatus($vehicule);

        if ($status === 'urgent') {
            if ($dateProchaine->isPast()) {
                $retard = $dateProchaine->diffInDays(now());
                return [
                    'text' => "Maintenance dépassée de {$retard} jour(s)",
                    'class' => 'text-red-400'
                ];
            } else {
                $jours = now()->diffInDays($dateProchaine);
                return [
                    'text' => "Maintenance dans {$jours} jour(s)",
                    'class' => 'text-red-400'
                ];
            }
        } elseif ($status === 'warning') {
            $jours = now()->diffInDays($dateProchaine);
            return [
                'text' => "Maintenance dans {$jours} jour(s)",
                'class' => 'text-orange-400'
            ];
        } else {
            return [
                'text' => "Prochaine: " . $dateProchaine->format('d M Y'),
                'class' => 'text-green-400'
            ];
        }
    }

    public function render()
    {
        return view('livewire.entreprise.vehicules.vehicules-list', [
            'vehicules' => $this->vehicules,
            'stats' => $this->stats,
            'marques' => $this->marques,
        ]);
    }
}
