<?php

namespace App\Livewire\Dashboard\Finance;

use Livewire\Component;
use App\Models\Reservation;
use App\Livewire\UtilsSweetAlert;

class Allfinance extends Component
{
    use UtilsSweetAlert;

    public $gains_total, $gains_a_avoir, $gains_perdu, $gains_en_attente, $gains_obtenu;

    //list commandes
    public $list_commandes, $filter_year;

    public $stats_by_month_effectuer, $stats_by_month_pending, $stats_by_all_month;




    public function mount() {
        $this->list_commandes = Reservation::where('status', Reservation::COMPLETED)->get();
        $this->getStatsGains();

        $this->getNumberPaymentPendingByMonth();
        $this->getNumberPaymentPaidByMonth();
        $this->getNumberPaymentAllByMonth();

    }


    public function getStatsGains($year = null) {
        $year = $year ?? now()->year; // Définit l'année actuelle par défaut si aucun paramètre n'est envoyé

        $this->gains_total = Reservation::whereYear('created_at', $year)->sum('montant');
        $this->gains_a_avoir = Reservation::whereYear('created_at', $year)
            ->where('status', Reservation::STARTED)
            ->sum('montant');
        $this->gains_perdu = Reservation::whereYear('created_at', $year)
            ->where('status', Reservation::CANCELED)
            ->sum('montant');
        $this->gains_en_attente = Reservation::whereYear('created_at', $year)
            ->where('status', 'PENDING')
            ->Orwhere('status', Reservation::INITIATED)
            ->sum('montant');
        $this->gains_obtenu = Reservation::whereYear('created_at', $year)
            ->where('status', Reservation::COMPLETED)
            ->sum('montant');

    }

    public function updatedFilterYear()  {
        // dd($this->filter_year);
        $this->getStatsGains($this->filter_year);

        $this->getNumberPaymentPendingByMonth($this->filter_year);
        $this->getNumberPaymentPaidByMonth($this->filter_year);
        $this->getNumberPaymentAllByMonth($this->filter_year);
    }

    public function resetFilter()  {
        $this->filter_year = null;

        $this->getStatsGains();

        $this->getNumberPaymentPendingByMonth();
        $this->getNumberPaymentPaidByMonth();
        $this->getNumberPaymentAllByMonth();
    }


    public function getNumberPaymentPendingByMonth($year = null) {
        $year = $year ?? now()->year; // Définit l'année actuelle par défaut

        $months = [
            'janvier' => 1, 'fevrier' => 2, 'mars' => 3, 'avril' => 4,
            'mai' => 5, 'juin' => 6, 'juillet' => 7, 'aout' => 8,
            'septembre' => 9, 'octobre' => 10, 'novembre' => 11, 'decembre' => 12
        ];

        $this->stats_by_month_pending = collect($months)->mapWithKeys(function ($monthNumber, $monthName) use ($year) {
            return [
                $monthName => Reservation::where('status', Reservation::PENDING)
                    ->whereMonth('created_at', $monthNumber)
                    ->whereYear('created_at', $year)
                    ->sum('montant')
            ];
        });
    }


    public function getNumberPaymentPaidByMonth($year = null) {
        $year = $year ?? now()->year; // Définit l'année actuelle par défaut

        $months = [
            'janvier' => 1, 'fevrier' => 2, 'mars' => 3, 'avril' => 4,
            'mai' => 5, 'juin' => 6, 'juillet' => 7, 'aout' => 8,
            'septembre' => 9, 'octobre' => 10, 'novembre' => 11, 'decembre' => 12
        ];

        $this->stats_by_month_effectuer = collect($months)->mapWithKeys(function ($monthNumber, $monthName) use ($year) {
            return [
                $monthName => Reservation::where('status', Reservation::COMPLETED)
                    ->whereMonth('created_at', $monthNumber)
                    ->whereYear('created_at', $year)
                    ->sum('montant')
            ];
        });
    }


    public function getNumberPaymentAllByMonth($year = null) {
        $year = $year ?? now()->year; // Définit l'année actuelle par défaut

        $months = [
            'janvier' => 1, 'fevrier' => 2, 'mars' => 3, 'avril' => 4,
            'mai' => 5, 'juin' => 6, 'juillet' => 7, 'aout' => 8,
            'septembre' => 9, 'octobre' => 10, 'novembre' => 11, 'decembre' => 12
        ];

        $this->stats_by_all_month = collect($months)->mapWithKeys(function ($monthNumber, $monthName) use ($year) {
            return [
                $monthName => Reservation::whereMonth('created_at', $monthNumber)
                    ->whereYear('created_at', $year)
                    ->sum('montant')
            ];
        });
    }


    public function render()
    {
        return view('livewire.dashboard.finance.allfinance',[
            'list_years' => range(2020, strftime("%Y", time()))
        ]);
    }
}
