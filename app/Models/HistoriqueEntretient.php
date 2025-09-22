<?php

namespace App\Models;

use App\Models\Vehicule;
use App\Models\Entreprise;
use App\Models\CategorieService;
use Illuminate\Database\Eloquent\Model;

class HistoriqueEntretient extends Model
{
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
}
