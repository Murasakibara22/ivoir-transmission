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
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

class Allrole extends Component
{
    use UtilsSweetAlert, WithPagination;

    private $createservice, $getDataservice, $updateservice, $deleteservice;

    #[Locked]
    public $id_role;

    public $libelle , $description;
    public $select_menu = [];

    public $list_admin_role ;

    public function mount()  {
        $this->createservice = new CreateService();
        $this->getDataservice = new GetDataService();
        $this->deleteservice = new DeleteService();
        $this->updateservice = new UpdateService();
    }


    protected $rules = [
        'libelle' => 'required|min:2|max:40|unique:roles,libelle',
        'select_menu' => 'required|array|min:1',
    ];

    protected $messages = [
        'libelle.required' => 'Le libelle est obligatoire.',
        'libelle.min' => 'Le libellé doit avoir au moins 2 caractères.',
        'libelle.max' => 'Le libellé doit avoir au maximum 40 caractères.',
        'libelle.unique' => 'Un role avec ce libellé existe de déjà.',
        'select_menu.required' => "La sélection d'au moins un menu est obligatoire.",
        'select_menu.min' => "La sélection d'un menu est obligatoire.",
        'select_menu.array' => 'Le menu est obligatoire.',
    ];

    public function hydrate()
    {
        $this->createservice = new CreateService();
        $this->getDataservice = new GetDataService();
        $this->deleteservice = new DeleteService();
        $this->updateservice = new UpdateService();
    }


    public function createRole(){
        $this->reset();
        $this->launch_modal('add_role');
    }

    public function saveRole() {
        $this->validate();

        $role_id = $this->createservice->createRole([
            'libelle' => $this->libelle,
            'description' => $this->description,
        ]);

        $this->createservice->createRoleMenu($this->select_menu, $role_id);

        $this->send_event_at_sweetAlerte('Action reussite !!', 'Le role a bien été ajouté', 'success');
        $this->reset();
    }

    public function editRole($id)  {
        $role = $this->getDataservice->getOneRole($id);

        $this->id_role = $role->id;
        $this->libelle = $role->libelle;
        $this->description = $role->description;
        $this->select_menu = $this->getDataservice->getRoleMenuid($role->id);

        $this->launch_modal('edit_role');
    }

    public function updateRole() {
        $role = $this->getDataservice->getOneRole($this->id_role);
        if(empty($role)) {
            $this->send_event_at_sweetAlerte('Action echouée !!', 'Le role n\'existe pas', 'error');
            return ;
        }

        $this->validate([
            'libelle' => 'required|min:2|max:40|unique:roles,libelle,'.$this->id_role.',id',
            'select_menu' => 'required|array|min:1',
        ],[
            'libelle.unique' => 'Un role avec ce libellé existe de déjà.',
            'libelle.required' => 'Le libelle est obligatoire.',
            'libelle.min' => 'Le libellé doit avoir au moins 2 caractères.',
            'libelle.max' => 'Le libellé doit avoir au maximum 40 caractères.',
            'select_menu.required' => "La sélection d'au moins un menu est obligatoire.",
            'select_menu.min' => "La sélection d'un menu est obligatoire.",
            'select_menu.array' => 'Le menu est obligatoire.',

        ]);

         $this->updateservice->updateRole([
            'libelle' => $this->libelle,
            'description' => $this->description,
        ], $this->id_role);


        $status = $this->updateservice->updateRoleMenu($this->select_menu, $this->id_role);
        if($status == false) {
            $this->send_event_at_sweetAlerte('Action echouée !!', 'Une erreur s\'est produite lors de l\'association des menus', 'error');
            return ;
        }
        $this->send_event_at_sweetAlerte('Action reussite !!', 'Le role a bien été modifié', 'success');
        $this->reset();
        $this->closeModal_after_edit('edit_role');
    }

    public function deleteRole($id)  {
        $role = $this->getDataservice->getOneRole($id);
        if(empty($role)) {
            $this->send_event_at_sweetAlerte('Action echouée !!', 'Le role n\'existe pas', 'error');
            return ;
        }

        $this->sweetAlert_confirm_options($role ,"Supperssion du role","Etes-vous sur de vouloir supprimer le role : $role->libelle","DestoyRole", "error");
    }

    #[on('DestoyRole')]
    public function DestoyRoles($id)  {
        $role = $this->getDataservice->getOneRole($id);
        if(empty($role)) {
            $this->send_event_at_sweetAlerte('Action echouée !!', 'Le role n\'existe pas', 'error');
            return ;
        }

        $status = $this->deleteservice->deleteRole($id);
        if($status == false) {
            $this->send_event_at_sweetAlerte('Action echouée !!', 'Le role n\'a pu etre supprimé car une erreur s\'est produite', 'error');
            return ;
        }
        $this->send_event_at_toast("Supression Effectuer !!", "success", "bottom-end");
        $this->reset();
    }

    public function showAdmin($id)  {

        $role = $this->getDataservice->getOneRole($id);
        if(empty($role)) {
            $this->send_event_at_sweetAlerte('Action echouée !!', 'Le role n\'existe pas', 'error');
            return ;
        }

        $this->list_admin_role = $this->getDataservice->getAllAdminByRole($id)->take(8)->get();
        $this->libelle = $role->libelle;
        $this->launch_modal('show_admin');
    }


    public function render()
    {
        return view('livewire.dashboard.role.allrole', [
            'list_menus' => Menu::all(),
            'list_roles' => $this->getDataservice->getAllRole()->where('libelle', '!=', 'Utilisateur')->OrderBy('created_at', 'desc')->paginate(5),
        ]);
    }
}
