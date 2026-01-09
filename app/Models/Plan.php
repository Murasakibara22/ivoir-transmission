<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'prix_mensuel',
        'prix_annuel',
        'limite_reservations',
        'limite_admins',
        'white_label',
        'module_entreprise',
        'api_access',
        'support_prioritaire',
        'actif',
        'ordre',
    ];

    protected $casts = [
        'prix_mensuel' => 'decimal:2',
        'prix_annuel' => 'decimal:2',
        'white_label' => 'boolean',
        'module_entreprise' => 'boolean',
        'api_access' => 'boolean',
        'support_prioritaire' => 'boolean',
        'actif' => 'boolean',
    ];

    // Relations
    public function garages()
    {
        return $this->hasMany(Garage::class);
    }

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class);
    }

    // Scopes
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    public function scopeOrdonne($query)
    {
        return $query->orderBy('ordre');
    }

    // Accessors
    public function getEstGratuitAttribute(): bool
    {
        return $this->prix_mensuel == 0;
    }

    public function getEconomieAnnuelleAttribute()
    {
        $prixMensuelAnnualise = $this->prix_mensuel * 12;
        return $prixMensuelAnnualise - $this->prix_annuel;
    }

    public function getPourcentageEconomieAttribute()
    {
        if ($this->prix_mensuel == 0) {
            return 0;
        }

        $prixMensuelAnnualise = $this->prix_mensuel * 12;
        return round((($prixMensuelAnnualise - $this->prix_annuel) / $prixMensuelAnnualise) * 100);
    }

    // Méthodes
    public function estIllimite(): bool
    {
        return is_null($this->limite_reservations) && is_null($this->limite_admins);
    }

    public function getCaracteristiques(): array
    {
        return [
            'Réservations' => $this->limite_reservations ? "{$this->limite_reservations}/mois" : 'Illimitées',
            'Administrateurs' => $this->limite_admins ?? 'Illimités',
            'White-label' => $this->white_label ? 'Oui' : 'Non',
            'Module entreprise' => $this->module_entreprise ? 'Oui' : 'Non',
            'Accès API' => $this->api_access ? 'Oui' : 'Non',
            'Support prioritaire' => $this->support_prioritaire ? 'Oui' : 'Non',
        ];
    }
}
