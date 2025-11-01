<?php

namespace App\Livewire\Entreprise\Vehicules;

use App\Livewire\UtilsSweetAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Vehicule; // Ajoutez ceci
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class ManageVehicule extends Component
{
    use UtilsSweetAlert, WithFileUploads;


    // Modal states
    public $showModal = false;
    public $showDetailsModal = false;
    public $showReservationModal = false;
    public $showHistoriqueModal = false; // NOUVEAU
    public $currentStep = 1;
    public $editMode = false;
    public $vehiculeId = null;

    // Véhicule pour détails/réservation/historique
    public $selectedVehicule = null;

    // Filtres pour l'historique - NOUVEAU
    public $historique_search = '';
    public $historique_type_filter = '';
    public $historique_date_debut = '';
    public $historique_date_fin = '';

    // Form fields pour ajout/modification
    public $libelle;
    public $matricule;
    public $chassis;
    public $marque;
    public $modele;
    public $year;
    public $type;
    public $carburant;
    public $couleur;
    public $kilometrage_actuel = 0;
    public $date_mise_circulation;
    public $description;
    public $date_prochaine_visite;
    public $cout_vidange_estime;
    public $images = [];
    public $imagesPreviews = [];
    public $existingImages = [];

    // Form fields pour réservation - NOUVEAU
    public $reservation_date;
    public $reservation_time;
    public $reservation_type_maintenance;
    public $reservation_description;
    public $reservation_categorie_service_id;


    protected $listeners = [
        'edit-vehicule' => 'editVehicule',
         'open-modal' => 'openModal',
         'show-vehicule-details' => 'showDetails', // NOUVEAU
        'show-reservation-modal' => 'showReservation',
         'show-historique-modal' => 'showHistorique',
    ]; // NOUVEAU


    protected function rules()
    {
        $rules = [
            'libelle' => 'required|string|max:255',
            'chassis' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'modele' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1990|max:2025',
            'type' => 'nullable|string|max:255',
            'carburant' => 'nullable|string|max:50',
            'couleur' => 'nullable|string|max:50',
            'kilometrage_actuel' => 'nullable|integer|min:0',
            'date_mise_circulation' => 'nullable|date',
            'description' => 'nullable|string',
            'date_prochaine_visite' => 'nullable|date',
            'cout_vidange_estime' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:5120',
        ];

        // En mode édition, matricule peut rester le même
        if ($this->editMode && $this->vehiculeId) {
            $rules['matricule'] = 'required|string|max:255|unique:vehicules,matricule,' . $this->vehiculeId;
        } else {
            $rules['matricule'] = 'required|string|max:255|unique:vehicules,matricule';
        }

        return $rules;
    }

    protected $messages = [
        'libelle.required' => 'Le libellé du véhicule est obligatoire',
        'matricule.required' => 'L\'immatriculation est obligatoire',
        'matricule.unique' => 'Cette immatriculation existe déjà',
        'chassis.required' => 'Le numéro de chassis est obligatoire',
        'marque.required' => 'La marque est obligatoire',
        'images.*.image' => 'Le fichier doit être une image',
        'images.*.max' => 'L\'image ne doit pas dépasser 5MB',
    ];

    public function openModal()
    {
        $this->showModal = true;
        $this->currentStep = 1;
        $this->editMode = false;
        $this->vehiculeId = null;
        $this->resetForm();
    }

    // NOUVELLE MÉTHODE - Ouvrir en mode édition
    public function editVehicule($vehiculeId)
    {
        $vehicule = auth('entreprise')->user()->vehicules()->findOrFail($vehiculeId);

        $this->vehiculeId = $vehicule->id;
        $this->editMode = true;
        $this->showModal = true;
        $this->currentStep = 1;

        // Remplir les champs
        $this->libelle = $vehicule->libelle;
        $this->matricule = $vehicule->matricule;
        $this->chassis = $vehicule->chassis;
        $this->marque = $vehicule->marque;
        $this->modele = $vehicule->modele;
        $this->year = $vehicule->year;
        $this->type = $vehicule->type;
        $this->carburant = $vehicule->carburant;
        $this->couleur = $vehicule->couleur;
        $this->kilometrage_actuel = $vehicule->kilometrage_actuel;
        $this->date_mise_circulation = $vehicule->date_mise_circulation;
        $this->description = $vehicule->description;
        $this->date_prochaine_visite = $vehicule->date_prochaine_visite;
        $this->cout_vidange_estime = $vehicule->cout_vidange_estime;

        // Charger les images existantes
        $this->existingImages = json_decode($vehicule->images, true) ?? [];
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->currentStep = 1;
        $this->editMode = false;
        $this->vehiculeId = null;
        $this->resetForm();
        $this->resetValidation();
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'libelle' => 'required|string|max:255',
                'matricule' => $this->editMode && $this->vehiculeId
                    ? 'required|string|max:255|unique:vehicules,matricule,' . $this->vehiculeId
                    : 'required|string|max:255|unique:vehicules,matricule',
                'chassis' => 'required|string|max:255',
                'marque' => 'required|string|max:255',
            ]);
        }

        if ($this->currentStep < 3) {
            $this->currentStep++;
        }
    }

    public function prevStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:5120',
        ]);
    }

    public function removeImage($index)
    {
        array_splice($this->images, $index, 1);
    }

    // NOUVELLE MÉTHODE - Supprimer une image existante
    public function removeExistingImage($index)
    {
        array_splice($this->existingImages, $index, 1);
    }

    public function save()
    {
        $this->validate();

        try {
            // Upload des nouvelles images
            $uploadedImages = [];
            if (!empty($this->images)) {
                foreach ($this->images as $image) {
                    $img = $image;
                    $messi = md5($img->getClientOriginalExtension().time().$img).".".$img->getClientOriginalExtension();

                    $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                        'folder' => 'ivoireTransmission',
                        'transformation' => [
                            'width' => 850,
                            'height' => 638,
                            'crop' => 'fill'
                        ]
                    ]);

                    $publicId = $uploadedImage->getPublicId();

                    $imageUrl = Cloudinary::getUrl($publicId);

                    $uploadedImages[] = $imageUrl;
                }
            }

            // Fusionner avec les images existantes
            $allImages = array_merge($this->existingImages, $uploadedImages);

            $data = [
                'libelle' => $this->libelle,
                'matricule' => $this->matricule,
                'chassis' => $this->chassis,
                'marque' => $this->marque,
                'modele' => $this->modele,
                'year' => $this->year,
                'type' => $this->type,
                'carburant' => $this->carburant,
                'couleur' => $this->couleur,
                'kilometrage_actuel' => $this->kilometrage_actuel ?? 0,
                'date_mise_circulation' => $this->date_mise_circulation,
                'description' => $this->description,
                'date_prochaine_visite' => $this->date_prochaine_visite,
                'cout_vidange_estime' => $this->cout_vidange_estime ?? 0,
                'images' => !empty($allImages) ? json_encode($allImages) : null,
            ];

            if ($this->editMode && $this->vehiculeId) {
                // Mode édition
                $vehicule = auth('entreprise')->user()->vehicules()->findOrFail($this->vehiculeId);
                $vehicule->update($data);

                $this->closeModal();
                $this->send_event_at_toast('Véhicule modifié avec succès!', 'success', 'top-end');
            } else {
                // Mode création
                $data['slug'] = $this->generate_aleatoire_Alphanum() . uniqid();
                $data['status'] = 'ACTIVATED';

                $vehicule = auth('entreprise')->user()->vehicules()->create($data);

                $this->closeModal();
                $this->send_event_at_toast('Véhicule ajouté avec succès!', 'success', 'top-end');
            }

            $this->dispatch('vehicule-created');

        } catch (\Exception $e) {
            $this->send_event_at_sweetAlerte(
                'Erreur',
                'Une erreur est survenue: ' . $e->getMessage(),
                'error'
            );
        }
    }

    private function resetForm()
    {
        $this->libelle = '';
        $this->matricule = '';
        $this->chassis = '';
        $this->marque = '';
        $this->modele = '';
        $this->year = null;
        $this->type = '';
        $this->carburant = '';
        $this->couleur = '';
        $this->kilometrage_actuel = 0;
        $this->date_mise_circulation = null;
        $this->description = '';
        $this->date_prochaine_visite = null;
        $this->cout_vidange_estime = null;
        $this->images = [];
        $this->imagesPreviews = [];
        $this->existingImages = [];
    }









    public function showDetails($vehiculeId)
    {
        $this->selectedVehicule = auth('entreprise')->user()->vehicules()->with('historique_entretiens')->findOrFail($vehiculeId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal()
    {
        $this->showDetailsModal = false;
        $this->selectedVehicule = null;
    }

    public function showReservation($vehiculeId)
    {
        $this->selectedVehicule = auth('entreprise')->user()->vehicules()->findOrFail($vehiculeId);
        $this->showReservationModal = true;
        $this->resetReservationForm();
    }

    public function closeReservationModal()
    {
        $this->showReservationModal = false;
        $this->selectedVehicule = null;
        $this->resetReservationForm();
    }

    public function saveReservation()
    {
        $this->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'reservation_type_maintenance' => 'required|string',
            'reservation_categorie_service_id' => 'required|exists:categorie_services,id',
            'reservation_description' => 'nullable|string',
        ], [
            'reservation_date.required' => 'La date est obligatoire',
            'reservation_date.after_or_equal' => 'La date doit être aujourd\'hui ou dans le futur',
            'reservation_time.required' => 'L\'heure est obligatoire',
            'reservation_type_maintenance.required' => 'Le type de maintenance est obligatoire',
            'reservation_categorie_service_id.required' => 'La catégorie de service est obligatoire',
        ]);

        try {
            $dateTime = $this->reservation_date . ' ' . $this->reservation_time;

            $reservation = auth('entreprise')->user()->reservations()->create([
                'vehicule_id' => $this->selectedVehicule->id,
                'date_debut' => $dateTime,
                'type_maintenance' => $this->reservation_type_maintenance,
                'category' => $this->reservation_categorie_service_id,
                'description' => $this->reservation_description ?? '',
                'chassis' => $this->selectedVehicule->chassis,
                'status' => 'PENDING',
                'status_paiement' => 'PENDING',
                'adresse_name' => 'À définir', // À compléter selon votre logique
                'location' => json_encode(['adresse' => 'À définir']),
                'slug' => $this->generate_aleatoire_Alphanum() . uniqid(),
            ]);

            $this->closeReservationModal();
            $this->send_event_at_toast('Réservation créée avec succès!', 'success', 'top-end');
            $this->dispatch('reservation-created');

        } catch (\Exception $e) {
            $this->send_event_at_sweetAlerte(
                'Erreur',
                'Une erreur est survenue lors de la réservation: ' . $e->getMessage(),
                'error'
            );
        }
    }

    private function resetReservationForm()
    {
        $this->reservation_date = null;
        $this->reservation_time = null;
        $this->reservation_type_maintenance = '';
        $this->reservation_description = '';
        $this->reservation_categorie_service_id = null;
    }

    public function getVehiculeStatus($vehicule)
    {
        if (!$vehicule->date_prochaine_visite) {
            return 'unknown';
        }

        $dateProchaine = \Carbon\Carbon::parse($vehicule->date_prochaine_visite);

        if ($dateProchaine->isPast()) {
            return 'urgent';
        } elseif ($dateProchaine->diffInDays(now()) <= 7) {
            return 'warning';
        } else {
            return 'good';
        }
    }

    public function getCategoriesServicesProperty()
    {
        return \App\Models\CategorieService::all();
    }






  // Historique Entretiens

  public function showHistorique($vehiculeId)
    {

        $this->selectedVehicule = auth('entreprise')->user()->vehicules()->findOrFail($vehiculeId);
        $this->showHistoriqueModal = true;
        $this->resetHistoriqueFilters();
    }

    public function closeHistoriqueModal()
    {
        $this->showHistoriqueModal = false;
        $this->selectedVehicule = null;
        $this->resetHistoriqueFilters();
        $this->resetPage('historique-page');
    }

    private function resetHistoriqueFilters()
    {
        $this->historique_search = '';
        $this->historique_type_filter = '';
        $this->historique_date_debut = '';
        $this->historique_date_fin = '';
    }

    public function updatingHistoriqueSearch()
    {
        $this->resetPage('historique-page');
    }

    public function updatingHistoriqueTypeFilter()
    {
        $this->resetPage('historique-page');
    }

    public function updatingHistoriqueDateDebut()
    {
        $this->resetPage('historique-page');
    }

    public function updatingHistoriqueDateFin()
    {
        $this->resetPage('historique-page');
    }

    public function getHistoriqueEntretiensProperty()
    {
        if (!$this->selectedVehicule) {
            return collect([]);
        }

        $query = $this->selectedVehicule->historique_entretiens()
            ->orderBy('date_entretient', 'desc');

        // Filtre par recherche
        if ($this->historique_search) {
            $query->where(function($q) {
                $q->where('type_entretient', 'like', '%' . $this->historique_search . '%')
                  ->orWhere('description', 'like', '%' . $this->historique_search . '%')
                  ->orWhere('garage_name', 'like', '%' . $this->historique_search . '%');
            });
        }

        // Filtre par type
        if ($this->historique_type_filter) {
            $query->where('type_entretient', $this->historique_type_filter);
        }

        // Filtre par date début
        if ($this->historique_date_debut) {
            $query->where('date_entretient', '>=', $this->historique_date_debut);
        }

        // Filtre par date fin
        if ($this->historique_date_fin) {
            $query->where('date_entretient', '<=', $this->historique_date_fin);
        }

        return $query->paginate(10, ['*'], 'historique-page');
    }

    public function getStatsHistoriqueProperty()
    {
        if (!$this->selectedVehicule) {
            return [
                'total' => 0,
                'total_cout' => 0,
                'dernier_entretien' => null,
                'prochain_entretien' => null,
            ];
        }

        $historiques = $this->selectedVehicule->historique_entretiens;

        return [
            'total' => $historiques->count(),
            'total_cout' => $historiques->sum('cout'),
            'dernier_entretien' => $historiques->sortByDesc('date_entretient')->first(),
            'prochain_entretien' => $this->selectedVehicule->date_prochaine_visite,
        ];
    }

    public function getTypesEntretienProperty()
    {
        if (!$this->selectedVehicule) {
            return collect([]);
        }

        return $this->selectedVehicule->historique_entretiens()
            ->select('type_entretient')
            ->distinct()
            ->pluck('type_entretient')
            ->filter();
    }

    public function exportHistorique()
    {
        // TODO: Implémenter l'export PDF ou Excel
        $this->send_event_at_toast('Export en cours de développement', 'info', 'top-end');
    }

    public function render()
    {
        return view('livewire.entreprise.vehicules.manage-vehicule', [
            'categories_services' => $this->categories_services,
            'historique_entretiens' => $this->showHistoriqueModal ? $this->historique_entretiens : collect([]),
            'stats_historique' => $this->showHistoriqueModal ? $this->stats_historique : [],
            'types_entretien' => $this->showHistoriqueModal ? $this->types_entretien : collect([]),
        ]);
    }

}
