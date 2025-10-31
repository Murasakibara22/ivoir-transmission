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

        //new champs
        'date_debut',
        'date_fin',
        'nombre_vehicules',
        'montant_total',
        'frequence_paiement',
        'fichier_contrat_pdf',
        'slug'
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
