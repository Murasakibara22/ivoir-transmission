<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Garage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom_commercial',
        'slug',
        'email',
        'telephone',
        'adresse',
        'ville',
        'code_postal',
        'siret',
        'logo_url',
        'couleur_primaire',
        'couleur_secondaire',
        'sous_domaine',
        'status',
        'plan_id',
        'date_debut_abonnement',
        'date_fin_abonnement',
        'frais_deploiement_paye',
        'frais_deploiement',
        'limite_reservations_mois',
        'limite_admins',
        'acces_module_entreprise',
    ];

    protected $casts = [
        'date_debut_abonnement' => 'date',
        'date_fin_abonnement' => 'date',
        'frais_deploiement_paye' => 'boolean',
        'frais_deploiement' => 'decimal:2',
        'acces_module_entreprise' => 'boolean',
    ];

    // Relations
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function admins()
    {
        return $this->hasMany(User::class)->whereHas('role', function($q) {
            $q->where('name', 'admin_garage');
        });
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function categoriesServices()
    {
        return $this->hasMany(CategorieService::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function entreprises()
    {
        return $this->hasMany(Entreprise::class);
    }

    public function compteurReservations()
    {
        return $this->hasMany(CompteurReservation::class);
    }

    // Scopes
    public function scopeActif($query)
    {
        return $query->where('status', 'actif');
    }

    public function scopeSuspendu($query)
    {
        return $query->where('status', 'suspendu');
    }

    public function scopeEssai($query)
    {
        return $query->where('status', 'essai');
    }

    // Accessors & Mutators
    public function getUrlAttribute()
    {
        if ($this->sous_domaine) {
            return "https://{$this->sous_domaine}.votredomaine.com";
        }
        return route('garage.landing', $this->slug);
    }

    public function getLogoAttribute()
    {
        return $this->logo_url ?? asset('images/default-garage-logo.png');
    }

    // Méthodes utiles
    public function estActif(): bool
    {
        return $this->status === 'actif' &&
               (!$this->date_fin_abonnement || $this->date_fin_abonnement >= now());
    }

    public function estExpire(): bool
    {
        return $this->date_fin_abonnement && $this->date_fin_abonnement < now();
    }

    public function peutCreerReservation(): bool
    {
        if (!$this->limite_reservations_mois) {
            return true; // Illimité
        }

        $compteur = $this->compteurReservations()
            ->whereYear('annee', now()->year)
            ->whereMonth('mois', now()->month)
            ->first();

        if (!$compteur) {
            return true;
        }

        return $compteur->nombre_reservations < $this->limite_reservations_mois;
    }

    public function incrementerCompteurReservations()
    {
        $compteur = CompteurReservation::firstOrCreate(
            [
                'garage_id' => $this->id,
                'annee' => now()->year,
                'mois' => now()->month,
            ],
            ['nombre_reservations' => 0]
        );

        $compteur->increment('nombre_reservations');
    }

    public function suspendre()
    {
        $this->update(['status' => 'suspendu']);
    }

    public function activer()
    {
        $this->update(['status' => 'actif']);
    }

    public function resilier()
    {
        $this->update(['status' => 'resilie']);
    }
}
