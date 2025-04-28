<?php

namespace App\Livewire\Dashboard\Avis;

use App\Models\Note;
use Livewire\Component;
use App\Livewire\UtilsSweetAlert;
use Livewire\Attributes\On;


class Allavis extends Component
{
    use UtilsSweetAlert;

    public $search;

    public $id_avis;

    public function toggleAvis($id){
        $avis = Note::find($id);
        if(!$avis){
            $this->send_event_at_sweet_alert_not_timer("Erreur","Le Note selectionner n'existe pas !!", "error");
            return ;
        }

        $avis->status = $avis->status == Note::ACTIVATED ? Note::INACTIVATED : Note::ACTIVATED;
        $avis->update();
        $this->send_event_at_sweet_alert_not_timer("Status Note","La note a été ".$avis->status." avec succès !!", "success");
        return;
    }

    public function DeleteNote($id)  {
        $Note = Note::find($id);
        if(!$Note) {
            $this->send_event_at_sweet_alert_not_timer("Erreur","Le Note selectionner n'existe pas !!", "error");
            return ;
        }

        $this->sweetAlert_confirm_options($Note ,"Supperssion de Note","Etes-vous sur de vouloir supprimer cette Note","DestoyNote", "error");
    }

    #[on('DestoyNote')]
    public function destroy($id)  {
        $Note = Note::find($id);
        if($Note){
            $Note->delete();
            $this->send_event_at_toast("Supression Effectuer !!", "success", "bottom-end");
        }
    }

    public function render()
    {
        return view('livewire.dashboard.avis.allavis',[
            'list_note' => Note::OrderBy('created_at','desc')->get()
        ]);
    }
}
