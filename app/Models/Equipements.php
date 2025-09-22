<?php

namespace App\Models;

use App\Models\FournisseursEquipements;
use Illuminate\Database\Eloquent\Model;

class Equipements extends Model
{
    protected $fillable = [
        'libelle',
        'description',
        'quantity',
        'status',
    ];

    public function fournisseursEquipements()
    {
        return $this->hasMany(FournisseursEquipements::class);
    }
}
