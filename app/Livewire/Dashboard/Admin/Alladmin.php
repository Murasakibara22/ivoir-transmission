<?php

namespace App\Livewire\Dashboard\Admin;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use App\Livewire\UtilsSweetAlert;
use Illuminate\Support\Facades\Hash;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class Alladmin extends Component
{

    use UtilsSweetAlert, WithFileUploads;

    public  $list_activity_admin;

    public $search = '';

    #[Locked]
    public $id_admin;

    public $nom, $prenom, $dial_code, $phone,
        $phone_number, $email, $password ,$gender ,$AsImage,
         $username_admin, $passord_confirm, $role_id;



    protected $rules = [
        'nom' => 'required|string|min:3|max:255',
        'prenom' => 'required|string|min:3|max:255',
        'dial_code' => 'required|string|max:5',
        'phone_number' => 'required|string|max:10',
        'email' => 'required|email|max:255',
        'gender' => 'required|string|max:6',
        'role_id' => 'required|numeric|exists:roles,id',
    ];

    protected $messages = [
        'nom.required' => 'Le nom est obligatoire !!',
        'nom.max' => 'Le nom ne doit pas dépasser 255 caractères',
        'nom.min' => 'Le nom doit contenir au minimum 3 caractères',
        'prenom.required' => 'Le prenom est obligatoire !!',
        'prenom.max' => 'Le prenom ne doit pas dépasser 255 caractères',
        'prenom.min' => 'Le prenom doit contenir au minimum 3 caractères',
        'dial_code.required' => 'Le code de dial est obligatoire !!',
        'dial_code.max' => 'Le code de dial ne doit pas dépasser 5 caractères',
        'phone_number.required' => 'Le numéro de téléphone est obligatoire !!',
        'phone_number.max' => 'Le numéro de téléphone ne doit pas dépasser 10 caractères',
        'email.required' => 'L\'email est obligatoire !!',
        'email.email' => 'Ce champs doit être une adresse email valide !!',
        'email.unique' => 'Cet email existe déja !!',
        'gender.required' => 'Le genre est obligatoire !!',
        'gender.max' => 'Le genre ne doit pas dépasser 6 caractères',
        'role_id.required' => 'Le role est obligatoire !!',
    ];

    public function updated($propertyusername)
    {
        $this->validateOnly($propertyusername);
    }

    function addAdmin()  {
        $this->launch_modal('add_admin');
    }

    function store()  {
        $this->validate();

        $admin_exist = User::where('role_id','!=',Role::where('libelle','!=','Utilisateur')->first()->id)->where('email', $this->email)->first();
        if($admin_exist){
            $this->send_event_at_sweetAlerte("Erreur","Un administrateur existe déja avec cette adresse email !!","error");
            return;
        }

        $nom = ucfirst(strtolower($this->nom));
        $prenom = ucfirst(strtolower($this->prenom));
        $username = $nom.' '.$prenom;
        $phone = $this->dial_code.$this->phone_number;
        $email = strtolower($this->email);

        $admin_exist_number = User::where('role_id','!=',Role::where('libelle','!=','Utilisateur')->first()->id)->where('phone', $this->phone)->first();
        if($admin_exist_number){
            $this->send_event_at_sweetAlerte("Erreur","Un administrateur existe déja avec ce numéro de téléphone !!","error");
            return;
        }


        $admin = new User();
        $admin->nom = $nom;
        $admin->prenom = $prenom;
        $admin->dial_code = $this->dial_code;
        $admin->username = $username;
        $admin->phone = $phone;
        $admin->phone_number = $this->phone_number;
        $admin->email = $email;
        $admin->role_id = $this->role_id;
        $admin->password = Hash::make($this->password);
        $admin->gender = $this->gender;
        $admin->slug = generateSlug('User',$admin->usernanme);
        if($this->AsImage){
            $img = $this->AsImage;
            $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                'folder' => 'twins',
                'transformation' => [
                    'width' => 150,
                    'height' => 150,
                    'crop' => 'fill'
                ]
            ]);

            $publicId = $uploadedImage->getPublicId();

            $imageUrl = Cloudinary::getUrl($publicId);

            $admin->photo_url  = $imageUrl;
        }
        $admin->save();

        // Log
        //ActivityLog("Enregistrement d'un nouvel administrateur : ".$admin->username, "Admin");

        $this->send_event_at_sweetAlerte("enregistrement effectuer !!","Administrateur enregistrer avec succès","success");
        $this->resetExcept(['list_dial_code']);

    }

    function editAdmin($id)  {
        $admin = User::find($id);
        if(!$admin){
            $this->send_event_at_sweetAlerte("Erreur","Cet administrateur n'existe pas !!","error");
            return;
        }

        $this->id_admin = $admin->id;
        $this->nom = $admin->nom;
        $this->prenom = $admin->prenom;
        $this->dial_code = $admin->dial_code;
        $this->phone_number = $admin->phone_number;
        $this->email = $admin->email;
        $this->gender = $admin->gender;
        $this->role_id = $admin->role_id;

        $this->launch_modal('edit_admin');
    }

    function updateUser()  {
        $admin = User::find($this->id_admin);
        if(!$admin){
            $this->send_event_at_sweetAlerte("Erreur","Cet administrateur n'existe pas !!","error");
            return;
        }

        $admin_exist  = User::where('email', $this->email)->where('id', '!=', $this->id_admin)->where('role_id','!=',Role::where('libelle','!=','Utilisateur')->first()->id)->first();
        if($admin_exist){
            $this->send_event_at_sweetAlerte("Erreur","Un administrateur existe déja avec cette adresse email !!","error");
            return;
        }

        $admin_phone_exist  = User::where('phone_number', $this->phone_number)->where('id', '!=', $this->id_admin)->where('role_id','!=',Role::where('libelle','!=','Utilisateur')->first()->id)->first();
        if($admin_phone_exist){
            $this->send_event_at_sweetAlerte("Erreur","Un administrateur existe déja avec ce numéro de téléphone !!","error");
            return;
        }

        $nom = ucfirst(strtolower($this->nom));
        $prenom = ucfirst(strtolower($this->prenom));
        $username = $nom.' '.$prenom;
        $phone = $this->dial_code.$this->phone_number;
        $email = strtolower($this->email);


        $admin->nom = $nom;
        $admin->prenom = $prenom;
        $admin->dial_code = $this->dial_code;
        $admin->username = $username;
        $admin->phone = $phone;
        $admin->phone_number = $this->phone_number;
        $admin->email = $email;
        $admin->role_id = $this->role_id;
        $admin->gender = $this->gender;
        if($this->AsImage){
            // Extraire le public ID à partir de l'URL de l'image
            $publicId = pathinfo(parse_url($admin->photo_url, PHP_URL_PATH), PATHINFO_FILENAME);

            if($publicId){
                // Supprimer l'image de Cloudinary
                $result = Cloudinary::destroy('twins/' . $publicId);
            }

            $uploadedImage = Cloudinary::upload($this->AsImage->getRealPath(),[
                'folder' => 'twins',
                'transformation' => [
                    'width' => 150,
                    'height' => 150,
                    'crop' => 'fill'
                ]
            ]);

            $publicId = $uploadedImage->getPublicId();

            $imageUrl = Cloudinary::getUrl($publicId);

           $admin->photo_url  = $imageUrl;
        }

        $admin->update();

        // Log
        //ActivityLog("Modification d'un administrateur : ".$admin->username, "Admin");

        $this->send_event_at_sweetAlerte("Modification effectuer !!","Administrateur modifier avec succès","success");
        $this->resetExcept(['list_dial_code']);
        $this->closeModal_after_edit('edit_admin');
    }

    function deleteAdmin($id) {
        $admin = User::find($id);
        if(!$admin){
            $this->send_event_at_sweetAlerte("Erreur","Cet administrateur n'existe pas !!","error");
            return;
        }

        $this->id_admin = $admin->id;
        $this->username_admin = $admin->username;
        $this->launch_modal('delete_admin');
    }

    function destroyUser() {
        $admin = User::find($this->id_admin);

        if(!$admin){
            $this->send_event_at_sweetAlerte("Erreur","Cet administrateur n'existe pas !!","error");
            return;
        }

        //Verifier que le mot de passe de l'admin connecter pareil avec  le mot de passe renseigner
        if(!Hash::check($this->passord_confirm, auth()->user()->password)){
            $this->send_event_at_toast('Mot de passe incorrect !!','error','bottom-right');
            return;
        }

        $publicId = pathinfo(parse_url($admin->photo_url, PHP_URL_PATH), PATHINFO_FILENAME);

        if($publicId){
            // Supprimer l'image de Cloudinary
            $result = Cloudinary::destroy('twins/' . $publicId);
        }

        $admin->delete();

        // Log
        //ActivityLog("Suppression d'un administrateur : ".$admin->username, "Admin");

        $this->send_event_at_sweetAlerte("Suppression effectuer !!","Administrateur supprimer avec succès","success");
        $this->resetExcept(['list_dial_code']);
        $this->closeModal_after_edit('delete_admin');
    }

    function restoreAdmin($id)  {
        $admin = User::where('deleted_at', '!=', null)->find($id);
        if(!$admin){
            $this->send_event_at_sweetAlerte("Erreur","Cet administrateur n'existe pas ou n'est pas supprimer !!","error");
            return;
        }

        $admin->deleted_at = null;
        $admin->update();

        // Log
        //ActivityLog("Restauration d'un administrateur :".$admin->username, "Admin");

        $this->send_event_at_sweetAlerte("Restauration effectuer !!","Administrateur restaure avec succès","success");
        $this->resetExcept(['list_dial_code']);
    }

    function showActivityAddmin($id)  {
        $admin = User::find($id);
        if(!$admin){
            $this->send_event_at_sweetAlerte("Erreur","Cet administrateur n'existe pas !!","error");
            return;
        }

        $this->id_admin = $admin->id;
        $this->username_admin = $admin->username;

        $this->list_activity_admin = $admin->Historique()->orderBy('created_at', 'desc')->get();
        $this->launch_modal('show_activity_admin');
    }





    function generatePasswordAleatoire()  {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $this->password = implode($pass);
    }

    public function render()
    {
        return view('livewire.dashboard.admin.alladmin',[
            'list_users' => User::where('username','like','%'.$this->search.'%')->where('role_id','!=',Role::where('libelle','Utilisateur')->first()->id)->OrderBy('username','asc')->get(),
            'lsit_role' => Role::where('libelle','!=','Utilisateur')->get()
        ]);
    }
}
