<?php

namespace App\Livewire\Dashboard\Home;

use App\Models\User;
use App\Models\Service;
use Livewire\Component;
use App\Models\Reservation;
use App\Models\Paiement;
use App\Livewire\UtilsSweetAlert;

class Index extends Component
{
    use UtilsSweetAlert;

    //STats du haut
    public $benefice_total, $total_order, $total_user, $total_Services;

    public $stats_by_month_effectuer, $stats_by_month_annuler, $stats_by_all_month  ;


    public function getStatsHaut()  {
        $this->benefice_total = Reservation::where('status',Reservation::COMPLETED)->sum('montant');
        $this->total_order = Reservation::count();
        $this->total_user = User::count();
        $this->total_Services = Service::count();
    }

    // public function mount()  {
    //    Paiement::each(function ($paiement) {
    //        $paiement->delete();
    //    });


    //    Reservation::each(function ($Reservation) {
    //        $Reservation->delete();
    //    });

    //    Service::OrderBy('created_at')->each(function ($Service) {
    //     //s'il reste un seul Service on ne le supprime pas
    //        if(Service::count() > 1){
    //            $Service->delete();
    //        }
    //    });
    // }


    public function getNumberPaymentCancelByMonth()  {

        $janvier_stat = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 1)->whereYear('created_at', date('Y'))->count();
        $fevrier = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 2)->whereYear('created_at', date('Y'))->count();
        $mars = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 3)->whereYear('created_at', date('Y'))->count();
        $avril = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 4)->whereYear('created_at', date('Y'))->count();
        $mai = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 5)->whereYear('created_at', date('Y'))->count();
        $juin = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 6)->whereYear('created_at', date('Y'))->count();
        $juillet = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 7)->whereYear('created_at', date('Y'))->count();
        $aout = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 8)->whereYear('created_at', date('Y'))->count();
        $septembre = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 9)->whereYear('created_at', date('Y'))->count();
        $octobre = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 10)->whereYear('created_at', date('Y'))->count();
        $novembre = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 11)->whereYear('created_at', date('Y'))->count();
        $decembre = Reservation::where('status',Reservation::CANCELED)->whereMonth('created_at', 12)->whereYear('created_at', date('Y'))->count();

        $this->stats_by_month_annuler = collect([
            'janvier' => $janvier_stat,
            'fevrier' => $fevrier,
            'mars' => $mars,
            'avril' => $avril,
            'mai' => $mai,
            'juin' => $juin,
            'juillet' => $juillet,
            'aout' => $aout,
            'septembre' => $septembre,
            'octobre' => $octobre,
            'novembre' => $novembre,
            'decembre' => $decembre
        ]);
    }

    public function getNumberPaymentPaidByMonth()  {

        $janvier_stat = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 1)->whereYear('created_at', date('Y'))->count();
        $fevrier = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 2)->whereYear('created_at', date('Y'))->count();
        $mars = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 3)->whereYear('created_at', date('Y'))->count();
        $avril = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 4)->whereYear('created_at', date('Y'))->count();
        $mai = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 5)->whereYear('created_at', date('Y'))->count();
        $juin = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 6)->whereYear('created_at', date('Y'))->count();
        $juillet = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 7)->whereYear('created_at', date('Y'))->count();
        $aout = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 8)->whereYear('created_at', date('Y'))->count();
        $septembre = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 9)->whereYear('created_at', date('Y'))->count();
        $octobre = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 10)->whereYear('created_at', date('Y'))->count();
        $novembre = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 11)->whereYear('created_at', date('Y'))->count();
        $decembre = Reservation::where('status',Reservation::COMPLETED)->whereMonth('created_at', 12)->whereYear('created_at', date('Y'))->count();

        $this->stats_by_month_effectuer = collect([
            'janvier' => $janvier_stat,
            'fevrier' => $fevrier,
            'mars' => $mars,
            'avril' => $avril,
            'mai' => $mai,
            'juin' => $juin,
            'juillet' => $juillet,
            'aout' => $aout,
            'septembre' => $septembre,
            'octobre' => $octobre,
            'novembre' => $novembre,
            'decembre' => $decembre
        ]);
    }

    public function getNumberPaymentAllByMonth()  {

        $janvier_stat = Reservation::whereMonth('created_at', 1)->whereYear('created_at', date('Y'))->count();
        $fevrier = Reservation::whereMonth('created_at', 2)->whereYear('created_at', date('Y'))->count();
        $mars = Reservation::whereMonth('created_at', 3)->whereYear('created_at', date('Y'))->count();
        $avril = Reservation::whereMonth('created_at', 4)->whereYear('created_at', date('Y'))->count();
        $mai = Reservation::whereMonth('created_at', 5)->whereYear('created_at', date('Y'))->count();
        $juin = Reservation::whereMonth('created_at', 6)->whereYear('created_at', date('Y'))->count();
        $juillet = Reservation::whereMonth('created_at', 7)->whereYear('created_at', date('Y'))->count();
        $aout = Reservation::whereMonth('created_at', 8)->whereYear('created_at', date('Y'))->count();
        $septembre = Reservation::whereMonth('created_at', 9)->whereYear('created_at', date('Y'))->count();
        $octobre = Reservation::whereMonth('created_at', 10)->whereYear('created_at', date('Y'))->count();
        $novembre = Reservation::whereMonth('created_at', 11)->whereYear('created_at', date('Y'))->count();
        $decembre = Reservation::whereMonth('created_at', 12)->whereYear('created_at', date('Y'))->count();

        $this->stats_by_all_month = collect([
            'janvier' => $janvier_stat,
            'fevrier' => $fevrier,
            'mars' => $mars,
            'avril' => $avril,
            'mai' => $mai,
            'juin' => $juin,
            'juillet' => $juillet,
            'aout' => $aout,
            'septembre' => $septembre,
            'octobre' => $octobre,
            'novembre' => $novembre,
            'decembre' => $decembre
        ]);
    }

    public function render()
    {
        $this->getStatsHaut();
        $this->getNumberPaymentCancelByMonth();
        $this->getNumberPaymentPaidByMonth();
        $this->getNumberPaymentAllByMonth();
        return view('livewire.dashboard.home.index',[
            //List des Services qui apparaitront beaucoup dans les Reservations
            'list_Services' => Service::orderBy('created_at', 'desc')->limit(8)->get(),
            'list_Reservations' => Reservation::orderBy('created_at', 'desc')->limit(8)->get(),
            'list_users' => User::orderBy('created_at', 'desc')->limit(8)->get()
        ]);
    }
}
