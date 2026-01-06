<?php

namespace App\Livewire\Dashboard\Entreprise;

use Livewire\Component;
use App\Models\Entreprise;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Livewire\UtilsSweetAlert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EntrepriseCredentials;
use Livewire\Attributes\On;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class Allentreprise extends Component
{
    use UtilsSweetAlert, WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $id_entreprise;

    public $AsImage, $name, $address, $phone, $email, $type, $status, $cgu;

    public $search = '';
    public $filter_type = '';
    public $filter_status = '';
    public $filter_date = '';


    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|numeric|unique:entreprises,phone',
        'email' => 'required|email|max:255|unique:entreprises,email',
        'type' => 'required|string',
        'address' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'name.required' => 'Ce champ est obligatoire',
        'name.string' => 'Ce champs doit être une chaine de caractères',
        'name.max' => 'Ce champs ne doit pas dépasser 255 caractères',
        'phone.required' => 'Le phone est obligatoire',
        'phone.string' => 'Le phone doit être une chaine de caractères',
        'phone.max' => 'Le phone ne doit pas dépasser 15 caractères',
        'phone.integer' => 'Le phone doit être un nombre',
        'phone.not_exists' => 'Le phone existe déja',
        'email.required' => 'L\'email est obligatoire',
        'email.string' => 'L\'email doit être une chaine de caractères',
        'email.max' => 'L\'email ne doit pas dépasser 255 caractères',
        'email.email' => 'L\'email doit être une adresse email valide',
        'email.not_exists' => 'L\'email existe déja',
        'type.required' => 'Le type est obligatoire',
    ];

     public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addEntreprise(){
        $this->reset();
        $this->launch_modal('add_entreprise');
    }

     public function storeEntreprise(){
        $this->validate();

        $photo = null;
        if ($this->AsImage) {
                $img = $this->AsImage;
                $messi = md5($img->getClientOriginalExtension().time().$this->AsImage).".".$img->getClientOriginalExtension();

                $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                    'folder' => 'ivoireTransmission',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'fill'
                    ]
                ]);

                $publicId = $uploadedImage->getPublicId();

                $imageUrl = Cloudinary::getUrl($publicId);

                $photo  = $imageUrl;

        }

        if (preg_match('/^[\d+]+$/', $this->phone)) {
            // Générer un mot de passe aléatoire de 10 caractères
            $generatedPassword = \Illuminate\Support\Str::random(10);

            $entreprise = Entreprise::create([
                'name' => $this->name,
                'phone' => "+225".$this->phone,
                'email' => $this->email,
                'logo' => $photo,
                'type' => $this->type ?? 'FREE',
                'address' => $this->address,
                'status' => 'ACTIVATED',
                'slug' => generateSlug('Entreprise', $this->name),
                'password' => Hash::make($generatedPassword),
            ]);

            // Envoyer l'email avec les credentials
            try {
                Mail::to($entreprise->email)->send(new EntrepriseCredentials($entreprise, $generatedPassword));
                $this->send_event_at_sweetAlerte('Action réussie !!','L\'entreprise a été ajoutée avec succès. Un email avec les identifiants a été envoyé à '.$entreprise->email, 'success');
            } catch (\Exception $e) {
                // Log l'erreur mais continue quand même
                \Log::error('Erreur envoi email credentials: ' . $e->getMessage());
                $this->send_event_at_sweetAlerte('Entreprise créée','L\'entreprise a été créée mais l\'email n\'a pas pu être envoyé. Mot de passe: '.$generatedPassword, 'warning');
            }

        } else {
            $this->send_event_at_toast('Le contact doit être un nombre', 'error','bottom-right');
            return;
        }

        $this->reset();
    }



    /**
     * Fonction pour ouvrir le modal de modification d'une entreprise
    */
    public function editEntreprise(int $id_entreprise)
    {
        $entreprise = Entreprise::find($id_entreprise);

        if ($entreprise) {
            $this->id_entreprise = $entreprise->id;
            $this->name = $entreprise->name;
            $this->address = $entreprise->address;
            $this->phone = str_replace('+225', '', $entreprise->phone); // Retirer le code pays pour l'affichage
            $this->email = $entreprise->email;
            $this->type = $entreprise->type;
            $this->status = $entreprise->status;
            // Note: On ne récupère pas le mot de passe pour des raisons de sécurité

            $this->launch_modal("edit_entreprise");
        } else {
            $this->send_event_at_sweetAlerte("Erreur", "L'entreprise sélectionnée n'existe pas !!", "error");
            return;
        }
    }

    /**
     * Fonction pour mettre à jour les informations de l'entreprise
     */
    public function updateEntreprise()
    {
        // Règles de validation personnalisées pour la mise à jour
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:entreprises,phone,' . $this->id_entreprise,
            'email' => 'required|email|max:255|unique:entreprises,email,' . $this->id_entreprise,
        ];

        // Ajouter la validation du mot de passe seulement s'il est fourni
        if (!empty($this->password)) {
            $rules['password'] = 'min:8';
        }

        $this->validate($rules);

        $entreprise = Entreprise::find($this->id_entreprise);

        if ($entreprise) {
            // Gestion de l'upload d'image si une nouvelle image est fournie
            if ($this->AsImage != null) {
                // Supprimer l'ancienne image de Cloudinary si elle existe
                if ($entreprise->logo) {
                    $publicId = pathinfo(parse_url($entreprise->logo, PHP_URL_PATH), PATHINFO_FILENAME);
                    if ($publicId) {
                        $result = Cloudinary::destroy('ivoireTransmission/' . $publicId);
                    }
                }

                // Upload de la nouvelle image
                $img = $this->AsImage;
                $messi = md5($img->getClientOriginalExtension().time().$this->AsImage).".".$img->getClientOriginalExtension();

                $uploadedImage = Cloudinary::upload($img->getRealPath(),[
                    'folder' => 'ivoireTransmission',
                    'transformation' => [
                        'width' => 400,
                        'height' => 400,
                        'crop' => 'fill'
                    ]
                ]);

                $publicId = $uploadedImage->getPublicId();
                $imageUrl = Cloudinary::getUrl($publicId);
                $entreprise->logo = $imageUrl;
            }

            // Mise à jour des autres champs
            $entreprise->name = $this->name;
            $entreprise->address = $this->address;

            // Validation et formatage du téléphone
            if (preg_match('/^[\d+]+$/', $this->phone)) {
                $entreprise->phone = "+225" . $this->phone;
            } else {
                $this->send_event_at_toast('Le contact doit être un nombre', 'error', 'bottom-right');
                return;
            }

            $entreprise->email = $this->email;
            $entreprise->type = $this->type;
            $entreprise->status = $this->status;

            // Mise à jour du mot de passe seulement s'il est fourni
            if (!empty($this->password)) {
                $entreprise->password = Hash::make($this->password);
            }

            // Mise à jour du slug si le nom a changé
            $entreprise->slug = generateSlug('Entreprise', $entreprise->name);

            $entreprise->update();

            $this->send_event_at_sweetAlerte("Validé", "Modification effectuée !!", "success");
            $this->closeModal_after_edit("edit_entreprise");
            $this->reset();

        } else {
            $this->send_event_at_sweetAlerte("Erreur", "L'entreprise sélectionnée n'existe pas !!", "error");
            return;
        }
    }

    /**
     * Fonction pour confirmer la suppression d'une entreprise
     */
    public function confirmDelete(int $id_entreprise)
    {
        $entreprise = Entreprise::find($id_entreprise);

        if ($entreprise) {
            $this->sweetAlert_confirm_options(
                $entreprise,
                "Suppression d'entreprise",
                "Êtes-vous sûr de vouloir supprimer : $entreprise->name",
                "DestroyEntreprise",
                "error"
            );
        } else {
            $this->send_event_at_sweetAlerte("Erreur", "L'entreprise sélectionnée n'existe pas !!", "error");
            return;
        }
    }

    /**
     * Fonction appelée après confirmation de suppression
     */
    #[on('DestroyEntreprise')]
    public function destroy($id)
    {
        $entreprise = Entreprise::find($id);

        if ($entreprise) {
            // Supprimer l'image de Cloudinary si elle existe
            if ($entreprise->logo) {
                $publicId = pathinfo(parse_url($entreprise->logo, PHP_URL_PATH), PATHINFO_FILENAME);
                if ($publicId) {
                    $result = Cloudinary::destroy('ivoireTransmission/' . $publicId);
                }
            }

            $entreprise->delete();

            $this->send_event_at_toast("Suppression effectuée !!", "success", "bottom-end");
            $this->reset();

        } else {
            $this->send_event_at_sweetAlerte("Erreur", "L'entreprise sélectionnée n'existe pas !!", "error");
            return;
        }
    }



   /**
     * Méthode pour réinitialiser tous les filtres
     */
    public function resetFilters()
    {
        $this->search = '';
        $this->filter_type = '';
        $this->filter_status = '';
        $this->filter_date = '';
        $this->resetPage();
    }

    /**
     * Méthode pour exporter les données (optionnelle)
     */
    public function exportData()
    {
        $this->send_event_at_toast('Export en cours...', 'info', 'top-right');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterType()
    {
        $this->resetPage();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function updatedFilterDate()
    {
        $this->resetPage();
    }


     /**
     * Méthode helper pour calculer la progression mensuelle
     */
    private function calculateProgression($type)
    {
        $currentMonth = now()->startOfMonth();
        $lastMonth = now()->subMonth()->startOfMonth();

        switch ($type) {
            case 'entreprise':
                $current = Entreprise::where('created_at', '>=', $currentMonth)->count();
                $previous = Entreprise::whereBetween('created_at', [$lastMonth, $currentMonth])->count();
                break;

            case 'commerciale':
                $current = Entreprise::where('type', 'COMMERCIAL')
                                    ->where('created_at', '>=', $currentMonth)->count();
                $previous = Entreprise::where('type', 'COMMERCIAL')
                                    ->whereBetween('created_at', [$lastMonth, $currentMonth])->count();
                break;

            case 'user':
                $current = Entreprise::whereNotNull('email')
                                    ->where('created_at', '>=', $currentMonth)->count();
                $previous = Entreprise::whereNotNull('email')
                                    ->whereBetween('created_at', [$lastMonth, $currentMonth])->count();
                break;

            default:
                return ['percentage' => 0, 'direction' => 'up'];
        }

        if ($previous == 0) {
            return ['percentage' => $current > 0 ? 100 : 0, 'direction' => 'up'];
        }

        $percentage = round((($current - $previous) / $previous) * 100);
        $direction = $percentage >= 0 ? 'up' : 'down';

        return ['percentage' => abs($percentage), 'direction' => $direction];
    }




    public function render()
    {
        // Construction de la requête avec filtres
        $query = Entreprise::query();

        // Filtre par recherche (nom, email, téléphone)
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%');
            });
        }

        // Filtre par type d'entreprise
        if (!empty($this->filter_type)) {
            $query->where('type', $this->filter_type);
        }

        // Filtre par statut
        if (!empty($this->filter_status)) {
            $query->where('status', $this->filter_status);
        }

        // Filtre par date d'inscription
        if (!empty($this->filter_date)) {
            $query->whereDate('created_at', $this->filter_date);
        }

        // Récupération des données avec pagination
        $list_entreprise = $query->orderBy('created_at', 'desc')->paginate(30);

        // Calcul des statistiques
        $stats_all_entreprise = Entreprise::count();
        $stats_all_commerciale = Entreprise::where('type', 'COMMERCIAL')->count();
        $stats_all_user = Entreprise::whereNotNull('email')->count();

        $stats_vues_today = 1245;
        $stats_nouvelles_inscriptions = Entreprise::whereDate('created_at', today())->count();
        $stats_en_attente = Entreprise::where('status', 'PENDING')->count();
        $stats_problemes = Entreprise::where('status', 'SUSPENDED')->count();

        $stats_progression_entreprise = $this->calculateProgression('entreprise');
        $stats_progression_commerciale = $this->calculateProgression('commerciale');
        $stats_progression_user = $this->calculateProgression('user');

        return view('livewire.dashboard.entreprise.allentreprise', [
            'list_entreprise' => $list_entreprise,
            'stats_all_entreprise' => $stats_all_entreprise,
            'stats_all_commerciale' => $stats_all_commerciale,
            'stats_all_user' => $stats_all_user,
            'stats_vues_today' => $stats_vues_today,
            'stats_nouvelles_inscriptions' => $stats_nouvelles_inscriptions,
            'stats_en_attente' => $stats_en_attente,
            'stats_problemes' => $stats_problemes,
            'stats_progression_entreprise' => $stats_progression_entreprise,
            'stats_progression_commerciale' => $stats_progression_commerciale,
            'stats_progression_user' => $stats_progression_user,
        ]);
    }


}
