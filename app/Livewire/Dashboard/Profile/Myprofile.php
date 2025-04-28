<?php

namespace App\Livewire\Dashboard\Profile;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use App\Livewire\UtilsSweetAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Myprofile extends Component
{
    use UtilsSweetAlert, WithFileUploads;

    public $currentPage = "profile";

    public $nom , $prenom , $dial_code, $phone_number , $email,$gender, $AsImage;

    public $new_password,  $old_password , $confirm_password, $otp;

    //Chiffres OTP
    public $one_digits, $two_digits, $three_digits, $four_digits, $five_digits, $six_digits;

    public  $historique_login;

    public  function mount()  {
        $this->nom = auth()->user()->nom;
        $this->prenom = auth()->user()->prenom;
        $this->dial_code = auth()->user()->dial_code;
        $this->phone_number = auth()->user()->phone_number;
        $this->email = auth()->user()->email;
        $this->gender = auth()->user()->gender;

    }

    protected  $rules = [
        'nom' => 'required|string|min:3|max:255',
        'prenom' => 'required|string|min:3|max:255',
        'dial_code' => 'required',
        'phone_number' => 'required',
        'email' => 'required|email|max:255',
        'gender' => 'required',
    ];

    protected $messages = [
        'nom.required' => 'Le nom est obligatoire !!',
        'nom.max' => 'Le nom ne doit pas dépasser 255 caractères',
        'nom.min' => 'Le nom doit contenir au minimum 3 caractères',
        'prenom.max' => 'Le prenom ne doit pas dépasser 255 caractères',
        'prenom.min' => 'Le prenom doit contenir au minimum 3 caractères',
        'prenom.required' => 'Le prenom est obligatoire !!',
        'email.required' => 'L\'email est obligatoire !!',
        'gender.required' => 'Le genre est obligatoire !!',
        'phone_number.required' => 'Le numero de telephone est obligatoire !!',
        'dial_code.required' => 'Le code de telephone est obligatoire !!',
        'email.max' => 'L\'email ne doit pas dépasser 255 caractères',
        'email.email' => 'L\'email n\'est pas valide',
        'email.required' => 'L\'email est obligatoire !!',
        'email.unique' => 'L\'email existe déja !!',
    ];

    public function updated( $propertyName) {
        $this->validateOnly($propertyName);
    }

    public function toggleSection($section) {

        switch ($section) {
            case 'password':
                $this->reset(['new_password', 'old_password', 'confirm_password']);
               $this->currentPage = $section;
                break;
            case 'privacy':
               $this->currentPage = $section;
                break;

            default:
                $this->currentPage = 'profile';
                break;
        }

    }

    public function updateProfile()  {
        $user = auth()->user();

        $admin_exist_email = User::where('email', $this->email)->where('id', '!=', $user->id)->first();
        if($admin_exist_email){
            $this->send_event_at_sweetAlerte("Modification echoue !!","Un  compte existe déja avec cette adresse email !!","error");
            return false;
        }

        $nom = ucfirst(strtolower($this->nom));
        $prenom = ucfirst(strtolower($this->prenom));
        $phone = $this->dial_code.$this->phone_number;
        $email = strtolower($this->email);
        $name = $nom.' '.$prenom;
        if($this->dial_code == ""){
            $dial_code = $user->dial_code;
        }else{
            $dial_code = $this->dial_code;
        }
        if($this->gender == ""){
            $gender = $user->gender;
        }else{
            $gender = $this->gender;
        }

        //Verify if number exist
        $admin_exist_phone = User::where('phone', $phone)->where('id', '!=', $user->id)->first();
        if($admin_exist_phone){
            $this->send_event_at_sweetAlerte("Modification echoue !!","Un  compte existe déja avec ce numero de telephone !!","error");
            return false;
        }


        if($this->AsImage){
            $img = $this->AsImage;
            $messi = md5($img->getClientOriginalExtension().time().$this->AsImage).".".$img->getClientOriginalExtension();

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

            $photo = $imageUrl;
        }


        $user->update([
            'nom' => $nom,
            'prenom' => $prenom,
            'dial_code' => $dial_code,
            'phone_number' => $this->phone_number,
            'phone' => $phone,
            'email' => $email,
            'name' => $name,
            'photo_url' => $photo ?? $user->photo_url,
            'gender' => $this->gender
        ]);


        // Log
        //ActivityLog("Modification du profil", "Admin");

        $this->send_event_at_sweetAlerte("Modification effectuer !!","Administrateur modifier avec succès","success");
        $this->resetExcept(['new_password', 'old_password', 'confirm_password']);
        $this->mount();
    }

