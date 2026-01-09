<?php

namespace App\Models;

use App\Models\User;
use App\Models\Entreprise;
use App\Models\Reservation;
use App\Models\HistoriqueEntretient;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable = [
        'libelle',
        'matricule',
        'type',
        'marque',
        'images',
        'chassis',
        'modele',
        'status',
        'year',
        'description',
        'slug',
         'user_id',
        'entreprise_id',

        //new champs
        'date_prochaine_visite',
        'cout_vidange_estime',
        'kilometrage_actuel',
        'carburant',
        'couleur',
        'date_mise_circulation'
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function historique_entretiens()
    {
        return $this->hasMany(HistoriqueEntretient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Réservations du véhicule
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeClient($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Véhicules actifs
     */
    public function scopeActif($query)
    {
        return $query->where('status', 'actif');
    }

    public function getNomCompletAttribute(): string
    {
        return trim("{$this->marque} {$this->modele}");
    }

    /**
     * Image principale
     */
    public function getImagePrincipaleAttribute(): string
    {
        if (is_array($this->images) && count($this->images) > 0) {
            return $this->images[0];
        }
        return asset('images/default-car.png');
    }

    /**
     * Âge du véhicule
     */
    public function getAgeAttribute(): ?int
    {
        return $this->year ? now()->year - $this->year : null;
    }

    /**
     * Dernière révision
     */
    public function getDerniereRevisionAttribute()
    {
        return $this->reservations()
            ->where('status', Reservation::COMPLETED)
            ->latest('date_debut')
            ->first();
    }

    /**
     * Nombre de révisions
     */
    public function getNombreRevisionsAttribute(): int
    {
        return $this->reservations()
            ->where('status', Reservation::COMPLETED)
            ->count();
    }

    /**
     * Prochaine révision recommandée
     */
    public function getProchaineRevisionRecommandeeAttribute(): ?string
    {
        if ($this->date_prochaine_visite) {
            return $this->date_prochaine_visite->locale('fr')->isoFormat('D MMMM YYYY');
        }
        return null;
    }

    // ================================
    // MÉTHODES UTILES
    // ================================

    /**
     * Besoin d'entretien bientôt ?
     */
    public function besoinEntretienProche(): bool
    {
        if (!$this->date_prochaine_visite) {
            return false;
        }

        return $this->date_prochaine_visite->diffInDays(now()) <= 30;
    }

    /**
     * Entretien en retard ?
     */
    public function entretienEnRetard(): bool
    {
        if (!$this->date_prochaine_visite) {
            return false;
        }

        return $this->date_prochaine_visite < now();
    }
}
