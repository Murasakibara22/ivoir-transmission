<?php

namespace App\Livewire\Dashboard\Reservation;

use Livewire\Component;
use App\Models\Reservation;
use Livewire\WithPagination;
use App\Livewire\UtilsSweetAlert;

class Allreservation extends Component
{

    use UtilsSweetAlert, WithPagination;

    //stats
    public $all_order, $pending_order, $finish_order;
    public $list_products;
    public $show_reservation;

    //filter reservation;
    public $search_filter, $date_before_filter, $status_filter, $methode_payment_filter;
    public $list_order_filter;

    //show products
    public $currentPage = "all";

    public function getStats()  {
        $this->all_order = Reservation::count();
        $this->pending_order = Reservation::where('status', 'en attente')->OrWhere('status', 'PENDING')->count();
        $this->finish_order = Reservation::where('status', 'TERMINEE')->count();
    }

    public function showProducts($id) {
        $reservation = Reservation::find($id);
        if(!$reservation) {
            $this->send_event_at_sweetAlerte("Erreur","Cette reservation n'existe pas !!","error");
            return;
        }

        $this->list_products = $reservation->produit()->get();
        $this->show_reservation = $reservation;
        $this->launch_modal('show_products');
    }

    public function filterreservation()  {
        $order = Reservation::when($this->search_filter, function ($query) {
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
                $this->list_order_filter = Reservation::when($this->search_filter, function ($query) {
                        //ou le username du user
                        $query->whereHas('user', function ($query) {
                            $query->where('username', 'like', '%' . $this->search_filter . '%');
                        });
                    })->when($this->date_before_filter, function ($query) {
                        $query->where('created_at', '<=', $this->date_before_filter);
                    })->where('status', Reservation::COMPLETED)
                    ->when($this->methode_payment_filter, function ($query) {
                        $query->where('methode_payment', $this->methode_payment_filter);
                    })->OrderBy('created_at', 'desc')->get();

                    if($this->list_order_filter->count() == 0) {
                        $this->send_event_at_sweetAlerte("Aucune reservation Terminée","Aucune reservation Terminer n'a été trouvée !!","info");
                    }
                break;
            case 'Annuler':
                $this->list_order_filter = Reservation::when($this->search_filter, function ($query) {
                                    //ou le username du user
                                    $query->whereHas('user', function ($query) {
                                        $query->where('username', 'like', '%' . $this->search_filter . '%');
                                    });
                                })->when($this->date_before_filter, function ($query) {
                                    $query->where('created_at', '<=', $this->date_before_filter);
                                })->where(
                                    'status', Reservation::CANCELED
                                )->when($this->methode_payment_filter, function ($query) {
                                    $query->where('methode_payment', $this->methode_payment_filter);
                                })->OrderBy('created_at', 'desc')->get();
                if($this->list_order_filter->count() == 0) {
                    $this->send_event_at_sweetAlerte("Aucune reservation","Aucune reservation n'a été trouvée !!","warning");
                }
                break;

            default:
                $this->list_order_filter = Reservation::when($this->search_filter, function ($query) {
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
                                })->OrderBy('created_at', 'desc')
                                ->get();
                break;
        }
    }

    public function render()
    {
        $this->getStats();
        return view('livewire.dashboard.reservation.allreservation',[
            'list_order' => Reservation::OrderBy('created_at', 'desc')->paginate(40)
        ]);
    }
}