    public function updatePassword()  {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ],[
            'old_password.required' => 'Le mot de passe actuel est obligatoire !!',
            'new_password.required' => 'Le nouveau mot de passe est obligatoire !!',
            'new_password.confirmed' => 'Le nouveau mot de passe ne correspond pas !!',
            'confirm_password.required' => 'La confirmation du nouveau mot de passe est obligatoire !!',
            'confirm_password.same' => 'La confirmation du nouveau mot de passe ne correspond pas !!',
        ]);

        $user = auth()->user();
        if(!$user->email){
            $this->send_event_at_sweetAlerte("Information importante !!","Veuillez renseigner votre adresse email afin de recevoir un code OTP ","info");
            return;
        }
        if (!Hash::check($this->old_password, $user->password)) {
            $this->send_event_at_sweetAlerte("Information importante !!","Le mot de passe actuel ne correspond pas !!","error");
            return;
        }

        $otp = random_int(123456, 999999);
        //Mettre en cache
        Cache::put('otp.'.$user->id, $otp, now()->addMinutes(5));

        $user->update();

        Mail::to($user->email)->send(new SendConfirmOTP($user->OTP));

        $this->launch_modal('confirm_otp');

        $this->send_event_at_toast('Un code OTP vous a été envoyer par Email  !!','success','top-right');
        //logique de send OTP via whatsapp



    }


    function SubmitConfirmOTP()  {
        $user = auth()->user();

        $this->validate([
            'one_digits' => 'required | digits:1',
            'two_digits' => 'required | digits:1',
            'three_digits' => 'required | digits:1',
            'four_digits' => 'required | digits:1',
            'five_digits' => 'required | digits:1',
            'six_digits' => 'required | digits:1',
        ],[
            'one_digits.required' => 'Le code OTP est obligatoire !!',
            'two_digits.required' => 'Le code OTP est obligatoire !!',
            'three_digits.required' => 'Le code OTP est obligatoire !!',
            'four_digits.required' => 'Le code OTP est obligatoire !!',
            'five_digits.required' => 'Le code OTP est obligatoire !!',
            'six_digits.required' => 'Le code OTP est obligatoire !!',
            'one_digits.digits' => 'Le code OTP doit contenir 1 chiffre !!',
            'two_digits.digits' => 'Le code OTP doit contenir 1 chiffre !!',
            'three_digits.digits' => 'Le code OTP doit contenir 1 chiffre !!',
            'four_digits.digits' => 'Le code OTP doit contenir 1 chiffre !!',
            'five_digits.digits' => 'Le code OTP doit contenir 1 chiffre !!',
            'six_digits.digits' => 'Le code OTP doit contenir 1 chiffre !!',
        ]);

        $this->otp = $this->one_digits.$this->two_digits.$this->three_digits.$this->four_digits.$this->five_digits.$this->six_digits;

        if($this->otp != $user->OTP){
            $this->send_event_at_toast('Code OTP invalide', 'error', 'bottom-right');
            return ;
        }

        if($this->otp == $user->OTP && $user->OTP_expire_at < now()){
            $this->send_event_at_toast('Code OTP expirer', 'error', 'bottom-right');
            return ;
        }

        $user->OTP_verified_at = now();
        $user->update();

        if (Hash::check($this->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($this->new_password),
            ]);

             // Log
            //ActivityLog("Modification du mot de passe", "Admin");

            $this->send_event_at_sweetAlerte("Modification effectuer !!","Mot de passe modifier avec succès","success");
            $this->reset(['new_password', 'old_password', 'confirm_password']);
        } else {
            $this->send_event_at_sweetAlerte("Modification echoue !!","Modification du  mot de passe echoue","error");
        }

        $this->reset(['new_password', 'old_password', 'confirm_password','otp','one_digits','two_digits','three_digits','four_digits','five_digits','six_digits']);
        $this->closeModal_after_edit('confirm_otp');

    }

    function resend_OTP() {

        $user = auth()->user();

        $OTP = random_int(123456, 999999);

        //Mettre en cache
        Cache::put('otp.'.$user->id, $OTP, now()->addMinutes(5));
        $user->update();

        Mail::to($user->email)->send(new SendConfirmOTP($user->OTP));
        $this->send_event_at_toast('Un code OTP vous a été Reenvoyer par Email  !!','success','top-right');

    }







    public function render()
    {
        return view('livewire.dashboard.profile.myprofile');
    }
}
