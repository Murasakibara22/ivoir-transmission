<?php

namespace App\Models;

use App\Models\Contrat;
use App\Models\Vehicule;
use App\Models\Entretien;
use App\Models\Entreprise;
use App\Models\Reservation;
use App\Models\CategorieService;
use Illuminate\Database\Eloquent\Model;

class HistoriqueEntretient extends Model
{
    CONST PENDING = 'PENDING';
    CONST IN_PROGRESS = 'IN_PROGRESS';
    CONST DONE = 'DONE';
    CONST CANCELLED = 'CANCELLED';



    protected $fillable = [
            'vehicule_id',
            'entreprise_id',
            'type_entretient',
            'date_entretient',
            'description',
            'start_at',
            'end_at',
            'status',
            'slug',
            'categorie_services_id',
            'libelle_service',
            'montant',
            'outils',

            //new champs
            'reservation_id',
            'kilometrage_intervention',
            'prochain_entretien_km',
            'prochain_entretien_date',
            'facture_pdf',
            'entretien_id',
            'contrat_id',


            'pieces_changees',
            'services_effectues',
            'cout_pieces',
            'cout_main_oeuvre',
            'facture_pdf'

    ];


    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function categorieService()
    {
        return $this->belongsTo(CategorieService::class, 'categorie_services_id');
    }


    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function entretien()
    {
        return $this->belongsTo(Entretien::class);
    }

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
}
