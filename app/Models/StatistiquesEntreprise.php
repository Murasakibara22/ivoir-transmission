<?php

namespace App\Models;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;

class StatistiquesEntreprise extends Model
{
    protected $table = 'statistiques_entreprises';

    protected $fillable = [
        'entreprise_id',
        'mois',
        'annee',
        'nombre_interventions',
        'cout_total',
        'nombre_vehicules_actifs',
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }


}
