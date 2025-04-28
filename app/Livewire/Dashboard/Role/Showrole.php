<?php

namespace App\Livewire\Dashboard\Role;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\CreateService;
use App\Services\DeleteService;
use App\Services\UpdateService;
use App\Services\GetDataService;
use App\Livewire\UtilsSweetAlert;

class Showrole extends Component
{
    use UtilsSweetAlert, WithPagination;

    public $show_role ;

    public function mount($role) {
        $this->show_role = $role;

        $this->createservice = new CreateService();
        $this->getDataservice = new GetDataService();
        $this->deleteservice = new DeleteService();
        $this->updateservice = new UpdateService();
    }

    public function hydrate()
    {
        $this->createservice = new CreateService();
        $this->getDataservice = new GetDataService();
        $this->deleteservice = new DeleteService();
        $this->updateservice = new UpdateService();
    }

    public function AttachRightMenu($menu_id, $droit)  {
        $status = $this->createservice->addRightToRoleMenu($this->show_role->id, $menu_id, [$droit]);
        if(!$status){
            $this->send_event_at_sweet_alert_not_timer('Erreur', "Une erreur est survenue lors de l'ajout du droit $droit au menu App\Models\Menu::find($menu_id)->libelle",'error');
            return ;
        }

        $this->send_event_at_toast("Droit: $droit ajouter avec succes au menu ".Menu::find($menu_id)->libelle ."!!", "success", "bottom-end");
    }

    public function distachRightMenu($menu_id, $droit)  {
        $status = $this->deleteservice->distachRightToRoleMenu($this->show_role->id, $menu_id, [$droit]);
        if(!$status){
            $this->send_event_at_sweet_alert_not_timer('Erreur', "Une erreur est survenue lors de la suppression du droit $droit au menu App\Models\Menu::find($menu_id)->libelle",'error');
            return ;
        }

        $this->send_event_at_toast("Le Droit: $droit a été supprimer avec succes du menu ".Menu::find($menu_id)->libelle ."!!", "info", "bottom-end");
    }

    public function render()
    {
        return view('livewire.dashboard.role.showrole',[
            'list_menus' => $this->getDataservice->getMenuRole($this->show_role->id),
        ]);
    }
}
