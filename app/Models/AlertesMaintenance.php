<?php

namespace App\Models;

use App\Models\Vehicule;
use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Model;

class AlertesMaintenance extends Model
{
    protected $table = 'alertes_maintenance';

    protected $fillable = [
        'vehicule_id',
        'entreprise_id',
        'type_alerte',
        'priorite',
        'message',
        'date_alerte',
        'status',
        'lue',
    ];


    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }


}
