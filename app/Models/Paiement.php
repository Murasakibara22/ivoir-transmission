<?php

namespace App\Models;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Paiement extends Model
{
    CONST CANCELED = 'ANNULER';
    CONST PENDING = 'en attente';
    CONST PAID = 'PAYE';
    CONST SUCCESSFUL = "PAYE";
    CONST FAILED = "FAILED";
    CONST EXPIRED = "EXPIRED";
    CONST INITIATED = "INITIATED";

    protected $fillable = [
        'reservation_id',
        'user_id',
        'montant',
        'methode',
        'status',
        'reference',
        'snapshot_reservation',
        'snapshot_users',
        'slug',
    ];

    public function reservation()  {
        return $this->belongsTo(Reservation::class);
    }

    public function user()  {
        return $this->belongsTo(User::class);
    }

    public static function generateUniqueReference()
    {
        do {
            $reference = 'REF-' . Str::upper(Str::random(10)).'-'.Str::lower(Str::random(10));
        } while (self::where('reference', $reference)->exists());

        return $reference;
    }
}
