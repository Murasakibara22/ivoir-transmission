<?php

namespace App\Models;

use App\Models\Equipements;
use App\Models\Fournisseurs;
use Illuminate\Database\Eloquent\Model;

class FournisseursEquipements extends Model
{
    protected $fillable = [
            'fournisseur_id',
            'equipement_id',
            'quantity',
            'status',
            'price_unit',
            'price_total',
            'description',
            'delivery_date',
            'quantity_demander',
            'quantity_fourni',
            'slug',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseurs::class);
    }


    public function equipement()
    {
        return $this->belongsTo(Equipements::class);
    }
}
