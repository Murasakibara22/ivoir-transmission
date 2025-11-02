<?php

namespace App\Models;

use App\Models\Entretien;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    CONST DRAFT = 'DRAFT';
    CONST PENDING = 'PENDING';
    CONST ACTIVATED = 'ACTIVE';
    CONST INACTIVATED = 'INACTIVATED';
    CONST EXPIRED = 'EXPIRED';
    CONST CANCELED = 'CANCELED';

    CONST FREQUENCE_MENSUEL = 'MENSUEL';
    CONST FREQUENCE_TRIMESTRIEL = 'TRIMESTRIEL';
    CONST FREQUENCE_SEMESTRIEL = 'SEMESTRIEL';
    CONST FREQUENCE_ANNUEL = 'ANNUEL';


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
        'slug',


        'frequence_entretien',
        'duree_contrat_mois',
        'date_premier_entretien',
        'montant_entretien',
        'entreprise_validated_at',
        'garage_validated_at',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function entretiens(){
        return $this->hasMany(Entretien::class);
    }
}
