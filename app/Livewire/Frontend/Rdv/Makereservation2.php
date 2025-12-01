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
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Makereservation2 extends Component
{
    use UtilsSweetAlert, WithFileUploads;

    // Type de réservation
    public $bookingType = 'normal'; // 'normal' ou 'sos'

    // Assistant vocal
    public $voiceAssistantEnabled = false;

    // Données communes
    public $adresse_livraison, $date_rdv, $time_rdv, $phone, $location, $detail_rdv, $categorie;
    public $montant_service = 50000;
    public $list_service_select;
    public $select_service = [];

    public $select_commune;
    public $showCommune = false;
    public $joursAutorises = [];
    public $selectedCommuneData = null;

    // Modal position
    public $showPositionModal = false;
    public $tempAddress = '';
    public $tempLocation = null;
    public $confirmedPosition = false;

    // Véhicule
    public $select_marque, $select_type, $detail_vehicule, $chassis, $year_vehicule, $infos_supp_vehicules;
    public $AsImages = [];
    public $problemPhoto = null; // Photo du problème pour SOS

    // OCR & Mode de saisie
    public $inputMode = null; // 'scan' ou 'manual'
    public $chassisImage = null;
    public $isProcessingOCR = false;
    public $ocrError = null;
    public $ocrSuccess = false;

    // Paiement
    public $username, $contact_livraison, $email_livraison;
    public $dialCode = "225";
    public $required_service = [];

    // SOS Express
    public $showSosModal = false;
    public $sosStep = 1;
    public $sosService = null;

    // Pas de mapping - on utilise directement les CategorieService

    protected $listeners = [
        'confirmPosition' => 'confirmPosition',
    ];

    public function mount()
    {
        $this->list_service_select = CategorieService::with('services')->get();

        if (Auth::check()) {
            $this->contact_livraison = Auth::user()->phone_number;
            $this->email_livraison = Auth::user()->email;
            $this->username = Auth::user()->name;
        }
    }

    // ==================== ASSISTANT VOCAL ====================

    public function toggleVoiceAssistant()
    {
        $this->voiceAssistantEnabled = !$this->voiceAssistantEnabled;

        $message = $this->voiceAssistantEnabled
            ? "Assistant vocal activé. Je vais vous guider à chaque étape."
            : "Assistant vocal désactivé.";

        $this->dispatch('voiceAssistantToggled',
            enabled: $this->voiceAssistantEnabled,
            message: $message
        );
    }

    // ==================== MODE DE RÉSERVATION ====================

    public function switchBookingType($type)
    {
        $this->bookingType = $type;

        if ($type === 'sos') {
            $this->openSosModal();
        }

        if ($this->voiceAssistantEnabled) {
            $message = $type === 'sos'
                ? "Mode SOS activé. Nous interviendrons dans 30 à 45 minutes."
                : "Mode réservation planifiée activé.";

            $this->dispatch('speakText', text: $message);
        }
    }

    // ==================== MODAL SOS EXPRESS ====================

    public function openSosModal()
    {
        $this->showSosModal = true;
        $this->sosStep = 1;
        $this->resetSosData();

        if ($this->voiceAssistantEnabled) {
            $this->dispatch('speakText', text: "Dépannage express. Étape 1 : Indiquez votre position");
        }
    }

    public function closeSosModal()
    {
        $this->showSosModal = false;
        $this->resetSosData();
    }

    private function resetSosData()
    {
        $this->sosStep = 1;
        $this->sosService = null;
        $this->problemPhoto = null;
        $this->adresse_livraison = '';
        $this->contact_livraison = Auth::check() ? Auth::user()->phone_number : '';
    }

    public function sosNextStep()
    {
        if ($this->sosStep === 1) {
            $this->validate([
                'adresse_livraison' => 'required|string|min:5',
            ], [
                'adresse_livraison.required' => 'Veuillez indiquer votre localisation',
                'adresse_livraison.min' => 'L\'adresse doit contenir au moins 5 caractères',
            ]);

            $this->sosStep = 2;

            if ($this->voiceAssistantEnabled) {
                $this->dispatch('speakText', text: "Étape 2 : Quel est votre problème ?");
            }

        } elseif ($this->sosStep === 2) {
            $this->validate([
                'sosService' => 'required',
            ], [
                'sosService.required' => 'Veuillez sélectionner un type de service',
            ]);

            $this->sosStep = 3;

            if ($this->voiceAssistantEnabled) {
                $this->dispatch('speakText', text: "Étape 3 : Confirmation. Le coût sera de " . number_format($this->montant_service, 0, ',', ' ') . " francs CFA");
            }
        }
    }

    public function sosPreviousStep()
    {
        if ($this->sosStep > 1) {
            $this->sosStep--;
        }
    }

    public function updatedSosService($value)
    {
        // Le sosService contient directement l'ID de la catégorie
        $this->categorie = $value;

        if ($this->voiceAssistantEnabled) {
            $cat = CategorieService::find($value);
            if ($cat) {
                $this->dispatch('speakText', text: "Service " . $cat->libelle . " sélectionné");
            }
        }
    }

    public function confirmSosBooking()
    {
        $this->validate([
            'adresse_livraison' => 'required|string',
            'sosService' => 'required',
            'contact_livraison' => 'required|string',
        ], [
            'contact_livraison.required' => 'Votre numéro de contact est obligatoire',
        ]);

        try {
            // Le categorie est déjà défini via updatedSosService

            // Upload photo du problème si présente
            $problemPhotoUrl = null;
            if ($this->problemPhoto) {
                $problemPhotoUrl = Cloudinary::upload($this->problemPhoto->getRealPath())->getSecurePath();
            }

            // Créer la réservation SOS
            $reservation = new Reservation();
            $reservation->user_id = Auth::check() ? Auth::id() : null;
            $reservation->adresse_name = $this->adresse_livraison;
            $reservation->date_debut = $this->bookingType === "normal" ? $this->date_rdv : now();
            $reservation->time_rdv = now()->format('H:i');
            $reservation->phone = $this->contact_livraison;
            $reservation->montant = $this->montant_service;
            $reservation->status = 'PENDING';
            // $reservation->type = 'SOS_EXPRESS';

            $categorieNom = CategorieService::find($this->sosService)?->libelle ?? 'Service urgent';
            $reservation->detail_rdv = $this->bookingType === "normal" ? 'Réservation planifié: ' . $categorieNom : 'Service SOS: ' . $categorieNom;
            $reservation->slug = Str::random(10) . uniqid();
            $reservation->categorie_service_id = $this->categorie;

            // Location JSON et Commune
            if ($this->tempLocation) {
                $reservation->location = json_encode([
                    'adresse' => $this->tempLocation['adresse'] ?? $this->adresse_livraison,
                    'latitude' => $this->tempLocation['latitude'] ?? null,
                    'longitude' => $this->tempLocation['longitude'] ?? null,
                    'adresse_name' => $this->tempLocation['adresse_name'] ?? null,
                ]);
            }

            if ($this->select_commune) {
                $reservation->commune = $this->select_commune;
            }

            if ($problemPhotoUrl) {
                $reservation->images_vehicule = json_encode([$problemPhotoUrl]);
            }

            $reservation->save();

            // Notification aux admins
            $categorieNom = CategorieService::find($this->sosService)?->libelle ?? 'Service urgent';
            $message = "🚨 DÉPANNAGE SOS URGENT - Contact: " . $this->contact_livraison .
                       " - Service: " . $categorieNom .
                       " - Localisation: " . $this->adresse_livraison;

            NotificationAdmin::create([
                'title' => '🚨 SOS Express - Intervention urgente',
                'subtitle' => $message,
                'type' => 'sos_reservation',
                'meta_data_id' => $reservation->slug,
            ]);

            User::where('role_id', '!=', Role::where('libelle', 'Utilisateur')->first()->id)
                ->get()
                ->each(function ($user) use ($reservation, $message) {
                    broadcast(new MessageSend($user->id, $message, $reservation->slug));
                });

            $this->closeSosModal();
            $this->send_event_at_toast('🚨 Dépannage SOS confirmé ! Notre équipe arrive dans 30-45 min', 'success', 'top-right');

            if ($this->voiceAssistantEnabled) {
                $this->dispatch('speakText', text: "Réservation confirmée. Notre équipe vous contactera dans 2 minutes.");
            }

            return redirect()->route('paiement', ['slug' => $reservation->slug]);

        } catch (\Exception $e) {
            $this->send_event_at_toast('Erreur lors de la réservation. Veuillez réessayer.', 'error', 'top-right');
            \Log::error('Erreur SOS booking: ' . $e->getMessage());
        }
    }

    // ==================== POSITION MODAL ====================

    public function openPositionModal($address = null, $location = null)
    {
        $this->showPositionModal = true;
        $this->tempAddress = $address ?? $this->adresse_livraison;
        $this->tempLocation = $location;
        $this->dispatch('openMapModal', location: $location);

        if ($this->voiceAssistantEnabled) {
            $this->dispatch('speakText', text: "Confirmez votre position sur la carte");
        }
    }

    public function closePositionModal()
    {
        $this->showPositionModal = false;
    }

    public function confirmPosition($location)
    {
        $this->adresse_livraison = $location['adresse'];
        $this->tempLocation = $location;
        $this->confirmedPosition = true;
        $this->showPositionModal = false;

        // La commune est déjà définie par l'autocomplete ou on la détecte
        if (!$this->select_commune) {
            $this->detectCommuneFromAddress($location['adresse']);
        } else {
            // Forcer la mise à jour des dates disponibles
            $this->updatedSelectCommune();
        }

        $this->dispatch('positionConfirmed');

        if ($this->voiceAssistantEnabled) {
            $communeText = $this->select_commune
                ? " dans la commune de " . $this->select_commune
                : "";
            $this->dispatch('speakText', text: "Position confirmée" . $communeText);
        }
    }

    private function detectCommuneFromAddress($address)
    {
        $communes = Commune::all();

        foreach ($communes as $commune) {
            if (stripos($address, $commune->nom) !== false) {
                $this->select_commune = $commune->nom;
                $this->updatedSelectCommune();
                break;
            }
        }
    }

    // ==================== COMMUNES ====================

    public function selectCommune($communeName)
    {
        $commune = Commune::where('nom', $communeName)->first();

        if ($commune) {
            $this->select_commune = $communeName;
            $this->selectedCommuneData = [
                'nom' => $commune->nom,
                'tarif' => 50000,
                'delai' => '2-3 jours'
            ];

            $this->updatedSelectCommune();

            if ($this->voiceAssistantEnabled) {
                $this->dispatch('speakText', text: "Commune " . $communeName . " sélectionnée. Le coût sera de " . number_format($this->montant_service, 0, ',', ' ') . " francs CFA");
            }
        }
    }

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

        if (empty($joursPermisEnglish)) {
            $this->joursAutorises = [];
            return;
        }

        $this->joursAutorises = $this->genererDatesAutorisees($joursPermisEnglish);
    }

    private function genererDatesAutorisees($joursPermis, $nombreJours = 30)
    {
        $dates = [];
        $dateActuelle = Carbon::today();

        for ($i = 0; $i < $nombreJours; $i++) {
            $date = $dateActuelle->copy()->addDays($i);

            if (in_array($date->format('l'), $joursPermis)) {
                $dates[$date->format('Y-m-d')] = $date->translatedFormat('l j F Y');
            }
        }

        return $dates;
    }

    // ==================== SERVICES ====================

    public function updatedCategorie($value)
    {
        if ($this->voiceAssistantEnabled && $value) {
            $categorie = CategorieService::find($value);
            if ($categorie) {
                $this->dispatch('speakText', text: "Catégorie " . $categorie->libelle . " sélectionnée");
            }
        }
    }

    public function updatedSelectService()
    {
        $this->montant_service = 50000;

        if (!empty($this->select_service)) {
            $services = Service::whereIn('id', $this->select_service)->get();
            $montantTotal = $services->sum('prix');
            $this->montant_service += $montantTotal;
        }

        if ($this->voiceAssistantEnabled) {
            $this->dispatch('speakText', text: "Montant total : " . number_format($this->montant_service, 0, ',', ' ') . " francs CFA");
        }
    }

    // ==================== OCR CHASSIS ====================

    public function setInputMode($mode)
    {
        $this->inputMode = $mode;

        if ($mode === 'scan') {
            $this->chassisImage = null;
            $this->ocrError = null;
            $this->ocrSuccess = false;

            if ($this->voiceAssistantEnabled) {
                $this->dispatch('speakText', text: "Mode scan activé. Prenez une photo du numéro de chassis");
            }
        } else {
            if ($this->voiceAssistantEnabled) {
                $this->dispatch('speakText', text: "Mode manuel activé. Entrez les informations du véhicule");
            }
        }
    }

    public function removeChassisImage()
    {
        $this->chassisImage = null;
        $this->ocrError = null;
        $this->ocrSuccess = false;
    }

    public function processOCR()
    {
        $this->validate([
            'chassisImage' => 'required|image|max:5120',
        ]);

        $this->isProcessingOCR = true;
        $this->ocrError = null;

        try {
            $uploadedFile = $this->chassisImage->store('chassis-scans', 'public');
            $extractedText = $this->performOCR($uploadedFile);

            if (empty($extractedText)) {
                throw new \Exception("Aucun texte détecté dans l'image");
            }

            $vin = $this->extractVIN($extractedText);

            if (!$vin) {
                throw new \Exception("Numéro de chassis non détecté. Vérifiez la qualité de l'image");
            }

            $vehicleInfo = $this->decodeVIN($vin);

            $this->chassis = $vin;
            $this->select_marque = $vehicleInfo['make'] ?? '';
            $this->select_type = $vehicleInfo['model'] ?? '';
            $this->year_vehicule = $vehicleInfo['year'] ?? '';

            $this->ocrSuccess = true;
            $this->send_event_at_toast('✅ Informations extraites avec succès!', 'success', 'top-right');

            if ($this->voiceAssistantEnabled) {
                $this->dispatch('speakText', text: "Numéro de chassis détecté avec succès");
            }

        } catch (\Exception $e) {
            $this->ocrError = $e->getMessage();
            $this->inputMode = 'manual';
            $this->send_event_at_toast('⚠️ ' . $e->getMessage() . '. Passez en mode manuel.', 'warning', 'top-right');
            \Log::warning('Échec OCR: ' . $e->getMessage());

        } finally {
            $this->isProcessingOCR = false;
        }
    }

    private function performOCR($imagePath)
    {
        try {
            $vision = new ImageAnnotatorClient([
                'credentials' => config('services.google.vision_credentials')
            ]);

            $imageContent = file_get_contents(storage_path('app/public/' . $imagePath));
            $response = $vision->textDetection($imageContent);
            $texts = $response->getTextAnnotations();

            $vision->close();

            return $texts[0]->getDescription() ?? '';

        } catch (\Exception $e) {
            \Log::error('Erreur OCR Google Vision: ' . $e->getMessage());
            return '';
        }
    }

    private function extractVIN($text)
    {
        $pattern = '/\b[A-HJ-NPR-Z0-9]{17}\b/i';

        if (preg_match($pattern, $text, $matches)) {
            return strtoupper($matches[0]);
        }

        $cleanText = preg_replace('/[^A-HJ-NPR-Z0-9]/i', '', $text);
        if (strlen($cleanText) >= 17) {
            return strtoupper(substr($cleanText, 0, 17));
        }

        return null;
    }

    private function decodeVIN($vin)
    {
        try {
            $response = Http::timeout(10)->get("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVin/{$vin}?format=json");

            if (!$response->successful()) {
                throw new \Exception('API VIN indisponible');
            }

            $data = $response->json();

            return [
                'make' => $this->findVINValue($data, 'Make'),
                'model' => $this->findVINValue($data, 'Model'),
                'year' => $this->findVINValue($data, 'Model Year'),
            ];

        } catch (\Exception $e) {
            \Log::warning('Erreur décodage VIN: ' . $e->getMessage());
            return [];
        }
    }

    private function findVINValue($data, $variableName)
    {
        if (!isset($data['Results']) || !is_array($data['Results'])) {
            return null;
        }

        foreach ($data['Results'] as $item) {
            if (isset($item['Variable']) && $item['Variable'] === $variableName) {
                return $item['Value'] !== '' ? $item['Value'] : null;
            }
        }

        return null;
    }

    // ==================== RÉSERVATION NORMALE ====================

    public function makeReservation()
    {
        $rules = [
            'adresse_livraison' => 'required|string',
            'date_rdv' => 'required|date',
            'time_rdv' => 'required',
            'contact_livraison' => 'required|string',
            'username' => 'nullable|string',
            'email_livraison' => 'nullable|email',
        ];

        // Chassis obligatoire seulement si mode manuel ou OCR réussi
        if ($this->inputMode === 'manual' || $this->ocrSuccess) {
            $rules['chassis'] = 'required|string';
        }

        // Catégorie obligatoire en mode normal
        if ($this->bookingType === 'normal') {
            $rules['categorie'] = 'required';
        }

        $this->validate($rules);

        try {
            $reservation = new Reservation();
            $reservation->user_id = Auth::check() ? Auth::id() : null;
            $reservation->adresse_livraison = $this->adresse_livraison;
            $reservation->date_rdv = $this->date_rdv;
            $reservation->time_rdv = $this->time_rdv;
            $reservation->phone = $this->contact_livraison;
            $reservation->montant = $this->montant_service;
            $reservation->status = 'PENDING';
            $reservation->type = 'NORMAL';
            $reservation->detail_rdv = $this->detail_rdv;
            $reservation->slug = Str::random(10) . uniqid();
            $reservation->categorie_service_id = $this->categorie;

            // Location JSON et Commune
            if ($this->tempLocation) {
                $reservation->location = json_encode([
                    'adresse' => $this->tempLocation['adresse'] ?? $this->adresse_livraison,
                    'latitude' => $this->tempLocation['latitude'] ?? null,
                    'longitude' => $this->tempLocation['longitude'] ?? null,
                    'adresse_name' => $this->tempLocation['adresse_name'] ?? null,
                ]);
            }

            if ($this->select_commune) {
                $reservation->commune = $this->select_commune;
            }

            // Infos véhicule
            if ($this->chassis) {
                $reservation->chassis = $this->chassis;
            }
            if ($this->select_marque) {
                $reservation->marque = $this->select_marque;
            }
            if ($this->select_type) {
                $reservation->modele = $this->select_type;
            }
            if ($this->year_vehicule) {
                $reservation->annee = $this->year_vehicule;
            }

            $reservation->save();

            // Upload images véhicule si présentes
            if (!empty($this->AsImages)) {
                $images = [];
                foreach ($this->AsImages as $image) {
                    $uploadedImage = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    $images[] = $uploadedImage;
                }
                $reservation->images_vehicule = json_encode($images);
                $reservation->save();
            }

            // Notification aux admins
            $message = "Un rendez-vous vient d'être pris par " . $this->contact_livraison .
                       " pour le " . $this->date_rdv . " à " . $this->time_rdv;

            NotificationAdmin::create([
                'title' => 'Nouvelle réservation en attente',
                'subtitle' => $message,
                'type' => 'reservation',
                'meta_data_id' => $reservation->slug,
            ]);

            User::where('role_id', '!=', Role::where('libelle', 'Utilisateur')->first()->id)
                ->get()
                ->each(function ($user) use ($reservation, $message) {
                    broadcast(new MessageSend($user->id, $message, $reservation->slug));
                });

            $this->send_event_at_toast('Réservation créée avec succès !', 'success', 'top-right');

            if ($this->voiceAssistantEnabled) {
                $this->dispatch('speakText', text: "Réservation confirmée. Redirection vers le paiement");
            }

            return redirect()->route('paiement', ['slug' => $reservation->slug]);

        } catch (\Exception $e) {
            $this->send_event_at_toast('Erreur lors de la réservation. Veuillez réessayer.', 'error', 'top-right');
            \Log::error('Erreur réservation: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $list_commune = Commune::all();

        return view('livewire.frontend.rdv.makereservation2', [
            'list_commune' => $list_commune,
        ]);
    }
}
