<?php

namespace App\Livewire\Dashboard\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\FraisService;
use Intervention\Image\Image;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\CategorieService;
use Image as InterventionImage;
use Livewire\Attributes\Locked;
use App\Livewire\UtilsSweetAlert;
use Illuminate\Support\Facades\File;

class Allservice extends Component
{

    use UtilsSweetAlert, WithFileUploads;

    #[Locked]
    public $id_service ;

    public $list_service;

    public $libelle, $type ,$avantages_list, $price, $currency_code, $Aslogo, $category_id, $description, $start_price, $frais_service;
    public $AsImages = [];
    public $inputsAvantages ;
    public $images_list ;

    //Searcch and filter
    public $search = '';
    public $filter, $start_date,$end_date;

    //Stats
    public $all_stats_service, $stats_best_service ;

    //Frais de service
    public $montant_frais , $description_frais;



    protected $rules = [
        'libelle' => 'required|string|max:255|unique:services,libelle|min:3',
        'category_id' => 'required|exists:categorie_services,id',
    ];

    protected $messages = [
        'libelle.required' => 'Le libelle est obligatoire',
        'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères',
        'libelle.min' => 'Le libelle doit avoir au moins 3 caractères',
        'libelle.unique' => 'Ce Service avec pour libelle : :input existe déja',
        'type.required' => 'Le type est obligatoire',
        'category_id.required' => 'La catégorie est obligatoire',
        'category_id.exists' => 'La catégorie n\'existe pas',
        'price.required' => 'Le prix est obligatoire',
        'price.numeric' => 'Le prix doit être un nombre',
        'price.min' => 'Le prix doit être supérieur ou égal à 100',
        'currency_code.required' => 'Le code de devise est obligatoire',
        'currency_code.max' => 'Le code de devise ne doit pas dépasser 5 caractères',
        'inputsAvantages.*.libelle.required' => 'L\'avantage est obligatoire',
        'inputsAvantages.*.libelle.max' => 'L\'avantage ne doit pas dépasser 255 caractères',
        'inputsAvantages.*.libelle.string' => 'Le libelle de cet avantage doit être une chaine de caractères',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addService() {
        $this->launch_modal('add_service');
    }

    public function store () {
        $this->validate();

        $name = htmlspecialchars($this->libelle);

        $service = new Service();
        $service->libelle = ucfirst(strtolower($name));
        if($this->price){
            $service->frais_service =  intval($this->price);
        }else{
            $service->frais_service = CategorieService::find($this->category_id)->frais_service ?? NULL;
        }
        $service->description = $this->description;

        $service->categorie_service_id = $this->category_id;
        $service->slug = generateSlug('Service' , $service->libelle);
        $service->save();

        $this->send_event_at_toast('Service ajouté avec succès', 'success', 'top-right');
        $this->reset();
    }


    public function edit(int $id) {
        $service = Service::find($id);
        if(!$service){
            $this->send_event_at_toast('Le service n\'existe pas', 'warning', 'top-right');
            return;
        }

        $this->id_service = $service->id;
        $this->libelle = $service->libelle;
        $this->category_id = $service->categorie_service_id;
        $this->price = $service->frais_service;
        $this->description = $service->description;


        $this->sendContentAtSummernote("description2", $this->description);
        $this->launch_modal('edit_service');
    }

    public function update_service() {
        $service = Service::find($this->id_service);
        if(!$service){
            $this->send_event_at_sweetAlerte('Attention', 'Le service n\'existe pas', 'warning');
            return;
        }

        $this->validate([
            'libelle' => 'required|string|max:255|min:3',
            'category_id' => 'required|exists:categorie_services,id',
        ],[
            'libelle.required' => 'Le libelle est obligatoire',
            'libelle.max' => 'Le libelle ne doit pas dépasser 255 caractères',
            'libelle.min' => 'Le libelle doit avoir au moins 3 caractères',
            'libelle.unique' => 'Ce Service avec pour libelle : :input existe déja',
            'type.required' => 'Le type est obligatoire',
            'category_id.required' => 'La catégorie est obligatoire',
            'category_id.exists' => 'La catégorie n\'existe pas',
            'price.required' => 'Le prix est obligatoire',
            'price.numeric' => 'Le prix doit être un nombre',
            'price.min' => 'Le prix doit être supérieur ou égal à 100',
        ]);


        $service_exist = Service::where('libelle', $this->libelle)->where('id', '!=', $this->id_service)->first();
        if($service_exist){
            $this->send_event_at_sweetAlerte('Attention', 'Ce service existe déja', 'warning');
            return;
        }

        $name = htmlspecialchars($this->libelle);

        $service->libelle = ucfirst(strtolower($name));
        if($this->price){
            $service->frais_service =  intval($this->price);
        }else{
            $service->frais_service = CategorieService::find($this->category_id)->frais_service ?? NULL;
        }
        $service->description = $this->description;

        $service->categorie_service_id = $this->category_id;
        $service->slug = generateSlug('Service' , $service->libelle);
        $service->update();

        $this->send_event_at_sweetAlerte('Modification effectuer','Service mis à jour', 'success');
        $this->closeModal_after_edit('edit_service');
        $this->reset();
    }


    public function delete_service(int $id) {
        $service = Service::find($id);
        if(!$service){
            $this->send_event_at_sweetAlerte('Attention', 'Le service n\'existe pas', 'warning');
            return;
        }

        $this->id_service = $id;
        $this->sweetAlert_confirm_options($service ,'Voulez-vous supprimer ce service ?', 'Supprimer ce service revient a supprimer tous les codes promos associés ,Etes-vous sur de vouloir supprimer ce service ?', 'DestroyService', 'warning');
    }

    #[on('DestroyService')]
    public function destroyServ()  {
        $service = Service::find($this->id_service);
        if($service){

            $service->delete();
            $this->send_event_at_toast('Service supprimer avec succès !!', 'success','top-right');
            $this->reset();
            $this->closeModal_after_edit('edit_service');
        }else{
            $this->send_event_at_sweetAlerte('Attention', 'Le service que vous essayer de supprimer n\'existe pas', 'warning');
            return;
        }
    }


    public function ShowAvantages(int $id)   {
        $service = Service::find($id);
        if(!$service){
            $this->send_event_at_toast('Le service n\'existe pas', 'warning', 'top-right');
            return;
        }

        $this->libelle = $service->libelle;


        // Log
        ActivityLog("Affichage des avantage du service : ".$service->libelle, "Admin");

        $this->lanch_modal('show_avantages');
    }


    //Filter

    function filterService($filter)  {
        $this->filter = $filter;

        switch ($filter) {
            case 'Todays':
                $this->list_service = Service::where('created_at', Carbon::today())->get();
                break;
            case 'Hier':
                $this->list_service = Service::whereDate('created_at', Carbon::today()->subDay())->get();
                break;
            case 'SevenDays':
                $this->list_service = Service::whereDate('created_at', '>=', today()->subDays(7))->get();
                break;
            case 'Month':
                $this->list_service = Service::whereMonth('created_at', date('m'))->get();
                break;
            case 'LastMonth':
                $this->list_service = Service::whereMonth('created_at', date('m')-1)->get();
                break;
            case 'Autre':
                $this->showSelectFilter();
                break;

            default:
                $this->list_service = Service::all();
                break;
        }
    }

    function showSelectFilter() {
        if($this->filter == 'Autre'){
            $this->launch_modal('select_filter');
        }
    }

    function FilterAutreOption()  {
        if($this->filter != 'Autre'){
            return false;
        }

                $this->validate([
                    'start_date' => 'required | date | before:'.Carbon::now().'',
                    'end_date' => 'required | date | after:start_date',
                ],[
                    'start_date.required' => 'Veuillez selectionner une date de debut !',
                    'end_date.required' => 'Veuillez selectionner une date de fin !',
                    'end_date.after' => 'La date de fin doit etre superieur a la date de debut !',
                    'start_date.date' => 'La date de debut doit etre une date valide !',
                    'end_date.date' => 'La date de fin doit etre une date valide !',
                ]);

                $this->list_service = Service::whereBetween('created_at', [$this->start_date, $this->end_date])->get();

                $this->closeModal_after_edit('select_filter');

    }

    //End Filter


    //Frais de service

    public function addFraisService()  {

        if(FraisService::first()){
            $this->montant_frais = FraisService::first()->montant;
            $this->description_frais = FraisService::first()->description;
        }else{
            $this->reset(['montant_frais','description_frais']);
        }
        $this->launch_modal('add_frais_service');
    }

    public function SubmitFraisService() {
            $this->validate([
                'montant_frais' => 'required|numeric|min:100',
            ],[
                'montant_frais.required' => 'Le montant est obligatoire !',
                'montant_frais.numeric' => 'Le montant doit etre numerique !',
                'montant_frais.min' => 'Le montant doit etre superieur a 100 !',
            ]);

            $frais_exist = FraisService::first();
            if($frais_exist) {
                $frais_exist->montant = $this->montant_frais;
                $frais_exist->description = $this->description_frais;
                $frais_exist->update();

            }else{
                $frais = new FraisService();
                $frais->montant = $this->montant_frais;
                $frais->description = $this->description_frais;
                $frais->save();
            }

            $this->send_event_at_toast("Frais de service ajouter avec succes !", "success", "top-right");
            $this->closeModal_after_edit('add_frais_service');
            return;
    }


    //Search
    function searchService() {
        $this->list_service = Service::where('libelle', 'like', '%' . $this->search . '%')->Orwhere('type', 'like', '%' . $this->search . '%')->get();
    }


    protected function getStats()  {
        $this->all_stats_service = Service::count();
        // $this->stats_best_service = Service::whereHas('Reservation')->count();
    }







    public function render()
    {

        $this->list_service = Service::OrderBy('created_at', 'desc')->get();
        $this->getStats();

        return view('livewire.dashboard.service.allservice',[
            'list_categorie' => CategorieService::all()
        ]);
    }
}
