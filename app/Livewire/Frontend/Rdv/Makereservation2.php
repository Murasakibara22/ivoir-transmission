<?php

namespace App\Livewire\Frontend\Rdv;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Marque;
use App\Models\Service;
use Livewire\Component;
use App\Models\Reservation;
use App\Models\TypeVehicule;
use Livewire\WithFileUploads;
use App\Services\PaymentService;
use App\Livewire\UtilsSweetAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class Makereservation2 extends Component
{

    use UtilsSweetAlert, WithFileUploads;


    public $adresse_livraison, $date_rdv, $phone, $location, $detail_rdv, $select_service;
    public $montant_service = 50000;

    //Vehicule
    public $select_marque, $select_type , $detail_vehicule;
    public $AsImages = [];

    //Paiement
    public $username , $contact_livraison;

    public $dialCode = "225";


    public function updatedSelectService(){
        if($this->select_service != "Autres"){
            $service = Service::where('id', $this->select_service)->first();
            if($service){
                if($service->frais_service == 0 || $service->frais_service == null){
                    $this->montant_service = 50000;
                }else{
                    $this->montant_service = $service->frais_service;
                }
            }else{
                $this->montant_service = 50000;
            }
        }
    }

    public function SubmitRendezVous(){
        $this->validate([
            'select_service' => 'required|exists:services,id',
            'adresse_livraison' => 'required',
            'date_rdv' => 'required',
            'contact_livraison' => 'required|numeric|min:8',
        ],[
            'select_service.required' => 'Le service est obligatoire',
            'adresse_livraison.required' => 'L\'adresse est obligatoire',
            'date_rdv.required' => 'La date est obligatoire',
            'montant_service.required' => 'Le montant est obligatoire',
            'montant_service.min' => 'Le montant doit etre superieur ou egal a 10000',
            'contact_livraison.required' => 'Le contact est obligatoire',
            'contact_livraison.min' => 'Le contact doit etre superieur ou egal a 8',
            'contact_livraison.numeric' => 'Le contact doit etre numerique',
        ]);


        // if not selected marque and type vehicule validate detail_vehicule required
        if($this->select_marque == null && $this->select_type == null){
            $this->validate([
                'detail_vehicule' => 'required',
            ]);
        }

        $description = $this->detail_vehicule." ".$this->detail_rdv;

        //if selected marque, verif if marque exist on the model Marque
        if($this->select_marque != null){
            $marque = Marque::where('id', $this->select_marque)->first();
            if($marque == null){
                $this->validate([
                    'select_marque' => 'required',
                ]);
            }
            $description = $description.", Marquue: ".$marque->libelle;
        }

        //if selected type, verif if type exist on the model TypeVehicule
        if($this->select_type != null){
            $type = TypeVehicule::where('id', $this->select_type)->first();
            if($type == null){
                $this->validate([
                    'select_type' => 'required',
                ]);
            }
            $description = $description.", Type: ".$type->libelle;
        }

        if(auth()->check() == false){
            $this->loginUser();
        }

        //if select_service is Autres, validate detail_rdv required
        // if($this->select_service == "Autres"){
        //     $this->validate([
        //         'detail_rdv' => 'required',
        //     ]);
        // }


        $reservation = new Reservation();
        $reservation->montant = $this->montant_service;
        $reservation->description = $description;
        $reservation->adresse_name = $this->adresse_livraison;
        $reservation->location = $this->location;
        $reservation->date_debut = Carbon::parse($this->date_rdv);
        $reservation->user_id = auth()->user()->id;
        $reservation->name_prestataire =  auth()->user()->username ?? null;
        $reservation->service_id = $this->select_service;
        $reservation->slug = generateSlug('Reservation', $this->adresse_livraison);


        if($this->AsImages){
            $table_img = [];
            foreach ($this->AsImages as $key => $value) {
                $img = $value;
                $messi = md5($img->getClientOriginalExtension().time().$value).".".$img->getClientOriginalExtension();

                $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                    'folder' => 'ivoireTransmission',
                    'transformation' => [
                        'width' => 900,
                        'height' => 900,
                        'crop' => 'fill'
                    ]
                ]);

                $publicId = $uploadedImage->getPublicId();

                $imageUrl = Cloudinary::getUrl($publicId);

                $table_img[]  = $imageUrl;

            }
         $reservation->images = json_encode($table_img);
        }
        $reservation->save();

        $url_payment = PaymentService::store($reservation->id, $this->contact_livraison);
        return redirect()->to($url_payment);

    }

    function loginUser()  {

        $contact = "+".$this->dialCode .$this->contact_livraison;

        $user = User::where('phone', $contact)->first();
        if (!$user) {
            $user = User::create([
                'phone' => $contact,
                'dial_code' => $this->dialCode,
                'phone_number' => $this->contact_livraison,
                'password' => Hash::make(Str::random(10)),
                'username' => generateNameCustomer(),
                'slug' => generateSlug('User', generateNameCustomer()),
                'role_id' => Role::where('libelle', 'Utilisateur')->first()->id
            ]);
        }

        Auth::login($user);
    }


    public function render()
    {
        return view('livewire.frontend.rdv.makereservation2', [
            'list_service' => Service::OrderBy('libelle', 'asc')->get(),
            'list_marque' => Marque::OrderBy('libelle', 'asc')->get(),
            'list_type' => TypeVehicule::OrderBy('libelle', 'asc')->get(),
        ]);
    }
}
