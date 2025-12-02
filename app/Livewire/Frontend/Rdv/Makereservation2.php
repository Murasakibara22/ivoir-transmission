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

    // Gestion des steps
    public $currentStep = 1;
    public $completedSteps = [];

    // Step 1: Informations sur le rendez-vous
    public $adresse_livraison, $date_rdv, $time_rdv, $location, $detail_rdv, $categorie;
    public $montant_service = 50000;
    public $list_service_select;
    public $select_service = [];
    public $select_commune;
    public $showCommune = false;
    public $joursAutorises = [];
    public $required_service = [];

    // Modal position
    public $showPositionModal = false;
    public $tempAddress = '';
    public $tempLocation = null;
    public $confirmedPosition = false;

    // Step 2: Véhicule
    public $select_marque, $select_type, $detail_vehicule, $chassis, $year_vehicule, $infos_supp_vehicules;
    public $AsImages = [];

    // Step 3: Paiement
    public $username, $contact_livraison, $email_livraison;
    public $dialCode = "225";

    protected $listeners = ['confirmPosition'];

    // ==================== GESTION DES STEPS ====================

    public function goToStep($step)
    {
        // Validation avant de passer à l'étape suivante
        if ($step > $this->currentStep) {
            if (!$this->validateCurrentStep()) {
                return;
            }
            // Marquer l'étape actuelle comme complétée
            if (!in_array($this->currentStep, $this->completedSteps)) {
                $this->completedSteps[] = $this->currentStep;
            }
        }

        $this->currentStep = $step;
        $this->dispatch('stepChanged', $step);
    }

    public function nextStep()
    {
        $this->goToStep($this->currentStep + 1);
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            $this->dispatch('stepChanged', $this->currentStep);
        }
    }

    private function validateCurrentStep()
    {
        switch ($this->currentStep) {
            case 1:
                return $this->validateStep1();
            case 2:
                return $this->validateStep2();
            case 3:
                return $this->validateStep3();
            default:
                return true;
        }
    }

    private function validateStep1()
    {
        try {
            $this->validate([
                'adresse_livraison' => 'required',
                'date_rdv' => 'required',
                'time_rdv' => 'required',
                'select_commune' => 'required',
            ], [
                'adresse_livraison.required' => 'L\'adresse est obligatoire',
                'date_rdv.required' => 'La date est obligatoire',
                'time_rdv.required' => 'L\'heure est obligatoire',
                'select_commune.required' => 'La commune est obligatoire',
            ]);
            return true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->send_event_at_sweetAlerte(
                'Informations incomplètes',
                'Veuillez remplir tous les champs obligatoires',
                'warning'
            );
            throw $e;
        }
    }

    private function validateStep2()
    {
        try {
            $this->validate([
                'chassis' => 'required',
            ], [
                'chassis.required' => 'Le numéro de châssis est obligatoire',
            ]);

            // Si pas de marque et type sélectionnés, détails requis
            if ($this->select_marque == null && $this->select_type == null) {
                $this->validate([
                    'detail_vehicule' => 'required',
                ], [
                    'detail_vehicule.required' => 'Veuillez renseigner les détails du véhicule',
                ]);
            }
            return true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->send_event_at_sweetAlerte(
                'Informations véhicule incomplètes',
                'Veuillez remplir tous les champs obligatoires',
                'warning'
            );
            throw $e;
        }
    }

    private function validateStep3()
    {
        try {
            $this->validate([
                'contact_livraison' => 'required|numeric|min:8',
            ], [
                'contact_livraison.required' => 'Le contact est obligatoire',
                'contact_livraison.min' => 'Le contact doit contenir au moins 8 chiffres',
                'contact_livraison.numeric' => 'Le contact doit être numérique',
            ]);
            return true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->send_event_at_sweetAlerte(
                'Informations paiement incomplètes',
                'Veuillez renseigner un numéro de téléphone valide',
                'warning'
            );
            throw $e;
        }
    }

    // ==================== LOGIQUE MÉTIER (inchangée) ====================

    public function updatedSelectCommune()
    {
        if ($this->select_commune == null) {
            $this->joursAutorises = [];
            $this->send_event_at_sweetAlerte('Sélectionnez une commune !!', 'Veuillez choisir une commune dans la liste', 'info');
            $this->showCommune = true;
            return;
        }

        $commune = Commune::where('nom', $this->select_commune)->first();

        if (!$commune || !$commune->jours) {
            $this->joursAutorises = [];
            return;
        }

        $joursBruts = is_string($commune->jours) ? json_decode($commune->jours, true) : $commune->jours;

        if (!is_array($joursBruts)) {
            $this->joursAutorises = [];
            return;
        }

        $joursMapping = [
            'lundi' => 'Monday',
            'mardi' => 'Tuesday',
            'mercredi' => 'Wednesday',
            'jeudi' => 'Thursday',
            'vendredi' => 'Friday',
            'samedi' => 'Saturday',
            'dimanche' => 'Sunday'
        ];

        $joursPermisEnglish = collect($joursBruts)
            ->map(fn($jour) => $joursMapping[strtolower($jour)] ?? null)
            ->filter()
            ->toArray();

        $dates = [];
        $today = Carbon::today();
        $endPeriod = Carbon::now()->addDays(60);

        Carbon::setLocale('fr');

        for ($date = $today->copy(); $date->lte($endPeriod); $date->addDay()) {
            $jourEnCours = $date->format('l');

            if (in_array($jourEnCours, $joursPermisEnglish)) {
                $dates[$date->format('Y-m-d')] = $date->isoFormat('dddd DD MMMM YYYY');
            }
        }

        $this->joursAutorises = $dates;
        if ($commune->frais_service == 0 || $commune->frais_service == null) {
            $this->montant_service = 50000;
        } else {
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

    public function confirmPosition($location)
    {
        $this->adresse_livraison = $location['adresse'];
        $this->latitude = $location['latitude'];
        $this->longitude = $location['longitude'];
        $this->showPositionModal = false;
        $this->dispatch('positionConfirmed');
    }

    public function closePositionModal()
    {
        $this->showPositionModal = false;
    }

    public function updatedCategorie()
    {
        $categorie = CategorieService::where('libelle', $this->categorie)->first();

        if (!$categorie || $categorie->services->count() == 0) {
            $this->list_service_select = [];
            $this->select_service = [];
            $this->required_service = [];
            $this->send_event_at_sweetAlerte("Aucun service", "Cette catégorie ne contient aucun service", "warning");
            return;
        }

        $this->list_service_select = $categorie->services;
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

        $this->select_service = $this->required_service;
    }

    public function updatedChassis()
    {
        if (strlen($this->chassis) > 9 || strlen($this->chassis) < 17) {
            $vehicule = $this->decodeChassis($this->chassis);

            if ($vehicule == null) {
                $this->detail_vehicule = "";
                $this->reset('select_marque', 'select_type', 'year_vehicule');
                return;
            }

            $this->select_marque = $vehicule['marque'];
            $this->select_type = $vehicule['type_vehicule'];
            $this->year_vehicule = $vehicule['annee'];
            $this->detail_vehicule = "";
            $this->infos_supp_vehicules = " Marque : " . $vehicule['marque'] . ", Type : " . $vehicule['type_vehicule'] . ", Année : " . $vehicule['annee'] . ", Modèle : " . $vehicule['modele'] . ", Carburant : " . $vehicule['carburant'];
        }
    }

    public function SubmitRendezVous()
    {
        // Validation finale de l'étape 3
        if (!$this->validateStep3()) {
            return;
        }

        $description = $this->detail_vehicule . " " . $this->detail_rdv;

        if (auth()->check() == false) {
            $this->loginUser();
        }

        $reservation = new Reservation();
        $reservation->montant = $this->montant_service;
        $reservation->chassis = $this->chassis;
        $reservation->description = $description . "( " . $this->infos_supp_vehicules . " )";
        $reservation->adresse_name = $this->adresse_livraison;
        $reservation->location = $this->location;
        $reservation->date_debut = Carbon::parse($this->date_rdv . ' ' . $this->time_rdv);
        $reservation->user_id = auth()->user()->id;
        $reservation->name_prestataire = auth()->user()->username ?? null;
        $reservation->service_id = null;
        $reservation->category = $this->categorie ?? null;
        $reservation->outils = json_encode($this->select_service);
        $reservation->slug = generateSlug('Reservation', $this->adresse_livraison);

        if ($this->AsImages) {
            $table_img = [];
            foreach ($this->AsImages as $key => $value) {
                $img = $value;
                $messi = md5($img->getClientOriginalExtension() . time() . $value) . "." . $img->getClientOriginalExtension();

                $uploadedImage = Cloudinary::upload($img->getRealPath(), [
                    'folder' => 'ivoireTransmission',
                    'transformation' => [
                        'width' => 900,
                        'height' => 900,
                        'crop' => 'fill'
                    ]
                ]);

                $publicId = $uploadedImage->getPublicId();
                $imageUrl = Cloudinary::getUrl($publicId);
                $table_img[] = $imageUrl;
            }
            $reservation->images = json_encode($table_img);
        }
        $reservation->commune = $this->select_commune;
        $reservation->save();

        $message = "Un rendez-vous viens d'être pris par le numero " . auth()->user()->phone_number . " pour le : " . $this->date_rdv . " a " . $this->time_rdv . " et elle est en attente de paiement";
        NotificationAdmin::create([
            'title' => 'Nouvelle réservation en attente',
            'subtitle' => $message,
            'type' => 'reservation',
            'meta_data_id' => $reservation->slug,
            'meta_data_type' => Reservation::class,
        ]);

        User::where('role_id', '!=', Role::where('libelle', 'Utilisateur')->first()->id)->get()->each(function ($user) use ($reservation, $message) {
            broadcast(new MessageSend($user->id, $message, $reservation->slug));
        });

        $url_payment = PaymentService::store($reservation->id, $this->contact_livraison);
        return redirect()->to($url_payment);
    }

    function loginUser()
    {
        $contact = "+" . $this->dialCode . $this->contact_livraison;

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
        if (strlen($vin) < 10 || strlen($vin) > 17) {
            return;
        }

        $url = "https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVin/{$vin}?format=json";
        $response = Http::get($url);

        if ($response->failed()) {
            return;
        }

        $data = $response->json();
        $decodedInfo = collect($data['Results'])->mapWithKeys(function ($item) {
            return [$item['Variable'] => $item['Value']];
        });

        $vehicleInfo = [
            'marque' => $decodedInfo->get('Make'),
            'modele' => $decodedInfo->get('Model'),
            'annee' => $decodedInfo->get('Model Year'),
            'carburant' => $decodedInfo->get('Fuel Type - Primary'),
            'type_vehicule' => $decodedInfo->get('Vehicle Type'),
        ];

        if (!$vehicleInfo['marque'] || !$vehicleInfo['modele'] || !$vehicleInfo['annee']) {
        } else {
            $imageUrl = null;
            $carQueryUrl = "https://www.carimagery.com/api.asmx/GetImageUrl?searchTerm={$vehicleInfo['marque']}+{$vehicleInfo['modele']}+{$vehicleInfo['annee']}";

            $imageResponse = Http::get($carQueryUrl);
            if ($imageResponse->successful() && $imageResponse->body()) {
                $imageUrl = trim(strip_tags($imageResponse->body()));
            }
        }

        return array_merge($vehicleInfo, ['image' => $imageUrl ?? null]);
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
