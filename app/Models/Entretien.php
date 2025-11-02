<?php

namespace App\Models;

use App\Models\Contrat;
use App\Models\Entreprise;
use App\Models\HistoriqueEntretient;
use Illuminate\Database\Eloquent\Model;

class Entretien extends Model
{

    CONST PENDING = 'PENDING';
    CONST IN_PROGRESS = 'IN_PROGRESS';
    CONST COMPLETED = 'COMPLETED';
    CONST CANCELLED = 'CANCELLED';

    protected $fillable = [
        'contrat_id',
        'entreprise_id',
        'date_prevue',
        'date_realisation',
        'numero_entretien',
        'nombre_vehicules_total',
        'nombre_vehicules_fait',
        'nombre_vehicules_restant',
        'cout_prevu',
        'cout_final',
        'commentaire_cout',
        'status',
        'notes',
        'slug'
    ];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }

    public function entreprise() {
        return $this->belongsTo(Entreprise::class);
    }

    public function historique_entretiens()  {
        return $this->hasMany(HistoriqueEntretient::class);
    }
}
