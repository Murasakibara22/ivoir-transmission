<?php

namespace App\Models;

use App\Models\Paiement;
use App\Models\Vehicule;
use App\Models\Entreprise;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
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


}
