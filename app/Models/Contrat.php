<?php

namespace App\Models;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    protected $fillable = [
        'libelle',
        'type',
        'description',
        'status',
        'entreprise_id',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
