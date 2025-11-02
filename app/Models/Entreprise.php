<?php

namespace App\Models;

use App\Models\Contrat;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Vehicule;
use App\Models\Reservation;
use App\Models\HistoriqueEntretient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class Entreprise extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    CONST SUSPENDED = "SUSPENDED";
    CONST INACTIVATED = "INACTIVATED";
    CONST ACTIVATED = "ACTIVATED";

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

    protected $casts = [
        'address' => 'array',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
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

    public function reservations()  {
        return $this->hasMany(Reservation::class);
    }

    public function paiement()  {
        return $this->hasMany(Paiement::class);
    }
}
