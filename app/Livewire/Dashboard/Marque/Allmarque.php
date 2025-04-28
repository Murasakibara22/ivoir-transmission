<?php

namespace App\Livewire\Dashboard\Marque;

use App\Models\Marque;
use App\Models\Produit;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use App\Livewire\UtilsSweetAlert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Allmarque extends Component
{
    use WithFileUploads, UtilsSweetAlert ;

    #[Locked]
    public $idmarque;

    public $libelle , $description , $Aslogo ;

    public $list_produit;

    protected $rules=[
        'libelle' =>  ['required','min:3']
    ];

    protected $messages = [
        'libelle.required' => "Un Nom de marque est requis",
        'libelle.libelle' => "Minimum 3 caractere",
    ];


    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    function addmarque() : void {
        $this->reset();
        $this->launch_modal("add_marque");
    }

    function submitmarque()  {
        $this->validate();

        $marque_exist = Marque::where('libelle', $this->libelle)->first();
        if($marque_exist){
            // Log
            //ActivityLog("Tentative d'ajout de nouvelle marque: ".$this->libelle, "Admin");

            $this->send_event_at_toast('marque existe déja', 'warning', 'top-right');
            return;
        }

        $marque = new marque();
        $marque->libelle = $this->libelle;
        if($this->Aslogo){
            $img = $this->Aslogo;
            $messi = md5($img->getClientOriginalExtension().time().$this->Aslogo).".".$img->getClientOriginalExtension();

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

            $marque->logo  = $imageUrl;
        }
        $marque->slug = generateSlug('marque' , $marque->libelle);
        $marque->save();

        // Log
        //ActivityLog("Enregistrement d'une nouvelle marque : ".$marque->libelle, "Admin");

        $this->send_event_at_toast('marque ajoutée avec succès', 'success', 'top-right');
        $this->resetSummernote("description");
        $this->reset();
    }


    function editmarque(int $id_marque)  {
        $marque = Marque::find($id_marque);
        if($marque){
            $this->idmarque = $marque->id;
            $this->libelle = $marque->libelle;

            $this->sendContentAtSummernote("description2", $this->description);
            $this->launch_modal("edit_marque");
        }else{
            $this->send_event_at_sweetAlerte("Erreur","La marque selectionner n'existe pas !!", "error");
            return ;
        }
    }

    function updatemarque()  {
        $this->validate();
        $marque = Marque::find($this->idmarque);
        if($marque){

            if($this->Aslogo != null){

                // Extraire le public ID à partir de l'URL de l'image
                $publicId = pathinfo(parse_url($marque->logo, PHP_URL_PATH), PATHINFO_FILENAME);

                if($publicId){
                    // Supprimer l'image de Cloudinary
                    $result = Cloudinary::destroy('twins/' . $publicId);
                }

                $img = $this->Aslogo;
                $messi = md5($img->getClientOriginalExtension().time().$this->Aslogo).".".$img->getClientOriginalExtension();

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

               $marque->logo  = $imageUrl;
            }
            $marque->libelle = $this->libelle ;
            $marque->slug = generateSlug('marque' , $marque->libelle);
            $marque->update();

            // Log
        //ActivityLog("Modification d'une marque : ".$marque->libelle, "Admin");

            $this->send_event_at_sweetAlerte("Valider","Modification effectuer !!", "success");
            $this->closeModal_after_edit("edit_marque");
            $this->reset();

        }else{
            $this->send_event_at_sweetAlerte("Erreur","La marque selectionner n'existe pas !!", "error");
            return ;
        }
    }

    function deletemarque($id_marque)  {
        $marque = Marque::find($id_marque);
        if($marque){
            if($marque->produits()->exists()){
                $this->send_event_at_sweet_alert_not_timer("Erreur","La marque sélectionnée n'est pas vide ! Veuillez d'abord supprimer les services et les services supplémentaires. !!", "error");
                return ;
            }
            $this->sweetAlert_confirm_options($marque ,"Supperssion de marque","Etes-vous sur de vouloir supprimer : $marque->libelle","Destoymarque", "error");
        }else{
            $this->send_event_at_sweetAlerte("Erreur","La marque selectionner n'existe pas !!", "error");
            return ;
        }
    }

    #[on('Destoymarque')]
    function Destoy($id) {
        $marque = Marque::find($id);
        if($marque){

            // Extraire le public ID à partir de l'URL de l'image
            $publicId = pathinfo(parse_url($marque->logo, PHP_URL_PATH), PATHINFO_FILENAME);

            if($publicId){
                // Supprimer l'image de Cloudinary
                $result = Cloudinary::destroy('twins/' . $publicId);
            }

            // Log
            //ActivityLog(" Suppression d'une marque : ".$marque->libelle, "Admin");

            Produit::each(function ($produit) use ($marque) {
                if($produit->marque_id == $marque->id){
                    $produit->marque_id = NULL;
                }
            });

            $marque->delete();
            $this->send_event_at_toast("Supression Effectuer !!", "success", "bottom-end");
            $this->reset();
        }else{
            $this->send_event_at_sweetAlerte("Erreur","La marque selectionner n'existe pas !!", "error");
            return ;
        }
    }

    function showServicemarque(int $id_marque)  {
        $marque = Marque::find($id_marque);
        if(!$marque){
            $this->send_event_at_sweetAlerte("Erreur","La marque selectionner n'existe pas !!", "error");
            return ;
        }

        $this->idmarque = $id_marque;
        $this->libelle = $marque->libelle;
        $this->list_produit = Produit::where('marque_id', $marque->id)->get();

        if($this->list_produit->count() == 0){
            $this->send_event_at_sweetAlerte("Erreur","La marque selectionner n'a pas de produits enregistré !!", "info");
            return ;
        }

        // Log
        //ActivityLog("Voir les services d'une marque : ".$marque->libelle, "Admin");

        $this->launch_modal("show_service_marque");
    }

    public function render()
    {
        return view('livewire.dashboard.marque.allmarque', [
            'list_marques' => Marque::OrderBy('created_at', 'desc')->get()
        ]);
    }
}
