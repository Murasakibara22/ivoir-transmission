<?php

namespace App\Models;

use App\Models\Entreprise;
use App\Models\HistoriqueEntretient;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable = [
        'libelle',
        'matricule',
        'type',
        'marque',
        'images',
        'chassis',
        'modele',
        'status',
        'year',
        'description',
        'slug',
        'entreprise_id',

        //new champs
        'date_prochaine_visite',
        'cout_vidange_estime',
        'kilometrage_actuel',
        'carburant',
        'couleur',
        'date_mise_circulation'
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function historiquesEntretients()
    {
        return $this->hasMany(HistoriqueEntretient::class);
    }
}
