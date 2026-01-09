<?php

namespace App\Models;

use App\Models\User;
use App\Models\Service;
use App\Models\Paiement;
use App\Models\Vehicule;
use App\Models\Entreprise;
use App\Models\CategorieService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    CONST PENDING = "en attente";
    CONST CANCELED = "ANNULER";
    CONST COMPLETED = "TERMINEE";
    CONST VALIDATE = "VALIDEE";
    CONST STARTED = "STARTED";
    CONST SUCCESSFUL = "SUCCESSFUL";
    CONST NOT_PAID = "NOT_PAID";
    CONST INITIATED = "INITIATED";

    protected $fillable = [
        'montant',
        'chassis',
        'status',
        'status_paiement',
        'description',
        'adresse_name',
        'location',
        'date_debut',
        'images',
        'start_at',
        'date_fin',
        'user_id',
        'commune',
        'category',
        'snapshot_services',
        'snapshot_users',
        'snapshot_vehicule',
        'slug',
        'name_prestataire',
        'outils',

        //new champs
        'vehicule_id',
        'type_maintenance',
        'cout_reel',
        'notes_mecanicien',
        'rappel_envoye',
        'entreprise_id',

        'categorie_service_id',
        'snapshot_categorie', // NOUVEAU : snapshot de la catégorie
        'snapshot_services_selectionnes',
        'services_ids',
    ];

    protected $casts = [
        'montant' => 'integer',
        'location' => 'array',
        'snapshot_services' => 'array',
        'snapshot_users' => 'array',
        'snapshot_vehicule' => 'array',
        'date_debut' => 'datetime',
        'start_at' => 'datetime',
        'date_fin' => 'datetime',
        'snapshot_categorie' => 'array',
        'snapshot_services_selectionnes' => 'array',
        'services_ids' => 'array',
    ];

    public function paiements()  {
        return $this->hasMany(Paiement::class);
    }

    public function entreprise()  {
        return $this->belongsTo(Entreprise::class);
    }
    // public function categorieService()  {
    //     $this->belongsTo(CategorieService::class, 'category_id');
    // }

    // ================================
    // Boot pour formater les snapshots avant save
    // ================================
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($reservation) {
            $reservation->formatSnapshots();
        });
    }

    // ================================
    // Génération automatique des snapshots
    // ================================
    public function formatSnapshots()
    {
        // Snapshot des Services (Besoins) sélectionnés
        if (!empty($this->services_ids)) {
            $services = Service::whereIn('id', $this->services_ids)->get();

            $this->snapshot_services_selectionnes = $services->map(function($service) {
                return [
                    'id' => $service->id,
                    'libelle' => $service->libelle,
                    'frais_service' => $service->frais_service,
                    'unite' => $service->unite,
                ];
            })->toArray();
        }


        // Snapshot de l'Utilisateur
        if ($this->user_id) {
            $user = User::find($this->user_id);

            if ($user) {
                $this->snapshot_users = [
                    'id' => $user->id,
                    'nom' => $user->nom,
                    'prenom' => $user->prenom,
                    'username' => $user->username,
                    'phone' => $user->phone,
                    'email' => $user->email,
                ];
            }
        }

        // Snapshot du Véhicule
        if ($this->vehicule_id) {
            $vehicule = Vehicule::find($this->vehicule_id);
            if ($vehicule) {
                $this->snapshot_vehicule = [
                    'id' => $vehicule->id,
                    'libelle' => $vehicule->libelle,
                    'matricule' => $vehicule->matricule,
                    'marque' => $vehicule->marque,
                    'modele' => $vehicule->modele,
                ];
            }
        }

    }

    // ================================
    // Relations
    // ================================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function categorieService()
    {
        return $this->belongsTo(CategorieService::class, 'categorie_service_id');
    }


    public function servicesSelectionnes()
    {
        if (empty($this->services_ids)) {
            return collect([]);
        }

        return Service::whereIn('id', $this->services_ids)->get();
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    // ================================
    // SCOPES POUR LA PWA
    // ================================

    /**
     * Réservations à venir
     */
    public function scopeAvenir($query)
    {
        return $query->where('date_debut', '>', now())
            ->whereIn('status', [self::PENDING, self::VALIDATE])
            ->orderBy('date_debut', 'asc');
    }

    /**
     * Réservations passées
     */
    public function scopePassees($query)
    {
        return $query->where(function($q) {
            $q->where('date_debut', '<', now())
              ->orWhere('status', self::COMPLETED);
        })->orderBy('date_debut', 'desc');
    }

    /**
     * Réservations en cours
     */
    public function scopeEnCours($query)
    {
        return $query->where('status', self::STARTED);
    }

    /**
     * Réservations en attente
     */
    public function scopeEnAttente($query)
    {
        return $query->where('status', self::PENDING);
    }

    /**
     * Réservations validées
     */
    public function scopeValidees($query)
    {
        return $query->where('status', self::VALIDATE);
    }

    /**
     * Réservations terminées
     */
    public function scopeTerminees($query)
    {
        return $query->where('status', self::COMPLETED);
    }

    /**
     * Réservations annulées
     */
    public function scopeAnnulees($query)
    {
        return $query->where('status', self::CANCELED);
    }

    // ================================
    // ACCESSORS POUR LA PWA
    // ================================

    /**
     * Badge de statut avec couleur
     */
    public function getStatusBadgeAttribute(): array
    {
        return match($this->status) {
            self::PENDING => [
                'label' => 'En attente',
                'color' => 'warning',
                'icon' => '⏳'
            ],
            self::VALIDATE => [
                'label' => 'Validée',
                'color' => 'info',
                'icon' => '✓'
            ],
            self::STARTED => [
                'label' => 'En cours',
                'color' => 'primary',
                'icon' => '🔧'
            ],
            self::COMPLETED => [
                'label' => 'Terminée',
                'color' => 'success',
                'icon' => '✅'
            ],
            self::CANCELED => [
                'label' => 'Annulée',
                'color' => 'danger',
                'icon' => '❌'
            ],
            default => [
                'label' => 'Inconnu',
                'color' => 'secondary',
                'icon' => '❓'
            ],
        };
    }

    /**
     * Statut de paiement formaté
     */
    public function getStatusPaiementBadgeAttribute(): array
    {
        return match($this->status_paiement) {
            Paiement::PAID, Paiement::SUCCESSFUL => [
                'label' => 'Payé',
                'color' => 'success',
                'icon' => '💳'
            ],
            Paiement::PENDING => [
                'label' => 'En attente',
                'color' => 'warning',
                'icon' => '⏳'
            ],
            default => [
                'label' => 'Non payé',
                'color' => 'danger',
                'icon' => '❌'
            ],
        };
    }

    /**
     * Date formatée pour humains
     */
    public function getDateDebutFormattedAttribute(): string
    {
        return $this->date_debut->locale('fr')->isoFormat('dddd D MMMM YYYY [à] HH:mm');
    }

    /**
     * Heure uniquement
     */
    public function getHeureDebutAttribute(): string
    {
        return $this->date_debut->format('H:i');
    }

    /**
     * Date courte
     */
    public function getDateCourteAttribute(): string
    {
        return $this->date_debut->format('d/m/Y');
    }

    /**
     * Montant formaté
     */
    public function getMontantFormattedAttribute(): string
    {
        return number_format($this->montant, 0, ',', ' ') . ' FCFA';
    }

    // ================================
    // MÉTHODES UTILES POUR LA PWA
    // ================================

    /**
     * Peut être annulée ?
     */
    public function peutEtreAnnulee(): bool
    {
        return in_array($this->status, [self::PENDING, self::VALIDATE]) &&
               $this->date_debut > now()->addHours(24);
    }

    /**
     * Est confirmée ?
     */
    public function estConfirmee(): bool
    {
        return $this->status === self::VALIDATE;
    }

    /**
     * Est terminée ?
     */
    public function estTerminee(): bool
    {
        return $this->status === self::COMPLETED;
    }

    /**
     * Est en attente ?
     */
    public function estEnAttente(): bool
    {
        return $this->status === self::PENDING;
    }

    /**
     * Est payée ?
     */
    public function estPayee(): bool
    {
        return in_array($this->status_paiement, [Paiement::PAID, Paiement::SUCCESSFUL]);
    }

    /**
     * Paiement de la réservation
     */
    public function paiement()
    {
        return $this->paiements()->latest()->first();
    }

    /**
     * Temps restant avant le rendez-vous
     */
    public function tempsRestant(): string
    {
        if ($this->date_debut < now()) {
            return 'Passé';
        }

        return $this->date_debut->locale('fr')->diffForHumans();
    }

    /**
     * Infos véhicule depuis snapshot ou relation
     */
    public function getVehiculeInfoAttribute()
    {
        return $this->snapshot_vehicule ?? $this->vehicule;
    }

    /**
     * Infos service depuis snapshot ou relation
     */
    public function getServiceInfoAttribute()
    {
        return $this->snapshot_services ?? $this->service;
    }


    public function getBesoinsListeAttribute(): string
    {
        if (empty($this->snapshot_services_selectionnes)) {
            return 'Aucun besoin spécifique';
        }

        return collect($this->snapshot_services_selectionnes)
            ->pluck('libelle')
            ->join(', ');
    }

     public function getCoutBesoinsAttribute(): int
    {
        if (empty($this->snapshot_services_selectionnes)) {
            return 0;
        }

        return collect($this->snapshot_services_selectionnes)
            ->sum('frais_service');
    }

}
