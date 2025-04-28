<?php

namespace App\Livewire\Dashboard\Produit;

use App\Models\Marque;
use App\Models\Produit;
use Livewire\Component;
use App\Models\Categorie;
use App\Models\VarianteProduit;
use App\Livewire\UtilsSweetAlert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;



class Allproduit extends Component
{

    use UtilsSweetAlert, WithFileUploads;

    public $id;

    //Produits
    public $libelle, $description , $prix_fixe, $categorie_id, $marque_id, $stock_general, $AsVideo, $type, $video;

    // Variante produit
    public $produit_id , $libelle_variante, $prix , $longeur, $volume, $stock ;
    public $inputsVariante , $categories_select = [];

    //Table datas
    public $AsImages_produit , $couleurs , $AsImages_variante = [];

    public $search = '';

    public $list_images_preview, $view_video ;

    public $couleursDisponibles = ['Noir', 'Brun', 'Blond', 'Ombre Hair', 'Bordeaux','Châtain','Marron'];
    public $list_type = ['Domicile','Extérieur','Domicile et Extérieur'];


    public function mount()  {
     
        $this->fill([
            'inputsVariante' => Collect([
                //ajouter aussi un tableau de couleurs
                    ['libelle' => '', 'prix' => '', 'longeur' => '', 'volume' => '', 'stock' => '', 'couleurs' => []],
            ])
        ]);
    }


    protected $rules=[
        'libelle' =>  ['required','min:3'],
        'categorie_id' => ['required','exists:categories,id'],
        'AsImages_produit' => 'required',
        'stock_general' => 'required|numeric|min:1',
        'type' => 'required',
        'prix_fixe' => 'required|numeric|min:5000',
    ];

    protected $messages = [
        'libelle.required' => "Un Nom de marque est requis",
        'libelle.libelle' => "Minimum 3 caractere",
        'categories_select.required' => "Une categorie est requise",
        'marque_id.exists' => "La marque n'existe pas !!",
        'stock_general.required' => "Le stock est requis",
        'stock_general.numeric' => "Le stock doit etre numerique",
        'stock_general.min' => "Le stock doit etre superieur a 0",
        'prix_fixe.required' => "Le prix est requis",
        'prix_fixe.numeric' => "Le prix doit etre numerique",
        'prix_fixe.min' => "Le prix doit etre superieur a 0",
        'type.required' => "Le type est requis",
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }


    public function addproduit() {
        $this->resetExcept('inputsVariante');

        $this->launch_modal("add_produits");
    }

