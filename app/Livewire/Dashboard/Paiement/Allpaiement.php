<?php

namespace App\Livewire\Dashboard\Paiement;

use Livewire\Component;
use App\Models\Commande;
use App\Models\Paiement;
use Livewire\WithPagination;
use App\Livewire\UtilsSweetAlert;

class Allpaiement extends Component
{
    use UtilsSweetAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $all_payment, $paid_payment, $pending_payment, $canceled_payment ;


    public function getMontantPaymentByStatus()  {
        $this->all_payment = Paiement::sum('montant');
        $this->paid_payment = Paiement::where('status', Paiement::PAID)->sum('montant');
        $this->pending_payment = Paiement::where('status', Paiement::PENDING)->OrWhere('status', Paiement::INITIATED)->sum('montant');
        $this->canceled_payment = Paiement::where('status', Paiement::CANCELED)->sum('montant');
    }

    public function getPaiementsEtCommandes()
    {
        $paiements = Paiement::select('id','reference','user_id','montant', 'methode as methode_payment', 'status', 'created_at');

        return $paiements->orderBy('created_at', 'desc');
    }

    public function render()
    {
        $this->getMontantPaymentByStatus();
        return view('livewire.dashboard.paiement.allpaiement',[
            'list_paiements' => $this->getPaiementsEtCommandes()->paginate(10)
        ]);
    }
}
