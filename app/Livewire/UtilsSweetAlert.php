<?php

namespace App\Livewire;

trait UtilsSweetAlert {

    /**
     *
     * UTILITIES
     *
     */

     public function send_event_at_sweetAlerte($title = 'merci', $message , $type)  {
        $this->dispatch('swal:modalGetInfo_message', [
            'title' => $title,
            'text' => $message,
            'type' => $type
        ]);
    }

     public function send_event_at_sweet_alert_not_timer($title = 'merci', $message , $type)  {
        $this->dispatch('swal:modalGetInfo_message_not_timer', [
            'title' => $title,
            'text' => $message,
            'type' => $type
        ]);
    }

    public function send_event_at_toast($title = 'merci', $type , $position)  {
        $this->dispatch('modalShowmessageToast',
            ['title' => $title, 'type' => $type ,'position' => $position]
        );
    }

    public function generate_aleatoire_Alphanum() : String {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $randomString = '';
        $taille = 6;

        for ($i = 0; $i < $taille; $i++) {
            $randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $randomString  ;
    }

    public function closeModal_after_edit( string $nom_modal) : void {
        $this->dispatch('closeModalModilEdit', [
            'name_modal' => $nom_modal,
        ]);
    }

    public function launch_modal(string $nom_modal) : void {
        $this->dispatch('OpenModalModilEdit', [
            'name_modal' => $nom_modal,
        ]);
    }

    
    public function launch_offcanvas(string $nom_modal) : void {
        $this->dispatch('OpenOffcanvas', [
            'id_offcanvas' => $nom_modal,
        ]);
    }

    public function sweetAlert_confirm_options($model, string $title, string $message , $event_retour, $type) : void  {
        $this->dispatch('swal:modalDeleteOptions', [
            'title' => $title,
            'text' => $message,
            'type' => $type,
            'id' => $model->id ,
            'eventRetour' =>  $event_retour,
        ]);
    }

    public function OpenModal_before_delete(string $nom_modal) : void {
        $this->dispatch('OpenModalModilEdit', [
            'name_modal' => $nom_modal,
        ]);
    }

    function resetSummernote($name_summernote)  {
        $this->dispatch('resetSummernote', [
            'name_summernote' => $name_summernote
        ]);
    }


    function sendContentAtSummernote($name_summernote, $content) : void {
        $this->dispatch('contenuModifieSweetAlert', [
            'name_summernote' => $name_summernote,
            'content' =>  $content
        ]);
    }

}