    public function SubmitProduit()  {
        $this->validate();


        //verifier si les categories existes
        // foreach($this->categories_select as $key => $value){
        //     $categorie = Categorie::find($value);
        //     if(!$categorie){
        //         $this->send_event_at_sweetAlerte("Erreur","La categorie ".Categorie::find($value)->libelle." n'existe pas !!", "error");
        //         return ;
        //     }
        // }

        $produit_exists = Produit::where('libelle', $this->libelle)->first();
        if($produit_exists){
            $this->send_event_at_sweetAlerte("Erreur","Le produit existe deja !!", "error");
            return ;
        }

        if($this->inputsVariante){
            $this->validate([
                'inputsVariante.*.longeur' => 'required|max:3',
            ]);
        }


        if($this->marque_id){
            $this->validate([
                'marque_id' => 'exists:marques,id'
            ]);
        }


        $produit = new Produit;
        $produit->libelle = $this->libelle;
        $produit->description = $this->description;
        $produit->prix_fixe = $this->prix_fixe;
        $produit->categorie_id = $this->categorie_id;
        // $produit->categories = json_encode($this->categories_select);
        $produit->marque_id = $this->marque_id;
        $produit->type = $this->type;
        $produit->stock = $this->stock_general;
        $produit->link_video = $this->AsVideo ? $this->saveVideoToAWS($this->AsVideo) : null;
        $produit->slug = generateSlug('Produit',$produit->libelle);
        $produit->couleurs = json_encode($this->couleurs);

        if($this->AsImages_produit){
            $table_img = [];
            foreach ($this->AsImages_produit as $key => $value) {
                $img = $value;
                $messi = md5($img->getClientOriginalExtension().time().$value).".".$img->getClientOriginalExtension();

                $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                    'folder' => 'twins',
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
        }

        $produit->images = json_encode($table_img);
        $produit->save();


        if($this->inputsVariante){
            foreach ($this->inputsVariante as $key => $value) {
                $data = [
                    'produit_id' => $produit->id,
                    'libelle' => $value['libelle'],
                    'prix' => $value['prix'] ? intval($value['prix']) : $this->prix_fixe,
                    'longeur' => $value['longeur'],
                    'volume' => $value['volume'],
                    'stock' => $value['stock'],
                    'couleurs' => json_encode($value['couleurs']),
                ];
                $this->saveVarianteProduit($data);
            }

            if($this->stock_general == 0 ){
                //le stock produit doit etre egale a la sum de tous les stocks des variantes renseigner
                $total_stock = VarianteProduit::where('produit_id', $produit->id)->sum('stock');
                $produit->stock =  $this->stock_general < $total_stock ? $total_stock : $this->stock_general;
                $produit->save();
            }

        }

        $this->reset();

        $this->send_event_at_sweetAlerte("Success","Le produit a été ajouté avec succès !!", "success");
    }

    public function saveVarianteProduit($data) {

        $variante = new VarianteProduit;
        $variante->produit_id = $data['produit_id'];
        $variante->libelle = $data['libelle'] ?? null;
        $variante->prix = $data['prix'] ?? null;
        $variante->longeur = $data['longeur'] ?? null;
        $variante->volume = $data['volume'] ?? null;
        $variante->stock = $data['stock'] ?? null;
        $variante->couleurs = $data['couleurs'] ?? null;
        $variante->save();

    }

    public function editProduit($id) {
        $produit = Produit::where('id', $id)->first();
        if(!$produit) {
            $this->send_event_at_toast('Produit introuvable !!','error','top-right');
            return ;
        }

        $this->id = $produit->id;
        $this->libelle = $produit->libelle;
        $this->description = $produit->description;
        $this->prix_fixe = $produit->prix_fixe;
        $this->categorie_id = $produit->categorie_id;
        // $this->categories_select = json_decode($produit->categories);
        $this->marque_id = $produit->marque_id;
        $this->type = $produit->type;
        $this->stock_general = $produit->stock;
        if($produit->variante_produit->count() > 0) {
            $table  = array();
            foreach ($produit->variante_produit as $key => $value) {
                $bb = [
                    'libelle' => $value->libelle,
                    'prix' => $value->prix,
                    'longeur' => $value->longeur,
                    'volume' => $value->volume,
                    'stock' => $value->stock,
                    'couleurs' => json_decode($value->couleurs),
                ];
                array_push($table, $bb);
            }
            $this->inputsVariante = Collect($table);
        }else{
            $this->reset('inputsVariante');
        }
        $this->sendContentAtSummernote("description2", $this->description);
        $this->launch_modal("edit_produit");
    }



    public function UpdateProduit() {
        $produit = Produit::find($this->id);
        if(!$produit) {
            $this->send_event_at_sweetAlerte('Non Trouvé!!','le produit n\'existe pas !!','error');
            return ;
        }


        $this->validate([
            'libelle' =>  ['required','min:3','unique:produits,libelle,'.$produit->id],
            'categorie_id' => ['required','exists:categories,id'],
            'prix_fixe' => 'required|numeric',
            'stock_general' => 'required|numeric',
            'type' => 'required'
        ],[
            'libelle.required' => 'Le libelle est obligatoire.',
            'libelle.min' => 'Le libellé doit avoir au moins 3 caractères.',
            'libelle.unique' => 'Un produit avec ce libellé existe deja.',
            'categories_select.required' => 'La categorie est obligatoire.',
            'categories_select.exists' => 'La categorie n\'existe pas.',
            'prix_fixe.required' => 'Le prix est obligatoire.',
            'prix_fixe.numeric' => 'Le prix doit etre un nombre.',
            'stock_general.required' => 'Le stock est obligatoire.',
            'stock_general.numeric' => 'Le stock doit etre un nombre.',
            'type.required' => 'Le type est obligatoire.',
        ]);

        if(!$this->inputsVariante){
            $this->validate([
                'prix_fixe' => 'required|numeric'
            ]);
        }


        $produit->libelle = $this->libelle;
        $produit->description = $this->description;
        $produit->prix_fixe = $this->prix_fixe;
        $produit->categorie_id = $this->categorie_id;
        // $produit->categories = json_encode($this->categories_select);
        $produit->marque_id = $this->marque_id;
        $produit->type = $this->type;
        $produit->stock = $this->stock_general;
        $produit->link_video = $this->AsVideo ? $this->saveVideoToAWS($this->AsVideo) : null;
        $produit->save();

        if($this->inputsVariante){
            $this->validate([
                'inputsVariante.*.longeur' => 'required',
            ]);
            $this->deleteVarianteForProduct($produit->id);

            foreach ($this->inputsVariante as $key => $value) {
                $data = [
                    'produit_id' => $produit->id,
                    'libelle' => $value['libelle'],
                    'prix' => $value['prix'] ?? $this->prix_fixe,
                    'longeur' => $value['longeur'],
                    'volume' => $value['volume'],
                    'stock' => $value['stock'],
                    'couleurs' => json_encode($value['couleurs']),
                ];
                $this->saveVarianteProduit($data);
            }
            if($this->stock_general == 0){
                $total_stock = VarianteProduit::where('produit_id', $produit->id)->sum('stock');
                $produit->stock =  $this->stock_general < $total_stock ? $total_stock : $this->stock_general;
                $produit->save();
            }

        }

        $this->send_event_at_sweetAlerte('Modification effectuer','Produit mis à jour', 'success');
        $this->closeModal_after_edit('edit_produit');
        $this->reset();

    }

    public function deleteVarianteForProduct($id)  {
        $produit = Produit::find($id);

        if($produit->variante_produit){
            foreach ($produit->variante_produit as $key => $value) {
                $value->delete();
            }
        }
    }

    public function deleteProduit($id) {
        $produit = Produit::where('id', $id)->first();
        if(!$produit) {
            $this->send_event_at_toast('Produit introuvable !!','error','top-right');
            return ;
        }

        $this->sweetAlert_confirm_options($produit ,'Voulez-vous supprimer ce produit ?', 'Supprimer ce produit revient a supprimer tous les variantes associés ,Etes-vous sur de vouloir supprimer ce produit ?', 'DestroyProduit', 'warning');
    }

    #[on('DestroyProduit')]
    public function DestroyProduit($id)  {
        $produit = Produit::where('id', $id)->first();
        if(!$produit) {
            $this->send_event_at_toast('Produit introuvable !!','error','top-right');
            return ;
        }

        if($produit->images) {
            foreach (json_decode($produit->images) as $key => $value) {
                 $publicId = pathinfo(parse_url($value, PHP_URL_PATH), PATHINFO_FILENAME);

                 if($publicId){
                     $result = Cloudinary::destroy('twins/' . $publicId);
                 }
            }
        }

        $produit->delete();
        $this->send_event_at_sweetAlerte('Suppression effectuer','Produit supprimé', 'success');
    }

    public function showImages($id) {
        $produit = Produit::where('id', $id)->first();
        if(!$produit) {
            $this->send_event_at_toast('Produit introuvable !!','error','top-right');
            return ;
        }

        $this->id = $produit->id;
        $this->list_images_preview = json_decode($produit->images);
        $this->launch_modal('view_img');
    }

    public function Ajout_ImagesSecondaire_atProduct()
    {
        $produit = Produit::find($this->id);
        if($produit){

            $this->validate([
                'AsImages_produit' => 'required'
            ]);

            if(!is_null($produit->images)){
                if ($this->AsImages_produit) {
                    $table_img = [];
                    foreach ($this->AsImages_produit as $key => $value) {
                        $img = $value;
                        $messi = md5($img->getClientOriginalExtension().time().$value).".".$img->getClientOriginalExtension();

                        $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                            'folder' => 'twins',
                            'transformation' => [
                                'width' => 800,
                                'height' => 800,
                                'crop' => 'fill'
                            ]
                        ]);

                        $publicId = $uploadedImage->getPublicId();

                        $imageUrl = Cloudinary::getUrl($publicId);

                        $table_img[]  = $imageUrl;
                    }
                }

                $produit->images = json_encode(array_merge(json_decode($produit->images),$table_img));
                $produit->update();
                $this->send_event_at_sweetAlerte("Success","La sélection a bien été enregistré !!", "success");
                $this->reset('AsImages_produit');

            }else{
                if ($this->AsImages_produit) {
                    $table_img = [];
                    foreach ($this->AsImages_produit as $key => $value) {
                        $img = $value;
                        $messi = md5($img->getClientOriginalExtension().time().$value).".".$img->getClientOriginalExtension();

                        $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                            'folder' => 'twins',
                            'transformation' => [
                                'width' => 800,
                                'height' => 800,
                                'crop' => 'fill'
                            ]
                        ]);

                        $publicId = $uploadedImage->getPublicId();

                        $imageUrl = Cloudinary::getUrl($publicId);

                        $table_img[]  = $imageUrl;
                    }
                }

