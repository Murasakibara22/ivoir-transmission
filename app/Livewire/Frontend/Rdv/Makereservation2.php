<?php

namespace App\Livewire\Frontend\Rdv;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Marque;
use App\Models\Commune;
use App\Models\Service;
use Livewire\Component;
use App\Events\MessageSend;
use App\Models\Reservation;
use Illuminate\Support\Str;
use App\Models\TypeVehicule;
use Livewire\WithFileUploads;
use App\Models\CategorieService;
use App\Services\PaymentService;
use App\Livewire\UtilsSweetAlert;
use App\Models\NotificationAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Makereservation2 extends Component
{

    use UtilsSweetAlert, WithFileUploads;


    public $adresse_livraison, $date_rdv, $time_rdv, $phone, $location, $detail_rdv, $categorie;
    public $montant_service = 50000;
    public $list_service_select ;
    public $select_service = [];

    public $select_commune ;
    public $showCommune = false ;
    public $joursAutorises = [];

    // Modal position
    public $showPositionModal = false;
    public $tempAddress = '';
    public $tempLocation = null;
    public $confirmedPosition = false;

    //Vehicule
    public $select_marque, $select_type , $detail_vehicule , $chassis, $year_vehicule, $infos_supp_vehicules;
    public $AsImages = [];

    //Paiement
    public $username , $contact_livraison, $email_livraison;

    public $dialCode = "225";

    public $required_service = [];





    public function updatedSelectCommune()
    {
        if($this->select_commune == null){
            $this->joursAutorises = [];
            $this->send_event_at_sweetAlerte('Sélectionnez une commune !!', 'Veuillez choisir une commune dans la liste', 'info');
            $this->showCommune = true;
            return;
        }

        $commune = Commune::where('nom',$this->select_commune)->first();

        if (!$commune || !$commune->jours) {
            $this->joursAutorises = [];
            return;
        }

        // Conversion sûre en tableau
        $joursBruts = is_string($commune->jours) ? json_decode($commune->jours, true) : $commune->jours;

        if (!is_array($joursBruts)) {
            $this->joursAutorises = [];
            return;
        }

        // Mapping des jours français vers les jours anglais de Carbon
        $joursMapping = [
            'lundi' => 'Monday',
            'mardi' => 'Tuesday',
            'mercredi' => 'Wednesday',
            'jeudi' => 'Thursday',
            'vendredi' => 'Friday',
            'samedi' => 'Saturday',
            'dimanche' => 'Sunday'
        ];

        // Convertir les jours français en jours anglais pour Carbon
        $joursPermisEnglish = collect($joursBruts)
            ->map(fn($jour) => $joursMapping[strtolower($jour)] ?? null)
            ->filter()
            ->toArray();

        $dates = [];
        $today = Carbon::today();
        // Étendre sur 60 jours pour avoir plus d'options
        $endPeriod = Carbon::now()->addDays(60);

        // Définir la locale française pour l'affichage
        Carbon::setLocale('fr');

        for ($date = $today->copy(); $date->lte($endPeriod); $date->addDay()) {
            $jourEnCours = $date->format('l'); // Jour en anglais (Monday, Tuesday, etc.)

            if (in_array($jourEnCours, $joursPermisEnglish)) {
                $dates[$date->format('Y-m-d')] = $date->isoFormat('dddd DD MMMM YYYY');
            }
        }

        $this->joursAutorises = $dates;
        if($commune->frais_service == 0 || $commune->frais_service == null){
            $this->montant_service = 50000;
        }else{
            $this->montant_service = $commune->frais_service;
        }
    }

    public function openPositionModal($address, $location)
    {
        $this->tempAddress = $address;
        $this->tempLocation = $location;
        $this->showPositionModal = true;
        $this->dispatch('openMapModal', location: $location);
    }

protected $listeners = ['confirmPosition'];

public function confirmPosition($location)
{
    // Ton code de traitement ici
    $this->adresse_livraison = $location['adresse'];
    $this->latitude = $location['latitude'];
    $this->longitude = $location['longitude'];

    // Fermer le modal
    $this->showPositionModal = false;

    // Émettre un événement de confirmation
    $this->dispatch('positionConfirmed');
}

    public function closePositionModal()
    {
        $this->showPositionModal = false;
        // RETIRER TOUTE CETTE PARTIE :
        // if (!$this->confirmedPosition) {
        //     $this->adresse_livraison = '';
        //     $this->location = null;
        // }
    }

   public function updatedCategorie()
{

    $categorie = CategorieService::where('libelle', $this->categorie)->first();

    if(!$categorie || $categorie->services->count() == 0){
        $this->list_service_select = [];
        $this->select_service = [];
        $this->required_service = [];
        $this->send_event_at_sweetAlerte("Aucun service","Cette catégorie ne contient aucun service","warning");
        return;
    }

    $this->list_service_select = $categorie->services;

    // reset avant d'appliquer les nouveaux
    $this->select_service = [];
    $this->required_service = [];

    switch ($categorie->libelle) {
        case "VIDANGE MOTEUR":
            $this->required_service = ['Huile de moteur', 'Filtre à huile'];
            break;

        case "DIAGNOSTIC ÉLECTRIQUE":
            $this->required_service = ['Diagnostic batterie'];
            break;

        case "VIDANGE DE BOÎTE":
            $this->required_service = ['Filtre de boîte'];
            break;

        default:
            $this->required_service = [];
            break;
    }

    // Ajouter automatiquement les required dans la sélection
    $this->select_service = $this->required_service;
}


    public function updatedChassis()  {

        if(strlen($this->chassis) > 9 || strlen($this->chassis) < 17){
            $vehicule =  $this->decodeChassis($this->chassis);

            if($vehicule == null){
                    $this->detail_vehicule = "";
                    $this->reset('select_marque', 'select_type', 'year_vehicule');
                    return;
            }

            $this->select_marque = $vehicule['marque'];
            $this->select_type = $vehicule['type_vehicule'];
            $this->year_vehicule = $vehicule['annee'];

            $this->detail_vehicule = "";
            $this->infos_supp_vehicules = " Marque : ". $vehicule['marque'] . ", Type : ". $vehicule['type_vehicule'] . ", Annee : ". $vehicule['annee'].", Modèle : ". $vehicule['modele'].", Carburant : ". $vehicule['carburant'];
            // $this->detail_vehicule = $this->detail_vehicule ."( ".$description . " )" ;
        }

    }


    public function SubmitRendezVous(){
        $this->validate([
            'adresse_livraison' => 'required',
            'date_rdv' => 'required',
            'time_rdv' => 'required',
            'chassis' => 'required',
            'contact_livraison' => 'required|numeric|min:8',
            'select_commune' => 'required',
        ],[
            'select_service.required' => 'Le service est obligatoire',
            'adresse_livraison.required' => 'L\'adresse est obligatoire',
            'date_rdv.required' => 'La date est obligatoire',
            'montant_service.required' => 'Le montant est obligatoire',
            'montant_service.min' => 'Le montant doit etre superieur ou egal a 10000',
            'contact_livraison.required' => 'Le contact est obligatoire',
            'contact_livraison.min' => 'Le contact doit etre superieur ou egal a 8',
            'contact_livraison.numeric' => 'Le contact doit etre numerique',
            'chassis.required' => 'Le chassis est obligatoire',
            'select_commune.required' => 'La commune est obligatoire',
            'select_commune.exists' => 'La commune n\'existe pas',
            'time_rdv.required' => 'L\'heure est obligatoire',
        ]);


        // if not selected marque and type vehicule validate detail_vehicule required
        if($this->select_marque == null && $this->select_type == null){
            $this->validate([
                'detail_vehicule' => 'required',
            ]);
        }

        $description = $this->detail_vehicule." ".$this->detail_rdv;

        //if selected marque, verif if marque exist on the model Marque
        // if($this->select_marque != null){
        //     $marque = Marque::where('id', $this->select_marque)->first();
        //     if($marque == null){
        //         $this->validate([
        //             'select_marque' => 'required',
        //         ]);
        //     }
        //     $description = $description.", Marquue: ".$marque->libelle;
        // }

        //if selected type, verif if type exist on the model TypeVehicule
        // if($this->select_type != null){
        //     $type = TypeVehicule::where('id', $this->select_type)->first();
        //     if($type == null){
        //         $this->validate([
        //             'select_type' => 'required',
        //         ]);
        //     }
        //     $description = $description.", Type: ".$type->libelle;
        // }

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
        $reservation->chassis = $this->chassis;
        $reservation->description = $description."( ".$this->infos_supp_vehicules." )";
        $reservation->adresse_name = $this->adresse_livraison;
        $reservation->location = $this->location;
        $reservation->date_debut = Carbon::parse($this->date_rdv . ' ' . $this->time_rdv);
        $reservation->user_id = auth()->user()->id;
        $reservation->name_prestataire =  auth()->user()->username ?? null;
        $reservation->service_id =  null;
        $reservation->category = $this->categorie ?? null;
        $reservation->outils = json_encode($this->select_service);
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
        $reservation->commune = $this->select_commune;
        // dd($reservation);
        $reservation->save();


        $message = "Un rendez-vous viens d'être pris par le numero ".auth()->user()->phone_number." pour le : ".$this->date_rdv." a ". $this->time_rdv." et elle est en attente de paiement";
        NotificationAdmin::create([
            'title' => 'Nouvelle réservation en attente',
            'subtitle' => $message,
            'type' => 'reservation',
            'meta_data_id' => $reservation->slug,
        ]);

        User::where('role_id','!=',Role::where('libelle','Utilisateur')->first()->id)->get()->each(function ($user) use ($reservation,$message) {

            broadcast(new MessageSend($user->id,$message,$reservation->slug));
        });

        $url_payment = PaymentService::store($reservation->id, $this->contact_livraison);
        return redirect()->to($url_payment);



        // $this->send_event_at_sweet_alert_not_timer('Réservation enregistrée', 'Votre réservation a été enregistrée avec succès, vous recevrez un SMS et un lien de paiement pour effectuer le paiement.', 'success');
        // $this->reset();
    }

    function loginUser()  {

        $contact = "+".$this->dialCode .$this->contact_livraison;

        $user = User::where('phone', $contact)->first();
        if (!$user) {
            $user = User::create([
                'phone' => $contact,
                'dial_code' => $this->dialCode,
                'phone_number' => $this->contact_livraison,
                'email' => $this->email_livraison ?? null,
                'password' => Hash::make(Str::random(10)),
                'username' => generateNameCustomer(),
                'slug' => generateSlug('User', generateNameCustomer()),
                'role_id' => Role::where('libelle', 'Utilisateur')->first()->id
            ]);
        }

        $user->email = $this->email_livraison ?? null;
        $user->save();
        Auth::login($user);
    }



    public function decodeChassis($vin)
{
    // Validation du numéro de chassis (VIN)
    if (strlen($vin) < 10 || strlen($vin) > 17) {

            // $this->send_event_at_toast('Le numéro de châssis (VIN) doit contenir entre 10 et 17 caractères.', 'warning', 'bottom-right');
            return;
    }

    // Appel de l'API gratuite de VINCheck.info
    $url = "https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVin/{$vin}?format=json";
    $response = Http::get($url);

    if ($response->failed()) {

    //   $this->send_event_at_toast('Erreur lors de la récupération des informations du véhicule.', 'error', 'bottom-right');
      return;

    }

    // Traitement de la réponse
    $data = $response->json();
    $decodedInfo = collect($data['Results'])->mapWithKeys(function ($item) {
        return [$item['Variable'] => $item['Value']];
    });

    // Extraction des informations clés
    $vehicleInfo = [
        'marque' => $decodedInfo->get('Make'),
        'modele' => $decodedInfo->get('Model'),
        'annee' => $decodedInfo->get('Model Year'),
        'carburant' => $decodedInfo->get('Fuel Type - Primary'),
        'type_vehicule' => $decodedInfo->get('Vehicle Type'),
    ];



    // Vérification si les informations sont disponibles
    if (!$vehicleInfo['marque'] || !$vehicleInfo['modele'] || !$vehicleInfo['annee']) {

    }else{
        // Recherche de l'image du véhicule avec CarQuery API
        $imageUrl = null;
        $carQueryUrl = "https://www.carimagery.com/api.asmx/GetImageUrl?searchTerm={$vehicleInfo['marque']}+{$vehicleInfo['modele']}+{$vehicleInfo['annee']}";

        $imageResponse = Http::get($carQueryUrl);
        if ($imageResponse->successful() && $imageResponse->body()) {
            $imageUrl = trim(strip_tags($imageResponse->body())); // Extraction de l'URL de l'image
        }
    }

    return  array_merge($vehicleInfo, ['image' => $imageUrl ?? null]);
}


    public function render()
    {
        return view('livewire.frontend.rdv.makereservation2', [
            'list_service' => Service::OrderBy('libelle', 'asc')->get(),
            'list_marque' => Marque::OrderBy('libelle', 'asc')->get(),
            'list_type' => TypeVehicule::OrderBy('libelle', 'asc')->get(),
            'list_commune' => Commune::OrderBy('nom', 'asc')->get(),
            'list_ctegorie' => CategorieService::OrderBy('libelle', 'asc')->get(),
        ]);
    }
}
