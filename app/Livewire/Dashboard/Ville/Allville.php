<?php

namespace App\Livewire\Dashboard\Ville;

use App\Models\Ville;
use App\Models\Commune;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\UtilsSweetAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;


class Allville extends Component
{

    use UtilsSweetAlert, WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Locked]
    public $id_ville, $id_commune, $id_type_nounou;

    public $nom_ville, $nom_commune, $ville_id, $frais_service;

    public $JoursChoice = [];

    public $joursDisponibles = [];





    public function addVille()  {
        $this->reset('nom_ville');
        $this->launch_modal('add_ville');
    }


    public function addCommune()  {
        $this->reset('nom_commune', 'ville_id');
        $this->launch_modal('add_commune');
    }

    public function updatedVilleId()
    {
        $this->loadJoursDisponibles();
        $this->reset('JoursChoice');
    }

    public function submitVille()  {
        $this->validate([
            'nom_ville' => 'required|string|unique:villes,nom',
        ],[
            'nom_ville.required' => 'Le nom de la ville est obligatoire',
            'nom_ville.string' => 'Le nom de la ville doit être une chaine de caractères',
            'nom_ville.unique' => 'Le nom de la ville doit être unique',
        ]);

        $ville = Ville::create([
            'nom' => $this->nom_ville
        ]);

        $this->send_event_at_sweetAlerte('Enregistrement effectué', 'La ville a bien eté enregistré', 'success');
        $this->reset();
    }





    public function submitCommune()
    {
        $this->validate([
            'nom_commune' => 'required|string|unique:communes,nom',
            'ville_id' => 'required|exists:villes,id',
            'frais_service' => 'required|numeric',
        ], [
            'nom_commune.required' => 'Le nom de la commune est obligatoire',
            'nom_commune.string' => 'Le nom de la commune doit être une chaîne de caractères',
            'nom_commune.unique' => 'Le nom de la commune doit être unique',
            'ville_id.required' => 'La ville est obligatoire',
            'ville_id.exists' => 'La ville sélectionnée est invalide',
            'frais_service.numeric' => 'La main d\'oeuvre doit être un nombre',
            'frais_service.required' => 'La main d\'oeuvre est obligatoire',
        ]);

        // dd($this->JoursChoice);

        if(count($this->JoursChoice) > 0 ) {
            $this->validate([
                'JoursChoice' => 'required|array|min:1',
                'JoursChoice.*' => 'in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            ],[
                'JoursChoice.required' => 'Vous devez sélectionner au moins un jour',
                'JoursChoice.array' => 'Les jours doivent être un tableau',
                'JoursChoice.*.in' => 'Un ou plusieurs jours sélectionnés ne sont pas valides',
            ]);
        }



        Commune::create([
            'nom' => $this->nom_commune,
            'ville_id' => $this->ville_id,
            'jours' => $this->JoursChoice ? json_encode($this->JoursChoice) : NULL, // encodage du tableau en JSON
            'frais_service' => $this->frais_service ?? NULL
        ]);

        $this->send_event_at_sweetAlerte('Enregistrement effectué', 'La commune a bien été enregistrée.', 'success');
        $this->reset(['nom_commune', 'ville_id', 'JoursChoice']);
    $this->loadJoursDisponibles();

    }


    public function editVille($id) {
        $ville = Ville::find($id);
        if(!$ville){
            $this->send_event_at_sweetAlerte('Modification impossible', 'La ville n\'existe pas', 'error');
            return ;
        }

        $this->id_ville = $id;
        $this->nom_ville = $ville->nom;

        $this->launch_modal('edit_ville');
    }

    public function editCommune($id)
    {
        $commune = Commune::find($id);

        if (!$commune) {
            $this->send_event_at_sweetAlerte('Modification impossible', 'La commune n\'existe pas', 'error');
            return;
        }

        $this->id_commune = $id;
        $this->nom_commune = $commune->nom;
        $this->ville_id = $commune->ville_id;
        $this->frais_service = $commune->frais_service;

        // Charger les jours sélectionnés de cette commune
        $this->JoursChoice = $commune->jours ? json_decode($commune->jours, true) : [];

        // Mettre à jour les jours disponibles pour ne pas inclure ceux pris par d'autres communes
        $this->loadJoursDisponibles();

        $this->launch_modal('edit_commune');
    }



    public function updateVille() {
        $ville = Ville::find($this->id_ville);
        if(!$ville){
            $this->send_event_at_sweetAlerte('Modification impossible', 'La ville n\'existe pas', 'error');
            return ;
        }

        $ville->nom = $this->nom_ville;
        $ville->save();

        $this->send_event_at_sweetAlerte('Modification effectuée', 'La ville a bien eté modifiée', 'success');
        $this->reset();
    }



    public function updateCommune()
    {
        $commune = Commune::find($this->id_commune);

        if (!$commune) {
            $this->send_event_at_sweetAlerte('Modification impossible', 'La commune n\'existe pas', 'error');
            return;
        }

        $this->validate([
            'nom_commune' => 'required|string|unique:communes,nom,' . $this->id_commune,
            'ville_id' => 'required|exists:villes,id',
            'JoursChoice' => 'nullable|array',
            'frais_service' => 'required|numeric',
        ], [
            'nom_commune.required' => 'Le nom de la commune est obligatoire',
            'nom_commune.string' => 'Le nom de la commune doit être une chaîne de caractères',
            'nom_commune.unique' => 'Ce nom de commune est déjà utilisé',
            'ville_id.required' => 'La ville est obligatoire',
            'ville_id.exists' => 'La ville sélectionnée n\'existe pas',
            'frais_service.required' => 'La main d\'oeuvre est obligatoire',
            'frais_service.numeric' => 'La main d\'oeuvre doit être un nombre',
        ]);

        $commune->update([
            'nom' => $this->nom_commune,
            'ville_id' => $this->ville_id,
            'frais_service' => $this->frais_service ?? $commune->frais_service,
            'jours' => $this->JoursChoice ? json_encode($this->JoursChoice) : null,
        ]);

        $this->send_event_at_sweetAlerte('Modification effectuée', 'La commune a bien été modifiée', 'success');

        $this->reset(['nom_commune', 'ville_id', 'JoursChoice', 'id_commune']);

        $this->closeModal_after_edit('edit_commune');
    }



    public function deleteVille($id)  {
        $ville = Ville::find($id);
        if(!$ville){
            $this->send_event_at_sweetAlerte('Modification impossible', 'La ville n\'existe pas', 'error');
            return ;
        }

        $this->sweetAlert_confirm_options($ville, 'Etes-vous sur de vouloir supprimer cette ville?', 'Etes-vous sur de vouloir supprimer cette ville ?'.$ville->nom, 'destroyVille', 'error');
    }

    public function deleteCommune($id)  {
        $commune = Commune::find($id);
        if(!$commune){
            $this->send_event_at_sweetAlerte('Modification impossible', 'La commune n\'existe pas', 'error');
            return ;
        }


        $this->sweetAlert_confirm_options($commune, 'Etes-vous sur de vouloir supprimer cette commune?', 'Etes-vous sur de vouloir supprimer cette commune ?'.$commune->nom, 'destroyCommune', 'error');
    }



    #[on('destroyCommune')]
    public function destroyCommune($id)  {
        $commune = Commune::find($id);
        if(!$commune){
            $this->send_event_at_sweetAlerte('Modification impossible', 'La commune n\'existe pas', 'error');
            return ;
        }

        $commune->delete();
        $this->send_event_at_sweetAlerte('Suppression effectuée', 'La commune a bien eté supprimée', 'success');
    }

    #[on('destroyVille')]
    public function destroyVille($id)  {
        $ville = Ville::find($id);
        if(!$ville){
            $this->send_event_at_sweetAlerte('Suppression impossible', 'La ville n\'existe pas', 'error');
            return ;
        }

        $ville->delete();
        $this->send_event_at_sweetAlerte('Suppression effectuée', 'La ville a bien eté supprimée', 'success');
    }




    //Utils
    public function loadJoursDisponibles()
    {
        // Tous les jours de la semaine
        $tousLesJours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

        // Récupère les jours déjà utilisés pour cette ville
        $joursOccupes = Commune::where('ville_id', $this->ville_id)
            ->pluck('jours') // liste des champs JSON
            ->filter() // évite les nulls
            ->map(function ($joursJson) {
                return json_decode($joursJson, true);
            })
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        // Filtrer les jours encore disponibles
        $this->joursDisponibles = array_values(array_diff($tousLesJours, $joursOccupes));
        // dd($this->joursDisponibles);
    }


    public function render()
    {
        $this->loadJoursDisponibles(); // pour chargement initial si besoin

        return view('livewire.dashboard.ville.allville',[
            'list_ville' => Ville::OrderByDesc('created_at')->get(),
            'list_commune' => Commune::OrderByDesc('created_at')->paginate(10),
        ]);
    }
}
