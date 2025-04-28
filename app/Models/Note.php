<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    CONST ACTIVATED = "Activer";
    CONST INACTIVATED = "Désactiver";

    protected $fillable = [
        'note',
        'commentaire',
        'user_id',
        'reservation_id',
        'status',
    ];

    public function user()  {
        return $this->belongsTo(User::class);
    }

    public function reservation() {
        return $this->belongsTo(Reservation::class,'reservation_id');
    }
}
