<?php

namespace App\Models;

use App\Models\Entreprise;
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
    ];


    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