                $produit->images = json_encode($table_img);
                $produit->update();
                $this->send_event_at_sweetAlerte("Success","La sélection a bien été enregistré !!", "success");
                $this->reset('AsImages_produit');
            }

            $this->list_images_preview = json_decode($produit->images);
        }
    }


    public function deleteOneImage_atProduct($key_img)
    {
        $produit = Produit::find($this->id);
        if ($produit) {
            // Vérifier s'il reste une seule image dans le tableau
            $table_img = json_decode($produit->images, true);
            if (count($table_img) == 1) {
                $this->send_event_at_sweet_alert_not_timer("Error", "Vous devez garder au moins une image pour ce produit !!", "error");
                return;
            }

            // Récupérer l'image à supprimer
            $nom = $table_img[$key_img];
            unset($table_img[$key_img]);

            // 🔥 Réindexer le tableau pour éviter l'objet JSON
            $table_img = array_values($table_img);

            // Mettre à jour l'attribut images
            $produit->images = json_encode($table_img);


            // Supprimer l'image de Cloudinary
            $publicId = pathinfo(parse_url($nom, PHP_URL_PATH), PATHINFO_FILENAME);
            if ($publicId) {
                Cloudinary::destroy('twins/' . $publicId);
            }

            // Sauvegarder les changements
            $produit->update();

            // Afficher une notification
            $this->send_event_at_sweetAlerte("Success", "La sélection a bien été supprimée !!", "success");

            // Mettre à jour la liste des images affichées
            $this->list_images_preview = json_decode($produit->images);
        }
    }


    public function deleteOneImage_atSelection($key)  {
        $table_image = $this->AsImages_produit;
        unset($this->AsImages_produit[$key]);
        $this->AsImages_produit = array_values($this->AsImages_produit);
    }


    public function changeStatus($id)  {
        $produit = Produit::where('id', $id)->first();
        if(!$produit) {
            $this->send_event_at_toast('Produit introuvable !!','error','top-right');
            return ;
        }

        if($produit->status == "INACTIVATED"){
            if($produit->stock == 0){
                $this->send_event_at_toast('Produit en rupture de stock, veuillez ajouter du stock !!','error','top-right');
                return ;
            }

            if($produit->categorie()->count() == 0){
                $this->send_event_at_toast('Le produit n\'est pas associé à une categorie, vous devez l\'ajouter avant de l\'activer !!','error','top-right');
                return ;
            }
        }

        $produit->status = $produit->status == "ACTIVATED" ? "INACTIVATED" : "ACTIVATED";
        $produit->update();
        $this->send_event_at_toast('Produit mis en ligne !!','success','top-right');
    }




    //UTILITIES
    public function addInputsVariante()  {
        if(is_null($this->inputsVariante)) {
            $this->fill([
                'inputsVariante' => Collect([
                    //ajouter aussi un tableau de couleurs
                        ['libelle' => '', 'prix' => '', 'longeur' => '', 'volume' => '', 'stock' => '', 'couleurs' => []],
                ])
            ]);
        }else{
            $this->inputsVariante->push( ['libelle' => '', 'prix' => '', 'longeur' => '', 'volume' => '', 'stock' => '', 'couleurs' => []] );
        }
    }

    function removeInputsVariante(int $clef) : void {
        $this->inputsVariante->pull($clef);
    }

      /**UTILITIES */
      protected function saveVideoToAWS($vds)  {
        try {
            $video = $vds;

             // Stocker la vidéo sur S3 (dans un dossier "videos")
             $videoPath = $video->store('videos', 's3');

             // Rendre le fichier public pour pouvoir y accéder via URL
             Storage::disk('s3')->setVisibility($videoPath, 'public');

             // Obtenir l'URL de la vidéo stockée
             $videoUrl = Storage::disk('s3')->url($videoPath);

            return $videoUrl;

        } catch (Exception $e) {
            $this->send_event_at_toast($e->getMessage(),'error','bottom-right');
            return;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.produit.allproduit',[
            'list_categorie' =>  Categorie::OrderBy('libelle')->get(),
            'list_marques' =>  Marque::OrderBy('libelle')->get(),
            'list_produits' => Produit::where('libelle', 'like', '%'.$this->search.'%')->OrderBy('created_at', 'desc')->get()
        ]);
    }
}
