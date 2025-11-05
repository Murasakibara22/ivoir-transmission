<?php

namespace App\Livewire\Dashboard\Entreprise;

use App\Models\Contrat;
use App\Models\Facture;
use Livewire\Component;
use App\Models\Paiement;
use App\Models\Vehicule;
use App\Models\Entretien;
use App\Models\Entreprise;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Livewire\UtilsSweetAlert;
use App\Models\HistoriqueEntretient;


class ManageEntreprise extends Component
{
    use UtilsSweetAlert, WithFileUploads, WithPagination;

    // Entreprise
    public $entreprise;
    public $entrepriseId;

    // Onglets
    public $activeTab = 'informations';

    // Modal states
    public $showEditInfoModal = false;
    public $showAddVehiculeModal = false;
    public $showEditVehiculeModal = false;
    public $showVehiculeDetailsModal = false;
    public $showAddContratModal = false;
    public $showEditContratModal = false;
    public $showClotureEntretienModal = false;

    public $showGererVehiculesModal = false;
    public $showContratDetailsModal = false;

    // Informations entreprise
    public $name;
    public $email;
    public $phone;
    public $address;
    public $type;
    public $logo;
    public $newLogo;

    // Véhicule
    public $selectedVehicule = null;
    public $vehicule_libelle;
    public $vehicule_matricule;
    public $vehicule_chassis;
    public $vehicule_marque;
    public $vehicule_modele;
    public $vehicule_year;
    public $vehicule_type;
    public $vehicule_carburant;
    public $vehicule_couleur;
    public $vehicule_kilometrage_actuel;

    // Contrat
    public $selectedContrat = null;
    public $contrat_libelle;
    public $contrat_description;
    public $contrat_frequence_entretien;
    public $contrat_duree_contrat_mois;
    public $contrat_date_debut;
    public $contrat_date_premier_entretien;
    public $contrat_nombre_vehicules;
    public $contrat_montant_entretien;

    // Entretien
    public $selectedEntretien = null;
    public $entretien_cout_final;
    public $entretien_commentaire;

    //Factures
    public $facture_id;

    // Filtres
    public $search = '';
    public $statusFilter = '';
    public $typeFilter = '';

    protected $queryString = ['activeTab'];

    public function mount($entrepriseId)
    {
        $this->entrepriseId = $entrepriseId;
        $this->loadEntreprise();
    }

    public function loadEntreprise()
    {
        $this->entreprise = Entreprise::with(['vehicules', 'contrats', 'factures'])
            ->findOrFail($this->entrepriseId);

        $this->name = $this->entreprise->name;
        $this->email = $this->entreprise->email;
        $this->phone = $this->entreprise->phone;
        $this->address = $this->entreprise->address;
        $this->type = $this->entreprise->type;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    // ==================== INFORMATIONS ====================

    public function openEditInfoModal()
    {
        $this->showEditInfoModal = true;
    }

    public function closeEditInfoModal()
    {
        $this->showEditInfoModal = false;
        $this->newLogo = null;
    }

    public function updateEntrepriseInfo()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:entreprises,email,' . $this->entrepriseId,
            'phone' => 'required|string',
            'address' => 'nullable|array',
            'type' => 'nullable|string',
            'newLogo' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'type' => $this->type,
        ];

        if ($this->newLogo) {
            // Upload logo
            $logoPath = $this->newLogo->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        $this->entreprise->update($data);

        $this->closeEditInfoModal();
        $this->send_event_at_toast('Informations mises à jour avec succès!', 'success', 'top-right');
    }

    public function toggleStatus()
    {
        $newStatus = $this->entreprise->status === Entreprise::ACTIVATED
            ? Entreprise::SUSPENDED
            : Entreprise::ACTIVATED;

        $this->entreprise->update(['status' => $newStatus]);

        $this->send_event_at_toast('Statut mis à jour avec succès!', 'success', 'top-right');
    }

    // ==================== VÉHICULES ====================

