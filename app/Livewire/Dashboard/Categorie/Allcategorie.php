<?php

namespace App\Livewire\Dashboard\Categorie;

use App\Models\Service;
use Livewire\Component;
use App\Models\CategorieService;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use App\Livewire\UtilsSweetAlert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AllCategorie extends Component
{

    use WithFileUploads, UtilsSweetAlert ;

    #[Locked]
    public $idCategorieService;

    public $libelle , $description , $Aslogo, $frais_service ;

    public $list_service;

    protected $rules=[
        'libelle' =>  ['required','min:3']
    ];

    protected $messages = [
        'libelle.required' => "Un Nom de Categorie est requis",
        'libelle.libelle' => "Minimum 3 caractere",
    ];


    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    function addCategorieService() : void {
        $this->reset();
        $this->launch_modal("add_categorie");
    }

    function submitCategorieService()  {
        $this->validate();

        $CategorieService_exist = CategorieService::where('libelle', $this->libelle)->first();
        if($CategorieService_exist){
            // Log
            //ActivityLog("Tentative d'ajout de nouvelle CategorieService: ".$this->libelle, "Admin");

            $this->send_event_at_toast('CategorieService existe déja', 'warning', 'top-right');
            return;
        }

        $CategorieService = new CategorieService();
        $CategorieService->libelle = $this->libelle;
        if($this->description){
            $CategorieService->description = $this->description;
        }
        if($this->frais_service){
            $CategorieService->frais_service = $this->frais_service;
        }
        if($this->Aslogo){
            $img = $this->Aslogo;
            $messi = md5($img->getClientOriginalExtension().time().$this->Aslogo).".".$img->getClientOriginalExtension();

            $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                'folder' => 'ivoireTransmission',
                'transformation' => [
                    'width' => 150,
                    'height' => 150,
                    'crop' => 'fill'
                ]
            ]);

            $publicId = $uploadedImage->getPublicId();

            $imageUrl = Cloudinary::getUrl($publicId);

            $CategorieService->logo  = $imageUrl;
        }
        $CategorieService->slug = generateSlug('CategorieService' , $CategorieService->libelle);
        $CategorieService->save();

        // Log
        //ActivityLog("Enregistrement d'une nouvelle CategorieService : ".$CategorieService->libelle, "Admin");

        $this->send_event_at_toast('Catégorie ajoutée avec succès', 'success', 'top-right');
        $this->resetSummernote("description");
        $this->reset();
    }


    function editCategorieService(int $id_CategorieService)  {
        $CategorieService = CategorieService::find($id_CategorieService);
        if($CategorieService){
            $this->idCategorieService = $CategorieService->id;
            $this->libelle = $CategorieService->libelle;
            $this->description = $CategorieService->description;
            $this->frais_service = $CategorieService->frais_service;

            $this->sendContentAtSummernote("description2", $this->description);
            $this->launch_modal("edit_categorie");
        }else{
            $this->send_event_at_sweetAlerte("Erreur","La CategorieService selectionner n'existe pas !!", "error");
            return ;
        }
    }

    function updateCategorieService()  {
        $this->validate();
        $CategorieService = CategorieService::find($this->idCategorieService);
        if($CategorieService){

            if($this->Aslogo != null){

                // Extraire le public ID à partir de l'URL de l'image
                $publicId = pathinfo(parse_url($CategorieService->logo, PHP_URL_PATH), PATHINFO_FILENAME);

                if($publicId){
                    // Supprimer l'image de Cloudinary
                    $result = Cloudinary::destroy('twins/' . $publicId);
                }

                $img = $this->Aslogo;
                $messi = md5($img->getClientOriginalExtension().time().$this->Aslogo).".".$img->getClientOriginalExtension();

                $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                    'folder' => 'twins',
                ]);

                $publicId = $uploadedImage->getPublicId();

                $imageUrl = Cloudinary::getUrl($publicId);

               $CategorieService->logo  = $imageUrl;
            }
            $CategorieService->libelle = $this->libelle ;
            if($this->frais_service){
                $CategorieService->frais_service = $this->frais_service;
            }
            $CategorieService->description = $this->description != null && $this->description != '' ?  $this->description : $CategorieService->description  ;
            $CategorieService->slug = generateSlug('CategorieService' , $CategorieService->libelle);
            $CategorieService->update();

            // Log
        //ActivityLog("Modification d'une CategorieService : ".$CategorieService->libelle, "Admin");

            $this->send_event_at_sweetAlerte("Valider","Modification effectuer !!", "success");
            $this->closeModal_after_edit("edit_categorie");
            $this->reset();

        }else{
            $this->send_event_at_sweetAlerte("Erreur","La CategorieService selectionner n'existe pas !!", "error");
            return ;
        }
    }

    function deleteCategorieService($id_CategorieService)  {
        $CategorieService = CategorieService::find($id_CategorieService);
        if($CategorieService){
            // if($CategorieService->services()->exists()){
            //     $this->send_event_at_sweet_alert_not_timer("Erreur","La catégorie sélectionnée n'est pas vide ! Veuillez d'abord supprimer les services et les services supplémentaires. !!", "error");
            //     return ;
            // }
            $this->sweetAlert_confirm_options($CategorieService ,"Supperssion de CategorieService","Etes-vous sur de vouloir supprimer : $CategorieService->libelle","DestoyCategorieService", "error");
        }else{
            $this->send_event_at_sweetAlerte("Erreur","La CategorieService selectionner n'existe pas !!", "error");
            return ;
        }
    }

    #[on('DestoyCategorieService')]
    function Destoy($id) {
        $CategorieService = CategorieService::find($id);
        if($CategorieService){

            // Extraire le public ID à partir de l'URL de l'image
            $publicId = pathinfo(parse_url($CategorieService->logo, PHP_URL_PATH), PATHINFO_FILENAME);

            if($publicId){
                // Supprimer l'image de Cloudinary
                $result = Cloudinary::destroy('twins/' . $publicId);
            }

            // Log
            //ActivityLog(" Suppression d'une CategorieService : ".$CategorieService->libelle, "Admin");

            Service::each(function ($produit) use ($CategorieService) {
                if($produit->CategorieService_id == $CategorieService->id){
                    $produit->status = 'INACTIVATED';
                    $produit->update();
                }
            });

            $CategorieService->delete();
            $this->send_event_at_toast("Supression Effectuer !!", "success", "bottom-end");
            $this->reset();
        }else{
            $this->send_event_at_sweetAlerte("Erreur","La CategorieService selectionner n'existe pas !!", "error");
            return ;
        }
    }

    function showServiceCategorieService(int $id_CategorieService)  {
        $CategorieService = CategorieService::find($id_CategorieService);
        if(!$CategorieService){
            $this->send_event_at_sweetAlerte("Erreur","La Categorie selectionner n'existe pas !!", "error");
            return ;
        }

        $this->idCategorieService = $id_CategorieService;
        $this->libelle = $CategorieService->libelle;
        $this->list_service = Service::where('categorie_service_id', $CategorieService->id)->get();

        if($this->list_service->count() == 0){
            $this->send_event_at_sweetAlerte("Erreur","La Categorie selectionner n'a pas de services enregistré !!", "info");
            return ;
        }

        // Log
        //ActivityLog("Voir les services d'une CategorieService : ".$CategorieService->libelle, "Admin");

        $this->launch_modal("show_service_CategorieService");
    }

    public function render()
    {
        return view('livewire.dashboard.categorie.allcategorie', [
            'list_categories' => CategorieService::OrderBy('created_at', 'desc')->get()
        ]);
    }
}
