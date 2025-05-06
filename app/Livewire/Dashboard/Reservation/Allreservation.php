<?php

namespace App\Livewire\Dashboard\Reservation;

use Livewire\Component;
use App\Models\Reservation;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Mail\ConfirmationDevis;
use App\Livewire\UtilsSweetAlert;
use Illuminate\Support\Facades\Mail;


class Allreservation extends Component
{

    use UtilsSweetAlert, WithPagination;

    public $id_reservation;

    //stats
    public $all_order, $pending_order, $finish_order;
    public $list_products;
    public $show_reservation;

    //filter reservation;
    public $search_filter, $date_before_filter, $status_filter, $methode_payment_filter;
    public $list_order_filter;

    //Montant change
    public $montant_change;

    //show products
    public $currentPage = "all";

    public function getStats()  {
        $this->all_order = Reservation::count();
        $this->pending_order = Reservation::where('status', 'en attente')->OrWhere('status', 'PENDING')->count();
        $this->finish_order = Reservation::where('status', 'TERMINEE')->count();
    }

    public function addMontant($id)  {
        $reservation = Reservation::find($id);
        if(!$reservation) {
            $this->send_event_at_sweetAlerte("Erreur","Cette reservation n'existe pas !!","error");
            return;
        }

        $this->id_reservation = $id;
        $this->reset('montant_change');
        $this->launch_modal('add_montant');
    }

    public function SubmitMontnantChange()  {
        $this->validate([
            'montant_change' => 'required|numeric'
        ],[
            'montant_change.required' => 'Le montant est obligatoire',
            'montant_change.numeric' => 'Le montant doit etre un nombre'
        ]);


        $reservation = Reservation::find($this->id_reservation);
        if(!$reservation) {
            $this->send_event_at_sweetAlerte("Erreur","Cette reservation n'existe pas !!","error");
            return;
        }

        $this->sweetAlert_confirm_success($reservation ,"Modification du montant","Etes-vous sur de vouloir modifier le montant de la reservation","UpdateMontant", "info");
        return;
    }

    #[On('UpdateMontant')]
    function UpdateMontant($id)  {
        $reservation = Reservation::find($id);

        if($reservation) {
            $reservation->montant = $this->montant_change;
            $reservation->save();
            $this->send_event_at_sweetAlerte("Modification éffectuée","Le montant de la reservation a été modifié avec success","success");
        }

        $user = $reservation->user()->first();
        $data = [
            'montant' => $reservation->montant,
            'chassis' => $reservation->chassis,
            'url_payment' => url(),
            'date_debut' => $reservation->date_debut,
            'created_at' => $reservation->created_at,
            'description' => $reservation->description,
        ];

        Mail::to($user->email)->send(new ConfirmationDevis($data));

        $this->reset('montant_change');
        $this->closeModal_after_edit('add_montant');
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
            'list_order' => Reservation::OrderBy('created_at', 'desc')->paginate(40),
            'list_marker_reservations' => Reservation::get()
            ->map(function ($res) {
                return [
                    'latitude' => $res->latitude,
                    'longitude' => $res->longitude,
                    'status' => $res->status,
                    'address' => $res->adresse_name,
                    'status_paiement' => $res->status_paiement,
                    'slug' => $res->slug,
                    'phone' => $res->user->phone
                ];
            }),
            'list_marker_reservations_pending' => Reservation::get()
        ]);
    }
}
