<?php

namespace App\Livewire\Dashboard\Temoignage;

use Livewire\Component;
use App\Models\Temoignage;
use App\Livewire\UtilsSweetAlert;
use Livewire\Attributes\On;


class Alltemoignage extends Component
{
    use UtilsSweetAlert;


    public function ChangeStatusTemoignage($id)  {
        $temoignage = Temoignage::find($id);
        if(!$temoignage) {
            $this->send_event_at_sweet_alert_not_timer("Erreur","Le temoignage selectionner n'existe pas !!", "error");
            return ;
        }

        $temoignage->status = $temoignage->status == "ACTIVATED" ? "DEACTIVATED" : "ACTIVATED";
        $temoignage->save();
        $this->send_event_at_sweet_alert_not_timer("Status du témoignage modifié","Le temoignage a été ".$temoignage->status." avec success", "success");
    }


    public function DeleteTemoignage($id)  {
        $temoignage = Temoignage::find($id);
        if(!$temoignage) {
            $this->send_event_at_sweet_alert_not_timer("Erreur","Le temoignage selectionner n'existe pas !!", "error");
            return ;
        }

        $this->sweetAlert_confirm_options($temoignage ,"Supperssion de temoignage","Etes-vous sur de vouloir supprimer ce temoignage","Destoytemoignage", "error");
    }

    #[on('Destoytemoignage')]
    public function destroy($id)  {
        $temoignage = Temoignage::find($id);
        if($temoignage){
            $temoignage->delete();
            $this->send_event_at_toast("Supression Effectuer !!", "success", "bottom-end");
        }
    }


    public function render()
    {
        return view('livewire.dashboard.temoignage.alltemoignage',[
            'list_temoignage' => Temoignage::OrderBy('created_at', 'desc')->get()
        ]);
    }
}
