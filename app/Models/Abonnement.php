<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'garage_id',
        'plan_id',
        'periode',
        'montant',
        'date_debut',
        'date_fin',
        'statut',
        'auto_renew',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'auto_renew' => 'boolean',
    ];

    // Relations
    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    // Scopes
    public function scopeActif($query)
    {
        return $query->where('statut', 'actif');
    }

    public function scopeExpire($query)
    {
        return $query->where('statut', 'expire');
    }

    public function scopeAVenir($query)
    {
        return $query->where('date_debut', '>', now());
    }

    public function scopeEnCours($query)
    {
        return $query->where('date_debut', '<=', now())
                     ->where('date_fin', '>=', now())
                     ->where('statut', 'actif');
    }

    // Méthodes
    public function estActif(): bool
    {
        return $this->statut === 'actif' &&
               $this->date_debut <= now() &&
               $this->date_fin >= now();
    }

    public function estExpire(): bool
    {
        return $this->date_fin < now();
    }

    public function joursRestants(): int
    {
        if ($this->estExpire()) {
            return 0;
        }

        return now()->diffInDays($this->date_fin, false);
    }

    public function expirer()
    {
        $this->update(['statut' => 'expire']);
        $this->garage->suspendre();
    }

    public function annuler()
    {
        $this->update([
            'statut' => 'annule',
            'auto_renew' => false,
        ]);
    }

    public function renouveler()
    {
        $nouvelleDate = $this->periode === 'mensuel'
            ? $this->date_fin->addMonth()
            : $this->date_fin->addYear();

        return self::create([
            'garage_id' => $this->garage_id,
            'plan_id' => $this->plan_id,
            'periode' => $this->periode,
            'montant' => $this->montant,
            'date_debut' => $this->date_fin->addDay(),
            'date_fin' => $nouvelleDate,
            'statut' => 'actif',
            'auto_renew' => $this->auto_renew,
        ]);
    }
}
