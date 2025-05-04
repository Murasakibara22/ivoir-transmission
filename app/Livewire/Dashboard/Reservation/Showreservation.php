<?php

namespace App\Livewire\Dashboard\Reservation;

use Livewire\Component;
use App\Models\Reservation;
use App\Livewire\UtilsSweetAlert;

class Showreservation extends Component
{

    use UtilsSweetAlert;

    public $show_reservation;

    public function mount($reservation)  {
        $this->show_reservation = $reservation;

    }

    public function validateOrder()  {
        if($this->show_reservation->status == Reservation::STARTED) {
            $this->send_event_at_sweetAlerte("reservation Validée","Cette reservation est deja validée !!","error");
            return;
        }

        if($this->show_reservation->status == Reservation::CANCELED) {
            $this->send_event_at_sweetAlerte("reservation Annulée","Cette reservation est deja annulée !!","error");
            return;
        }

        $this->show_reservation->status = Reservation::STARTED;
        $this->show_reservation->start_at = now();
        $this->show_reservation->save();

        // $this->sendNotification($this->show_reservation->user_id, "reservation Validée", "La reservation a bien été validée, elle est maintenant en attente de livraison ou de récupération.", "Order Validated", $this->show_reservation->id);
        $this->send_event_at_sweetAlerte("reservation Validée","Vous venez de valider la reservation","success");
    }

    public function cancelOrder()  {
        if($this->show_reservation->status == Reservation::COMPLETED) {
            $this->send_event_at_toast('La reservation a deja été Terminée !!', 'error', 'top-right');
            return ;
        }

        $this->show_reservation->status = Reservation::CANCELED;
        $this->show_reservation->save();


        // $this->sendNotification($this->show_reservation->user_id, "reservation Annulée", "La reservation a bien été annulée.", "Order Cancelled", $this->show_reservation->id);
        $this->send_event_at_toast('reservation Annulée !!', 'success', 'top-right');
    }

    public function finishOrder()  {
        if($this->show_reservation->status == Reservation::COMPLETED) {
            $this->send_event_at_toast('La reservation a deja été Terminée !!', 'error', 'top-right');
            return ;
        }

        if($this->show_reservation->status == Reservation::CANCELED) {
            $this->send_event_at_toast('La reservation a deja été Annulée !!', 'error', 'top-right');
            return ;
        }

        if($this->show_reservation->status != Reservation::STARTED) {
            $this->send_event_at_toast('La reservation n\'a pas encore débutée !!', 'warning', 'top-right');
            return ;
        }

        $this->show_reservation->status = Reservation::COMPLETED;
        $this->show_reservation->date_fin = now();
        $this->show_reservation->save();

        if($this->show_reservation->methode_payment == "cash" || $this->show_reservation->methode_payment == "Cash") {
            $paiement = new Paiement;
            $paiement->reservation_id = $this->show_reservation->id;
            $paiement->user_id = $this->show_reservation->user_id;
            $paiement->montant = $this->show_reservation->montant;
            $paiement->methode = "cash";
            $paiement->status = Paiement::PAID;
            $paiement->reference =  uniqid();
            $paiement->slug = generateSlug('Paiement', $paiement->reference);
            $paiement->save();
        }


        // $this->sendNotification($this->show_reservation->user_id, "reservation Terminée", "La reservation a bien été terminée.", "Order Completed", $this->show_reservation->id);
        $this->send_event_at_toast('reservation Terminée !!', 'success', 'top-right');
    }

    function sendNotification($user_id, $title, $body, $type, $id)  {

        $user = User::where('id', $user_id)->first();
        Notification::create([
            'user_id' => $user_id,
            'title' => $title,
            'body' => $body,
            'type' => $type,
            'meta_data_id' => $id
        ]);
    }

    public function printOrder()  {

        $this->launch_modal('print-reservation');
    }


    public function render()
    {
        return view('livewire.dashboard.reservation.showreservation');
    }
}
