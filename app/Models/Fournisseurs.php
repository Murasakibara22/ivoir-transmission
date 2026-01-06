<?php

namespace App\Models;

use App\Models\Facture;
use App\Models\FournisseursEquipements;
use Illuminate\Database\Eloquent\Model;

class Fournisseurs extends Model
{

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'slug',
        'status',
    ];


    public function fournisseursEquipements()
    {
        return $this->hasMany(FournisseursEquipements::class);
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

}
