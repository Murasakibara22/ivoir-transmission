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
    public $statusFilter = '';
    public $contratFilter = '';

    // View mode
    public $viewMode = 'calendar';

    // Calendar
    public $currentMonth;
    public $currentYear;

    // Modal
    public $showDetailsModal = false;
    public $selectedEntretien = null;

    public function mount()
    {
        if (!Auth::guard('entreprise')->check()) {
            return redirect()->route('entreprise.login');
        }

        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingContratFilter()
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
            $currentMonth = Carbon::create($this->currentYear, $this->currentMonth);
            $entretiens = Entretien::where('entreprise_id', $entreprise->id)
                ->whereMonth('date_prevue', $currentMonth->month)
                ->whereYear('date_prevue', $currentMonth->year)
                ->get();
        } else {
            $entretiens = Entretien::where('entreprise_id', $entreprise->id)->get();
        }

        return [
            'total_mois' => $entretiens->count(),
            'en_attente' => $entretiens->where('status', 'PENDING')->count(),
            'en_cours' => $entretiens->where('status', 'IN_PROGRESS')->count(),
            'termines' => $entretiens->where('status', 'COMPLETED')->count(),
        ];
    }

    public function getContratsProperty()
    {
        $entreprise = Auth::guard('entreprise')->user();
        return $entreprise->contrats;
    }

    public function getEntretiensProperty()
    {
        $entreprise = Auth::guard('entreprise')->user();

        $query = Entretien::where('entreprise_id', $entreprise->id)
            ->with(['contrat', 'historique_entretiens.vehicule']);

        if ($this->viewMode === 'calendar') {
            $query->whereMonth('date_prevue', $this->currentMonth)
                ->whereYear('date_prevue', $this->currentYear);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->contratFilter) {
            $query->where('contrat_id', $this->contratFilter);
        }

        return $query->orderBy('date_prevue', $this->viewMode === 'list' ? 'desc' : 'asc')->get();
    }

    public function getEntretiensListProperty()
    {
        $entreprise = Auth::guard('entreprise')->user();

        $query = Entretien::where('entreprise_id', $entreprise->id)
            ->with(['contrat', 'historique_entretiens.vehicule']);



        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->contratFilter) {
            $query->where('contrat_id', $this->contratFilter);
        }

        return $query->orderBy('date_prevue', 'desc')->get();
    }

    public function getCalendarDataProperty()
    {
        $firstDay = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $lastDay = $firstDay->copy()->endOfMonth();
        $startDayOfWeek = $firstDay->dayOfWeekIso;

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

        $currentMonthDays = [];
        $entretiens = $this->entretiens;
        $entretiens_list = $this->entretiens_list;

        for ($day = 1; $day <= $lastDay->day; $day++) {
            $date = Carbon::create($this->currentYear, $this->currentMonth, $day);
            $dayEntretiens = $entretiens->filter(function($e) use ($date) {
                return Carbon::parse($e->date_prevue)->isSameDay($date);
            });

            $currentMonthDays[] = [
                'day' => $day,
                'isCurrentMonth' => true,
                'isToday' => $date->isToday(),
                'date' => $date,
                'events' => $dayEntretiens
            ];
        }

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

    public function openDetailsModal($entretienId)
    {
        $this->selectedEntretien = Entretien::with([
            'contrat',
            'historique_entretiens.vehicule'
        ])->findOrFail($entretienId);

        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedEntretien = null;
    }

    public function exportPlanning()
    {
        $this->send_event_at_toast('Export en cours de développement', 'info', 'top-end');
    }

    public function getStatusClass($status)
    {
        return match($status) {
            'PENDING' => 'event-attente',
            'IN_PROGRESS' => 'event-urgent',
            'COMPLETED' => 'event-confirme',
            'DONE' => 'event-confirme',
            default => 'event-attente'
        };
    }

    public function getStatusBadge($status)
    {
        return match($status) {
            'PENDING' => 'status-warning',
            'IN_PROGRESS' => 'status-urgent',
            'COMPLETED' => 'status-success',
            'DONE' => 'status-success',
            default => 'status-warning'
        };
    }

    public function getStatusLabel($status)
    {
        return match($status) {
            'PENDING' => 'En attente',
            'IN_PROGRESS' => 'En cours',
            'COMPLETED' => 'Terminé',
            'CANCELLED' => 'Annulé',
            'DONE' => 'Terminé',
            default => 'En attente'
        };
    }

    public function render()
    {
        return view('livewire.entreprise.planning.planning-entreprise', [
            'stats' => $this->stats,
            'contrats' => $this->contrats,
            'entretiens' => $this->entretiens,
            'calendarData' => $this->calendarData,
            'entretiens_list' => $this->entretiens_list
        ]);
    }
}