    public function getVehiculesProperty()
    {
        $query = $this->entreprise->vehicules()->latest();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('matricule', 'like', '%' . $this->search . '%')
                  ->orWhere('marque', 'like', '%' . $this->search . '%')
                  ->orWhere('modele', 'like', '%' . $this->search . '%')
                  ->orWhere('libelle', 'like', '%' . $this->search . '%');
            });
        }

        return $query->paginate(10);
    }

    public function openAddVehiculeModal()
    {
        $this->resetVehiculeForm();
        $this->showAddVehiculeModal = true;
    }

    public function closeAddVehiculeModal()
    {
        $this->showAddVehiculeModal = false;
        $this->resetVehiculeForm();
    }

    public function saveVehicule()
    {
        $this->validate([
            'vehicule_libelle' => 'required|string|max:255',
            'vehicule_matricule' => 'required|string|unique:vehicules,matricule',
            'vehicule_chassis' => 'required|string',
            'vehicule_marque' => 'required|string',
        ]);

        $this->entreprise->vehicules()->create([
            'libelle' => $this->vehicule_libelle,
            'matricule' => $this->vehicule_matricule,
            'chassis' => $this->vehicule_chassis,
            'marque' => $this->vehicule_marque,
            'modele' => $this->vehicule_modele,
            'year' => $this->vehicule_year,
            'type' => $this->vehicule_type,
            'carburant' => $this->vehicule_carburant,
            'couleur' => $this->vehicule_couleur,
            'kilometrage_actuel' => $this->vehicule_kilometrage_actuel ?? 0,
            'slug' => Str::random(10) . uniqid(),
            'status' => 'ACTIVATED',
        ]);

        $this->closeAddVehiculeModal();
        $this->send_event_at_toast('Véhicule ajouté avec succès!', 'success', 'top-right');
    }

    public function openEditVehiculeModal($vehiculeId)
    {
        $this->selectedVehicule = Vehicule::findOrFail($vehiculeId);

        $this->vehicule_libelle = $this->selectedVehicule->libelle;
        $this->vehicule_matricule = $this->selectedVehicule->matricule;
        $this->vehicule_chassis = $this->selectedVehicule->chassis;
        $this->vehicule_marque = $this->selectedVehicule->marque;
        $this->vehicule_modele = $this->selectedVehicule->modele;
        $this->vehicule_year = $this->selectedVehicule->year;
        $this->vehicule_type = $this->selectedVehicule->type;
        $this->vehicule_carburant = $this->selectedVehicule->carburant;
        $this->vehicule_couleur = $this->selectedVehicule->couleur;
        $this->vehicule_kilometrage_actuel = $this->selectedVehicule->kilometrage_actuel;

        $this->showEditVehiculeModal = true;
    }

    public function updateVehicule()
    {
        $this->validate([
            'vehicule_libelle' => 'required|string|max:255',
            'vehicule_matricule' => 'required|string|unique:vehicules,matricule,' . $this->selectedVehicule->id,
            'vehicule_chassis' => 'required|string',
            'vehicule_marque' => 'required|string',
        ]);

        $this->selectedVehicule->update([
            'libelle' => $this->vehicule_libelle,
            'matricule' => $this->vehicule_matricule,
            'chassis' => $this->vehicule_chassis,
            'marque' => $this->vehicule_marque,
            'modele' => $this->vehicule_modele,
            'year' => $this->vehicule_year,
            'type' => $this->vehicule_type,
            'carburant' => $this->vehicule_carburant,
            'couleur' => $this->vehicule_couleur,
            'kilometrage_actuel' => $this->vehicule_kilometrage_actuel,
        ]);

        $this->showEditVehiculeModal = false;
        $this->send_event_at_toast('Véhicule mis à jour avec succès!', 'success', 'top-right');
    }

    public function openVehiculeDetailsModal($vehiculeId)
    {
        $this->selectedVehicule = Vehicule::with('historique_entretiens')->findOrFail($vehiculeId);
        $this->showVehiculeDetailsModal = true;
    }

    public function deleteVehicule($vehiculeId)
    {
        $vehicule = Vehicule::findOrFail($vehiculeId);
        $vehicule->delete();

        $this->send_event_at_toast('Véhicule supprimé avec succès!', 'success', 'top-right');
    }

    private function resetVehiculeForm()
    {
        $this->vehicule_libelle = '';
        $this->vehicule_matricule = '';
        $this->vehicule_chassis = '';
        $this->vehicule_marque = '';
        $this->vehicule_modele = '';
        $this->vehicule_year = null;
        $this->vehicule_type = '';
        $this->vehicule_carburant = '';
        $this->vehicule_couleur = '';
        $this->vehicule_kilometrage_actuel = 0;
        $this->selectedVehicule = null;
    }

    // ==================== CONTRATS ====================

    public function getContratsProperty()
    {
        $query = $this->entreprise->contrats()->latest();

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        return $query->paginate(10);
    }

    public function openAddContratModal()
    {
        $this->resetContratForm();
        $this->showAddContratModal = true;
    }

    public function saveContrat()
    {
        $this->validate([
            'contrat_libelle' => 'required|string|max:255',
            'contrat_frequence_entretien' => 'required|in:MENSUEL,TRIMESTRIEL,SEMESTRIEL,ANNUEL',
            'contrat_duree_contrat_mois' => 'required|integer|min:1',
            'contrat_date_debut' => 'required|date',
            'contrat_date_premier_entretien' => 'required|date|after_or_equal:contrat_date_debut',
            'contrat_nombre_vehicules' => 'required|integer|min:1',
            'contrat_montant_entretien' => 'required|numeric|min:0',
        ]);

        $dateDebut = \Carbon\Carbon::parse($this->contrat_date_debut);
        $this->contrat_duree_contrat_mois = intval($this->contrat_duree_contrat_mois);
        $dateFin = $dateDebut->copy()->addMonths($this->contrat_duree_contrat_mois);

        $contrat = $this->entreprise->contrats()->create([
            'libelle' => $this->contrat_libelle,
            'description' => $this->contrat_description,
            'frequence_entretien' => $this->contrat_frequence_entretien,
            'duree_contrat_mois' => $this->contrat_duree_contrat_mois,
            'date_debut' => $this->contrat_date_debut,
            'date_fin' => $dateFin,
            'date_premier_entretien' => $this->contrat_date_premier_entretien,
            'nombre_vehicules' => $this->contrat_nombre_vehicules,
            'montant_entretien' => $this->contrat_montant_entretien,
            'status' => Contrat::PENDING,
            'slug' => Str::random(10) . uniqid(),
        ]);

        $this->showAddContratModal = false;
        $this->send_event_at_toast('Contrat ajouté avec succès!', 'success', 'top-right');
    }



    public function openContratDetailsModal($contratId)
    {
        $this->selectedContrat = Contrat::with(['entretiens', 'factures'])->findOrFail($contratId);
        $this->showContratDetailsModal = true;
    }

    public function closeContratDetailsModal()
    {
        $this->showContratDetailsModal = false;
        $this->selectedContrat = null;
    }

    public function openEditContratModal($contratId)
    {
        $this->selectedContrat = Contrat::findOrFail($contratId);

        $this->contrat_libelle = $this->selectedContrat->libelle;
        $this->contrat_description = $this->selectedContrat->description;
        $this->contrat_frequence_entretien = $this->selectedContrat->frequence_entretien;
        $this->contrat_duree_contrat_mois = $this->selectedContrat->duree_contrat_mois;
        $this->contrat_date_debut = $this->selectedContrat->date_debut;
        $this->contrat_date_premier_entretien = $this->selectedContrat->date_premier_entretien;
        $this->contrat_nombre_vehicules = $this->selectedContrat->nombre_vehicules;
        $this->contrat_montant_entretien = $this->selectedContrat->montant_entretien;

        $this->showEditContratModal = true;
        $this->showContratDetailsModal = false;
    }

    public function closeEditContratModal()
    {
        $this->showEditContratModal = false;
        $this->resetContratForm();
    }

    public function updateContrat()
    {
        $this->validate([
            'contrat_libelle' => 'required|string|max:255',
            'contrat_frequence_entretien' => 'required|in:MENSUEL,TRIMESTRIEL,SEMESTRIEL,ANNUEL',
            'contrat_duree_contrat_mois' => 'required|integer|min:1',
            'contrat_date_debut' => 'required|date',
            'contrat_date_premier_entretien' => 'required|date',
            'contrat_nombre_vehicules' => 'required|integer|min:1',
            'contrat_montant_entretien' => 'required|numeric|min:0',
        ]);

        $dateDebut = \Carbon\Carbon::parse($this->contrat_date_debut);
        $this->contrat_duree_contrat_mois = intval($this->contrat_duree_contrat_mois);
        $dateFin = $dateDebut->copy()->addMonths($this->contrat_duree_contrat_mois);

        $this->selectedContrat->update([
            'libelle' => $this->contrat_libelle,
            'description' => $this->contrat_description,
            'frequence_entretien' => $this->contrat_frequence_entretien,
            'duree_contrat_mois' => $this->contrat_duree_contrat_mois,
            'date_debut' => $this->contrat_date_debut,
            'date_fin' => $dateFin,
            'date_premier_entretien' => $this->contrat_date_premier_entretien,
            'nombre_vehicules' => $this->contrat_nombre_vehicules,
            'montant_entretien' => $this->contrat_montant_entretien,
        ]);

        $this->closeEditContratModal();
        $this->send_event_at_toast('Contrat modifié avec succès!', 'success', 'top-right');
    }


    public function activerContrat($contratId)
    {
        $contrat = Contrat::findOrFail($contratId);
        $contrat->update([
            'status' => Contrat::ACTIVATED,
            'garage_validated_at' => now(),
        ]);

        // Créer le premier entretien automatiquement
        $this->creerPremierEntretien($contrat);

        $this->send_event_at_toast('Contrat activé avec succès!', 'success', 'top-right');
    }

    private function creerPremierEntretien($contrat)
    {
        $entretien = Entretien::create([
            'contrat_id' => $contrat->id,
            'entreprise_id' => $contrat->entreprise_id,
            'date_prevue' => $contrat->date_premier_entretien,
            'numero_entretien' => 1,
            'nombre_vehicules_total' => $contrat->nombre_vehicules,
            'nombre_vehicules_fait' => 0,
            'nombre_vehicules_restant' => $contrat->nombre_vehicules,
            'cout_prevu' => $contrat->montant_entretien,
            'status' => Entretien::PENDING,
            'slug' => Str::random(10) . uniqid(),
        ]);

        // Créer un historique pour chaque véhicule
        $vehicules = $this->entreprise->vehicules()->limit($contrat->nombre_vehicules)->get();

        foreach ($vehicules as $vehicule) {
            HistoriqueEntretient::create([
                'vehicule_id' => $vehicule->id,
                'entreprise_id' => $contrat->entreprise_id,
                'entretien_id' => $entretien->id,
                'contrat_id' => $contrat->id,
                'type_entretient' => 'Entretien contractuel',
                'date_entretient' => $contrat->date_premier_entretien,
                'status' => HistoriqueEntretient::PENDING,
                'slug' => Str::random(10) . uniqid(),
            ]);
        }
    }

    private function resetContratForm()
    {
        $this->contrat_libelle = '';
        $this->contrat_description = '';
        $this->contrat_frequence_entretien = '';
        $this->contrat_duree_contrat_mois = '';
        $this->contrat_date_debut = '';
        $this->contrat_date_premier_entretien = '';
        $this->contrat_nombre_vehicules = '';
        $this->contrat_montant_entretien = '';
    }

    // ==================== ENTRETIENS ====================

    public function getEntretiensProperty()
    {
        return Entretien::where('entreprise_id', $this->entrepriseId)
            ->with(['contrat'])
            ->latest('date_prevue')
            ->paginate(10);
    }

    // public function marquerVehiculeTermine($historiqueId)
    // {
    //     $historique = HistoriqueEntretient::findOrFail($historiqueId);
    //     $historique->update(['status' => HistoriqueEntretient::DONE]);

    //     $entretien = $historique->entretien;
    //     $entretien->increment('nombre_vehicules_fait');
    //     $entretien->decrement('nombre_vehicules_restant');

    //     $this->send_event_at_toast('Véhicule marqué comme fait!', 'success', 'top-right');
    // }

    public function openClotureEntretienModal($entretienId)
    {
        $this->selectedEntretien = Entretien::with(['contrat'])->findOrFail($entretienId);
        $this->entretien_cout_final = $this->selectedEntretien->cout_prevu;
        $this->showClotureEntretienModal = true;
    }

    public function cloturerEntretien()
    {
        $this->validate([
            'entretien_cout_final' => 'required|numeric|min:0',
            'entretien_commentaire' => 'nullable|string',
        ]);

        $this->selectedEntretien->update([
            'status' => Entretien::COMPLETED,
            'date_realisation' => now(),
            'cout_final' => $this->entretien_cout_final,
            'commentaire_cout' => $this->entretien_commentaire,
        ]);

        // Créer la facture
        $this->creerFacture($this->selectedEntretien);

        // Planifier le prochain entretien
        $this->planifierProchainEntretien($this->selectedEntretien);

        $this->showClotureEntretienModal = false;
        $this->send_event_at_toast('Entretien cloturé!', 'success', 'top-right');
    }

    private function creerFacture($entretien)
    {
        Facture::create([
            'libelle' => 'Facture n°' . $entretien->id.'pour l\'entreprise ' . $entretien->entreprise->nom,
            'ref' => 'FACT-' . strtoupper(Str::random(8)),
            'entreprise_id' => $entretien->entreprise_id,
            'entretien_id' => $entretien->id,
            'contrat_id' => $entretien->contrat_id,
            'montant' => $entretien->cout_final,
            'montant_ttc' => $entretien->cout_final,
            'date_emission' => now(),
            'date_echeance' => now()->addDays(30),
            'status_paiement' => Facture::PENDING,
        ]);
    }

    private function planifierProchainEntretien($entretien)
    {
        $contrat = $entretien->contrat;

        // Calculer la prochaine date selon la fréquence
        $dateProchaine = \Carbon\Carbon::parse($entretien->date_prevue);

        switch ($contrat->frequence_entretien) {
            case 'MENSUEL':
                $dateProchaine->addMonth();
                break;
            case 'TRIMESTRIEL':
                $dateProchaine->addMonths(3);
                break;
            case 'SEMESTRIEL':
                $dateProchaine->addMonths(6);
                break;
            case 'ANNUEL':
                $dateProchaine->addYear();
                break;
        }

        // Vérifier si la date est avant la fin du contrat
        if ($dateProchaine->lte(\Carbon\Carbon::parse($contrat->date_fin))) {
            $nouveauEntretien = Entretien::create([
                'contrat_id' => $contrat->id,
                'entreprise_id' => $contrat->entreprise_id,
                'date_prevue' => $dateProchaine,
                'numero_entretien' => $entretien->numero_entretien + 1,
                'nombre_vehicules_total' => $contrat->nombre_vehicules,
                'nombre_vehicules_fait' => 0,
                'nombre_vehicules_restant' => $contrat->nombre_vehicules,
                'cout_prevu' => $contrat->montant_entretien,
                'status' => Entretien::PENDING,
                'slug' => Str::random(10) . uniqid(),
            ]);

            // Créer historiques pour les véhicules
            $vehicules = $this->entreprise->vehicules()->limit($contrat->nombre_vehicules)->get();

            foreach ($vehicules as $vehicule) {
                HistoriqueEntretient::create([
                    'vehicule_id' => $vehicule->id,
                    'entreprise_id' => $contrat->entreprise_id,
                    'entretien_id' => $nouveauEntretien->id,
                    'contrat_id' => $contrat->id,
                    'type_entretient' => 'Entretien contractuel',
                    'date_entretient' => $dateProchaine,
                    'status' => HistoriqueEntretient::PENDING,
                    'slug' => Str::random(10) . uniqid(),
                ]);
            }
        }
    }

    public function openGererVehiculesModal($entretienId)
    {
        $this->selectedEntretien = Entretien::with(['contrat'])->findOrFail($entretienId);
        $this->showGererVehiculesModal = true;
    }

    public function voirDetailsEntretien($entretienId)
    {
        $this->selectedEntretien = Entretien::with(['contrat'])->findOrFail($entretienId);
        $this->showGererVehiculesModal = true;
    }

    // MÉTHODE MODIFIÉE
    public function marquerVehiculeTermine($historiqueId)
    {
        $historique = HistoriqueEntretient::findOrFail($historiqueId);
        $historique->update(['status' => HistoriqueEntretient::DONE]);

        $entretien = $historique->entretien;
        $entretien->increment('nombre_vehicules_fait');
        $entretien->decrement('nombre_vehicules_restant');

        // Changer le statut de l'entretien si c'était le premier véhicule
        if($entretien->status === Entretien::PENDING) {
            $entretien->update(['status' => Entretien::IN_PROGRESS]);
        }

        $this->send_event_at_toast('Véhicule marqué comme terminé!', 'success', 'top-end');

        // Recharger l'entretien
        $this->selectedEntretien = $entretien->fresh();
    }

    public function marquerVehiculeNonFait($historiqueId)
    {
        $historique = HistoriqueEntretient::findOrFail($historiqueId);
        $historique->update(['status' => HistoriqueEntretient::CANCELLED]);

        $entretien = $historique->entretien;


        $entretien->increment('nombre_vehicules_restant');
        $entretien->decrement('nombre_vehicules_fait');

        // Changer le statut de l'entretien si c'était le premier véhicule
        // if($entretien->status === Entretien::PENDING) {
        //     $entretien->update(['status' => Entretien::IN_PROGRESS]);
        // }

        $this->send_event_at_toast('Véhicule marqué comme non fait !', 'warning', 'top-end');

        // Recharger l'entretien
        $this->selectedEntretien = $entretien->fresh();
    }

    // NOUVELLE MÉTHODE - Pour annuler un véhicule marqué terminé
    public function annulerVehiculeTermine($historiqueId)
    {
        $historique = HistoriqueEntretient::findOrFail($historiqueId);
        $historique->update(['status' => HistoriqueEntretient::PENDING]);

        $entretien = $historique->entretien;

        if($entretien->nombre_vehicules_fait > 0){
            $entretien->decrement('nombre_vehicules_fait');
        }

        if($entretien->nombre_vehicules_restant < $entretien->nombre_vehicules_total){
            $entretien->increment('nombre_vehicules_restant');
        }

        $this->send_event_at_toast('Statut du véhicule annulé', 'info', 'top-end');

        // Recharger l'entretien
        $this->selectedEntretien = $entretien->fresh();
    }



    public function confirmerPaiement($factureId){
        $facture = Facture::findOrFail($factureId);

        if(!$facture->status){
            return $this->send_event_at_toast('Facture non trouvée', 'warning', 'top-end');
        }

        $this->facture_id = $factureId;

        $this->sweetAlert_confirm_success($facture, 'Confirmer le paiement', 'Confirmer le paiement en espèce de la facture?', 'validatePaimentEspece', 'success');
    }

    #[on('validatePaimentEspece')]
    public function validatePaimentEspece() {

         $facture = Facture::findOrFail($this->facture_id);

        if(!$facture->status){
            return $this->send_event_at_toast('Facture non trouvée', 'warning', 'top-end');
        }

        if($facture->status_paiement === Facture::PAID){
            return $this->send_event_at_toast('Facture deja payée', 'warning', 'top-end');
        }

        $this->confirmPaiementEspece($facture);


        if($facture->status_paiement === Facture::OVERDUE || $facture->status_paiement === Facture::PENDING){
            $facture->update([
                'status_paiement' => Facture::PAID,
                // 'date_paiement' => now(),
            ]);
            $this->send_event_at_toast('Facture marquée comme payée', 'success', 'top-end');
        }
    }


    private function confirmPaiementEspece(Facture $facture){

    //    try{
            $paiement  = $facture->paiements()->first();


            if($paiement->status === Paiement::PENDING){
                $paiement->update([
                    'status' => Paiement::PAID,
                ]);
            }


    //    }catch(\Exception $e){
    //        \Log::error($e->getMessage());
    //    }
    }

    // ==================== FACTURES ====================

    public function getFacturesProperty()
    {
        return $this->entreprise->factures()
            ->with(['entretien', 'contrat'])
            ->latest()
            ->paginate(10);
    }

    // ==================== RENDER ====================

    public function render()
    {
        return view('livewire.dashboard.entreprise.manage-entreprise', [
            'vehicules' => $this->activeTab === 'vehicules' ? $this->vehicules : collect([]),
            'contrats' => $this->activeTab === 'contrats' ? $this->contrats : collect([]),
            'entretiens' => $this->activeTab === 'entretiens' ? $this->entretiens : collect([]),
            'factures' => $this->activeTab === 'factures' ? $this->factures : collect([]),
        ])->layout('layouts.app');
    }
}
