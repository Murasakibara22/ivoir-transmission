<?php

namespace App\Models;

use App\Models\Contrat;
use App\Models\Paiement;
use App\Models\Vehicule;
use App\Models\Entreprise;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{


    CONST PENDING = 'PENDING';
    CONST PAID = 'PAID';
    CONST OVERDUE = 'OVERDUE';
    CONST CANCELLED = 'CANCELLED';
    CONST FAILED = 'FAILED';


    CONST VIREMENT = 'VIREMENT';
    CONST CHEQUE = 'CHEQUE';
    CONST ESPECES = 'ESPECES';
    CONST CARTE = 'CARTE';
    CONST MOBILE_MONEY = 'MOBILE_MONEY';

    protected $fillable = [
            'ref',
            'libelle',
            'type',
            'description',
            'status',
            'email_customer',
            'contact_customer',
            'name_customer',
            'montant',
            'entreprise_id',
            'fournisseur_id',
            'date',

            //new champs
            'vehicule_id',
            'reservation_id',
            'fichier_pdf',
            'date_echeance',
            'tva',
            'montant_ttc',


            'entretien_id',
            'contrat_id',
            'date_emission',
            'status_paiement',
            'moyen_paiement',
            'reference_paiement',
    ];


    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function entretien(){
        return $this->belongsTo(Entretien::class);
    }

    public function contrat(){
        return $this->belongsTo(Contrat::class);
    }

    public function paiements() {
        return Paiement::where([
            ['model_id', $this->id],
             ['model_type', get_class($this)]
             ]);
    }

}
