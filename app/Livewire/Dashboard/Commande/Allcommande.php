<?php

namespace App\Livewire\Dashboard\Commande;

use Livewire\Component;
use App\Models\Commande;
use Livewire\WithPagination;
use App\Livewire\UtilsSweetAlert;

class Allcommande extends Component
{
    use UtilsSweetAlert, WithPagination;

    //stats
    public $all_order, $pending_order, $finish_order;
    public $list_products;
    public $show_commande;

    //filter commande;
    public $search_filter, $date_before_filter, $status_filter, $methode_payment_filter;
    public $list_order_filter;

    //show products
    public $currentPage = "all";

    public function getStats()  {
        $this->all_order = Commande::count();
        $this->pending_order = Commande::where('status', 'en attente')->count();
        $this->finish_order = Commande::where('status', 'VALIDEE')->count();
    }

    public function showProducts($id) {
        $commande = Commande::find($id);
        if(!$commande) {
            $this->send_event_at_sweetAlerte("Erreur","Cette commande n'existe pas !!","error");
            return;
        }

        $this->list_products = $commande->produit()->get();
        $this->show_commande = $commande;
        $this->launch_modal('show_products');
    }

    public function filterCommande()  {
        $order = Commande::when($this->search_filter, function ($query) {
            //ou le username du user
            $query->whereHas('user', function ($query) {
                $query->where('username', 'like', '%' . $this->search_filter . '%');
            });
        })->when($this->date_before_filter, function ($query) {
             $query->where('created_at', '<=', $this->date_before_filter);
        })->when($this->status_filter, function ($query) {
             $query->where('status', $this->status_filter);
        })->when($this->methode_payment_filter, function ($query) {
             $query->where('methode_payment', $this->methode_payment_filter);
        })->get();

        $this->list_order_filter = $order;
    }

    public function selectPage($name)  {
        $this->currentPage = $name;

        switch ($name) {
            case 'Terminer':
                $this->list_order_filter = Commande::when($this->search_filter, function ($query) {
                        //ou le username du user
                        $query->whereHas('user', function ($query) {
                            $query->where('username', 'like', '%' . $this->search_filter . '%');
                        });
                    })->when($this->date_before_filter, function ($query) {
                        $query->where('created_at', '<=', $this->date_before_filter);
                    })->where('status', Commande::COMPLETED)
                    ->when($this->methode_payment_filter, function ($query) {
                        $query->where('methode_payment', $this->methode_payment_filter);
                    })->OrderBy('created_at', 'desc')->get();
                break;
            case 'Annuler':
                $this->list_order_filter = Commande::when($this->search_filter, function ($query) {
                                    //ou le username du user
                                    $query->whereHas('user', function ($query) {
                                        $query->where('username', 'like', '%' . $this->search_filter . '%');
                                    });
                                })->when($this->date_before_filter, function ($query) {
                                    $query->where('created_at', '<=', $this->date_before_filter);
                                })->where(
                                    'status', Commande::CANCELED
                                )->when($this->methode_payment_filter, function ($query) {
                                    $query->where('methode_payment', $this->methode_payment_filter);
                                })->OrderBy('created_at', 'desc')->get();
                break;

            default:
                $this->list_order_filter = Commande::when($this->search_filter, function ($query) {
                                    //ou le username du user
                                    $query->whereHas('user', function ($query) {
                                        $query->where('username', 'like', '%' . $this->search_filter . '%');
                                    });
                                })->when($this->date_before_filter, function ($query) {
                                    $query->where('created_at', '<=', $this->date_before_filter);
                                })->when($this->status_filter, function ($query) {
                                    $query->where('status', $this->status_filter);
                                })->when($this->methode_payment_filter, function ($query) {
                                    $query->where('methode_payment', $this->methode_payment_filter);
                                })->get();
                break;
        }
    }

    public function render()
    {
        $this->getStats();
        return view('livewire.dashboard.commande.allcommande',[
            'list_order' => Commande::OrderBy('created_at', 'desc')->paginate(40)
        ]);
    }
}
