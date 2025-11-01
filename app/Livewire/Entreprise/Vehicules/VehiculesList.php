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
    public $viewMode = 'grid'; // 'grid' ou 'list'

    // Listeners
    protected $listeners = ['vehicule-created' => 'refreshVehicules'];

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

    public function refreshVehicules()
    {
        // Force le rafraîchissement de la liste
        $this->render();
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

        // Filtre par statut (basé sur date_prochaine_visite)
        if ($this->statusFilter) {
            switch ($this->statusFilter) {
                case 'urgent':
                    // Véhicules dont la date de prochaine visite est dépassée
                    $query->whereNotNull('date_prochaine_visite')
                          ->where('date_prochaine_visite', '<', now());
                    break;
                case 'warning':
                    // Véhicules dont la date est dans les 7 prochains jours
                    $query->whereNotNull('date_prochaine_visite')
                          ->whereBetween('date_prochaine_visite', [now(), now()->addDays(7)]);
                    break;
                case 'good':
                    // Véhicules à jour (date > 7 jours)
                    $query->whereNotNull('date_prochaine_visite')
                          ->where('date_prochaine_visite', '>', now()->addDays(7));
                    break;
            }
        }

        return $query->paginate(12);
    }

    public function getStatsProperty()
    {
        $totalVehicules = auth('entreprise')->user()->vehicules()->count();

        $urgent = auth('entreprise')->user()->vehicules()
            ->whereNotNull('date_prochaine_visite')
            ->where('date_prochaine_visite', '<', now())
            ->count();

        $aSurveiller = auth('entreprise')->user()->vehicules()
            ->whereNotNull('date_prochaine_visite')
            ->whereBetween('date_prochaine_visite', [now(), now()->addDays(7)])
            ->count();

        $aJour = auth('entreprise')->user()->vehicules()
            ->whereNotNull('date_prochaine_visite')
            ->where('date_prochaine_visite', '>', now()->addDays(7))
            ->count();

        return [
            'total' => $totalVehicules,
            'urgent' => $urgent,
            'a_surveiller' => $aSurveiller,
            'a_jour' => $aJour,
        ];
    }

    public function getMarquesProperty()
    {
        // Liste des marques disponibles dans les véhicules de l'entreprise
        return auth('entreprise')->user()->vehicules()
            ->select('marque')
            ->distinct()
            ->pluck('marque')
            ->filter()
            ->toArray();
    }

    public function getVehiculeStatus($vehicule)
    {
        if (!$vehicule->date_prochaine_visite) {
            return 'unknown';
        }

        $dateProchaine = \Carbon\Carbon::parse($vehicule->date_prochaine_visite);

        if ($dateProchaine->isPast()) {
            return 'urgent';
        } elseif ($dateProchaine->diffInDays(now()) <= 7) {
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
        if (!$vehicule->date_prochaine_visite) {
            return ['text' => 'Date de visite non définie', 'class' => 'text-slate-400'];
        }

        $dateProchaine = \Carbon\Carbon::parse($vehicule->date_prochaine_visite);
        $status = $this->getVehiculeStatus($vehicule);

        if ($status === 'urgent') {
            $retard = $dateProchaine->diffInDays(now());
            return [
                'text' => "Maintenance dépassée de {$retard} jour(s)",
                'class' => 'text-red-400'
            ];
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
