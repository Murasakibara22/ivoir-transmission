<?php

namespace App\Models;

use App\Models\Contrat;
use App\Models\Facture;
use App\Models\Vehicule;
use App\Models\HistoriqueEntretient;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'slug',
        'password',
        'type',
        'status',
        'cgu',
    ];


    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }


    public function historiquesEntretients()
    {
        return $this->hasManyThrough(HistoriqueEntretient::class, Vehicule::class);
    }

    public function contrats()
    {
        return $this->hasMany(Contrat::class);
    }

    public function factures() {
        return $this->hasMany(Facture::class);
    }
}
