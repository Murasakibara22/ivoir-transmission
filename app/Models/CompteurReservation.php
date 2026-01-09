<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteurReservation extends Model
{
    use HasFactory;

    protected $table = 'compteur_reservations';

    protected $fillable = [
        'garage_id',
        'annee',
        'mois',
        'nombre_reservations',
    ];

    protected $casts = [
        'annee' => 'integer',
        'mois' => 'integer',
        'nombre_reservations' => 'integer',
    ];

    // Relations
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    // Scopes
    public function scopeMoisEnCours($query)
    {
        return $query->where('annee', now()->year)
                     ->where('mois', now()->month);
    }

    public function scopeAnneeEnCours($query)
    {
        return $query->where('annee', now()->year);
    }

    // Méthodes statiques
    public static function incrementerPourGarage($garageId)
    {
        $compteur = self::firstOrCreate(
            [
                'garage_id' => $garageId,
                'annee' => now()->year,
                'mois' => now()->month,
            ],
            ['nombre_reservations' => 0]
        );

        $compteur->increment('nombre_reservations');

        return $compteur;
    }

    public static function obtenirCompteurGarage($garageId)
    {
        return self::where('garage_id', $garageId)
            ->where('annee', now()->year)
            ->where('mois', now()->month)
            ->first();
    }

    // Méthodes
    public function limiteAtteinte(): bool
    {
        $limite = $this->garage->limite_reservations_mois;

        if (!$limite) {
            return false; // Illimité
        }

        return $this->nombre_reservations >= $limite;
    }

    public function reservationsRestantes(): int
    {
        $limite = $this->garage->limite_reservations_mois;

        if (!$limite) {
            return PHP_INT_MAX; // Illimité
        }

        return max(0, $limite - $this->nombre_reservations);
    }

    public function pourcentageUtilisation(): int
    {
        $limite = $this->garage->limite_reservations_mois;

        if (!$limite) {
            return 0;
        }

        return round(($this->nombre_reservations / $limite) * 100);
    }
}
