<?php

namespace App\Livewire\Dashboard\Commande;

use App\Models\User;
use Livewire\Component;
use App\Models\Commande;
use App\Models\Paiement;
use App\Models\Notification;
use App\Models\ProduitCommande;
use App\Models\VarianteProduit;
use App\Livewire\UtilsSweetAlert;

class Showcommande extends Component
{
    use UtilsSweetAlert;

    public $show_commande;
    public $produits_cart;

    public function mount($commande)  {
        $this->show_commande = $commande;

        $this->produits_cart = $this->show_commande->produits_snapshot;

        foreach ($this->produits_cart as $produit) {
            $produit['images'] = json_decode($produit['images'], true);
        }
    }

    public function validateOrder()  {
        if($this->show_commande->status == Commande::VALIDATE) {
            $this->send_event_at_sweetAlerte("Commande Validée","Cette commande est deja validée !!","error");
            return;
        }

        if($this->show_commande->status == Commande::CANCELED) {
            $this->send_event_at_sweetAlerte("Commande Annulée","Cette commande est deja annulée !!","error");
            return;
        }

        $this->show_commande->status = Commande::VALIDATE;
        $this->show_commande->validated_at = now();
        $this->show_commande->save();

        $this->sendNotification($this->show_commande->user_id, "Commande Validée", "La commande a bien été validée, elle est maintenant en attente de livraison ou de récupération.", "Order Validated", $this->show_commande->id);
        $this->send_event_at_sweetAlerte("Commande Validée","Vous venez de valider la commande","success");
    }

    public function cancelOrder()  {
        if($this->show_commande->status == Commande::COMPLETED) {
            $this->send_event_at_toast('La commande a deja été Terminée !!', 'error', 'top-right');
            return ;
        }

        $this->show_commande->status = Commande::CANCELED;
        $this->show_commande->save();

        $produit_commander = ProduitCommande::where('commande_id', $this->show_commande->id)->get();
        if($produit_commander) {
            foreach($produit_commander as $produit_commande) {
                if($produit_commande->variante_id){
                    $variante = VarianteProduit::where('id', $produit_commande->variante_id)->first();
                    $variante->stock = $variante->stock + $produit_commande->quantite;
                    $variante->save();

                    $prod2 = Produit::where('id', $variante->produit_id)->first();
                    $prod2->stock = $prod2->stock + $produit_commande->quantite;
                    $prod2->save();
                }else{
                    $produit = Produit::where('id', $produit_commande->produit_id)->first();
                    $produit->stock = $produit->stock + $produit_commande->quantite;
                    $produit->save();
                }
            }
        }

        $this->sendNotification($this->show_commande->user_id, "Commande Annulée", "La commande a bien été annulée.", "Order Cancelled", $this->show_commande->id);
        $this->send_event_at_toast('Commande Annulée !!', 'success', 'top-right');
    }

    public function finishOrder()  {
        if($this->show_commande->status == Commande::COMPLETED) {
            $this->send_event_at_toast('La commande a deja été Terminée !!', 'error', 'top-right');
            return ;
        }

        if($this->show_commande->status == Commande::CANCELED) {
            $this->send_event_at_toast('La commande a deja été Annulée !!', 'error', 'top-right');
            return ;
        }

        if($this->show_commande->status != Commande::VALIDATE) {
            $this->send_event_at_toast('La commande n\'a pas encore été Valide !!', 'warning', 'top-right');
            return ;
        }

        $this->show_commande->status = Commande::COMPLETED;
        $this->show_commande->delivery_at = now();
        $this->show_commande->status_payement = Commande::SUCCESSFUL;
        $this->show_commande->save();

        if($this->show_commande->methode_payment == "cash" || $this->show_commande->methode_payment == "Cash") {
            $paiement = new Paiement;
            $paiement->commande_id = $this->show_commande->id;
            $paiement->user_id = $this->show_commande->user_id;
            $paiement->montant = $this->show_commande->montant;
            $paiement->methode = "cash";
            $paiement->status = Paiement::PAID;
            $paiement->reference =  uniqid();
            $paiement->slug = generateSlug('Paiement', $paiement->reference);
            $paiement->save();
        }


        $this->sendNotification($this->show_commande->user_id, "Commande Terminée", "La commande a bien été terminée.", "Order Completed", $this->show_commande->id);
        $this->send_event_at_toast('Commande Terminée !!', 'success', 'top-right');
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

        $this->launch_modal('print-commande');
    }


    public function render()
    {
        return view('livewire.dashboard.commande.showcommande');
    }
}
