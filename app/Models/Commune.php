<?php

namespace App\Models;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = [
        'nom',
        'ville_id',
        'jours',
        'frais_service',//NUllable
    ];

    public function Ville()  {
        return $this->belongsTo(Ville::class,'ville_id');
    }
}
