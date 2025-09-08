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

    public $search = '';
    public $status = '';
    public $methode = '';
    public $date_from;
    public $date_to;


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

    public function applyFilters()
{
    $query = Paiement::query();

    if($this->search) {
        $query->where(function($q){
            $q->where('reference', 'like', '%'.$this->search.'%')
              ->orWhereHas('user', function($q){
                  $q->where('username', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%');
              });
        });
    }

    if($this->status && $this->status != 'all'){
        $query->where('status', $this->status);
    }

    if($this->methode){
        $query->where('methode', $this->methode);
    }

    if($this->date_from && $this->date_to){
        $query->whereBetween('created_at', [$this->date_from, $this->date_to]);
    }

    return $query->orderBy('created_at', 'desc');
}

    public function render()
    {
        $this->getMontantPaymentByStatus();
        return view('livewire.dashboard.paiement.allpaiement',[
            'list_paiements' => $this->applyFilters()->paginate(10)
        ]);
    }
}
