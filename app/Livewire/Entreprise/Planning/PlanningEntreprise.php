<?php

namespace App\Livewire\Entreprise\Planning;

use App\Livewire\UtilsSweetAlert;
use App\Models\Entretien;
use App\Models\HistoriqueEntretient;
use App\Models\Vehicule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PlanningEntreprise extends Component
{
    use UtilsSweetAlert, WithPagination;

    // Filters
    public $vehiculeFilter = '';
    public $statusFilter = '';
    public $typeFilter = '';

    // View mode
    public $viewMode = 'calendar'; // 'calendar' or 'list'

    // Calendar
    public $currentMonth;
    public $currentYear;

    // Modal
    public $showDetailsModal = false;
    public $selectedHistorique = null;

    public function mount()
    {
        if (!Auth::guard('entreprise')->check()) {
            return redirect()->route('entreprise.login');
        }

        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    public function updatingVehiculeFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingTypeFilter()
    {
        $this->resetPage();
    }

    public function switchView($mode)
    {
        $this->viewMode = $mode;
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
    }

    public function goToToday()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    public function getStatsProperty()
    {
        $entreprise = Auth::guard('entreprise')->user();

        if ($this->viewMode === 'calendar') {
            // Stats du mois courant pour le calendrier
            $currentMonth = Carbon::create($this->currentYear, $this->currentMonth);
            $historiques = HistoriqueEntretient::where('entreprise_id', $entreprise->id)
                ->whereMonth('date_entretient', $currentMonth->month)
                ->whereYear('date_entretient', $currentMonth->year)
                ->get();
        } else {
            // Stats globales pour la liste
            $historiques = HistoriqueEntretient::where('entreprise_id', $entreprise->id)->get();
        }

        return [
            'total_mois' => $historiques->count(),
            'en_attente' => $historiques->where('status', HistoriqueEntretient::PENDING)->count(),
            'en_cours' => $historiques->where('status', HistoriqueEntretient::IN_PROGRESS)->count(),
            'termines' => $historiques->where('status', HistoriqueEntretient::DONE)->count(),
        ];
    }

    public function getVehiculesProperty()
    {
        $entreprise = Auth::guard('entreprise')->user();
        return Vehicule::where('entreprise_id', $entreprise->id)->get();
    }

    public function getHistoriquesProperty()
    {
        $entreprise = Auth::guard('entreprise')->user();

        $query = HistoriqueEntretient::where('entreprise_id', $entreprise->id)
            ->with(['vehicule', 'entretien', 'contrat']);

        // EN MODE CALENDRIER : uniquement le mois courant
        if ($this->viewMode === 'calendar') {
            $query->whereMonth('date_entretient', $this->currentMonth)
                ->whereYear('date_entretient', $this->currentYear);
        }
        // EN MODE LISTE : tous les entretiens (tri par date)

        // Filters
        if ($this->vehiculeFilter) {
            $query->where('vehicule_id', $this->vehiculeFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->typeFilter) {
            $query->where('type_entretient', 'like', '%' . $this->typeFilter . '%');
        }

        return $query->orderBy('date_entretient', $this->viewMode === 'list' ? 'desc' : 'asc')->get();
    }

    public function getCalendarDataProperty()
    {
        $firstDay = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $lastDay = $firstDay->copy()->endOfMonth();

        // Jour de la semaine du premier jour (1 = Lundi, 7 = Dimanche)
        $startDayOfWeek = $firstDay->dayOfWeekIso;

        // Jours du mois précédent à afficher
        $previousMonth = $firstDay->copy()->subMonth();
        $daysInPreviousMonth = $previousMonth->daysInMonth;
        $previousMonthDays = [];
        for ($i = $startDayOfWeek - 1; $i > 0; $i--) {
            $previousMonthDays[] = [
                'day' => $daysInPreviousMonth - $i + 1,
                'isCurrentMonth' => false,
                'date' => $previousMonth->copy()->day($daysInPreviousMonth - $i + 1),
                'events' => []
            ];
        }

        // Jours du mois courant
        $currentMonthDays = [];
        $historiques = $this->historiques;

        for ($day = 1; $day <= $lastDay->day; $day++) {
            $date = Carbon::create($this->currentYear, $this->currentMonth, $day);
            $dayHistoriques = $historiques->filter(function($h) use ($date) {
                return Carbon::parse($h->date_entretient)->isSameDay($date);
            });

            $currentMonthDays[] = [
                'day' => $day,
                'isCurrentMonth' => true,
                'isToday' => $date->isToday(),
                'date' => $date,
                'events' => $dayHistoriques
            ];
        }

        // Jours du mois suivant
        $totalDays = count($previousMonthDays) + count($currentMonthDays);
        $remainingDays = (7 - ($totalDays % 7)) % 7;
        $nextMonthDays = [];
        for ($i = 1; $i <= $remainingDays; $i++) {
            $nextMonthDays[] = [
                'day' => $i,
                'isCurrentMonth' => false,
                'date' => $firstDay->copy()->addMonth()->day($i),
                'events' => []
            ];
        }

        return array_merge($previousMonthDays, $currentMonthDays, $nextMonthDays);
    }

    public function openDetailsModal($historiqueId)
    {
        $this->selectedHistorique = HistoriqueEntretient::with([
            'vehicule',
            'entretien.contrat',
            'entretien.historique_entretiens.vehicule',
            'contrat'
        ])->findOrFail($historiqueId);

        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedHistorique = null;
    }

    public function exportPlanning()
    {
        $this->send_event_at_toast('Export en cours de développement', 'info', 'top-end');
    }

    public function getStatusClass($status)
    {
        return match($status) {
            HistoriqueEntretient::PENDING => 'event-attente',
            HistoriqueEntretient::IN_PROGRESS => 'event-urgent',
            HistoriqueEntretient::DONE => 'event-confirme',
            default => 'event-attente'
        };
    }

    public function getStatusBadge($status)
    {
        return match($status) {
            HistoriqueEntretient::PENDING => 'status-warning',
            HistoriqueEntretient::IN_PROGRESS => 'status-urgent',
            HistoriqueEntretient::DONE => 'status-success',
            default => 'status-warning'
        };
    }

    public function getStatusLabel($status)
    {
        return match($status) {
            HistoriqueEntretient::PENDING => 'En attente',
            HistoriqueEntretient::IN_PROGRESS => 'En cours',
            HistoriqueEntretient::DONE => 'Terminé',
            HistoriqueEntretient::CANCELLED => 'Annulé',
            default => 'En attente'
        };
    }

    public function render()
    {
        return view('livewire.entreprise.planning.planning-entreprise', [
            'stats' => $this->stats,
            'vehicules' => $this->vehicules,
            'historiques' => $this->historiques,
            'calendarData' => $this->calendarData,
        ]);
    }
}
