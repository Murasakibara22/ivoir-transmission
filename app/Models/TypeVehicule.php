<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeVehicule extends Model
{
    protected $table = 'type_vehicules';

    protected $fillable = [
        'libelle',
    ];
}
