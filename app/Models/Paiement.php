<?php

namespace App\Models;

use App\Models\User;
use App\Models\Facture;
use App\Models\Entreprise;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Paiement extends Model
{

    CONST CLIENID = "9e7852c1-6f0f-4544-9a08-b6180c888caf";
    CONST CLIENSECRET =  "br6YoIFLuSxA94gbA3HMZFn6PwC1q9voHMMNs3Yh";

    CONST CANCELED = 'ANNULER';
    CONST PENDING = 'PENDING';
    CONST PAID = 'PAYE';
    CONST SUCCESSFUL = "PAYE";
    CONST FAILED = "FAILED";
    CONST EXPIRED = "EXPIRED";
    CONST INITIATED = "INITIATED";

    CONST ESPECES = "ESPECES";

    protected $fillable = [
        'reservation_id',
        'user_id',
        'entreprise_id',
        'montant',
        'methode',
        'status',
        'reference',
        'snapshot_reservation',
        'snapshot_users',
        'slug',

        'model_id',
        'model_type', // Factures ou Reservation
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


     public function payable(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function entreprise()  {
        return $this->belongsTo(Entreprise::class,'entreprise_id');
    }


    public function scopeForEntreprise($query, $entrepriseId)
    {
        return $query->whereHas('reservation', function ($q) use ($entrepriseId) {
            $q->where('entreprise_id', $entrepriseId);
        })->orWhereHasMorph('payable', [Facture::class], function ($q) use ($entrepriseId) {
            $q->where('entreprise_id', $entrepriseId);
        });
    }

    /**
     * Scope pour les paiements réussis
     */
    public function scopePaid($query)
    {
        return $query->where('status', self::PAID);
    }

    /**
     * Scope pour les paiements en attente
     */
    public function scopePending($query)
    {
        return $query->where('status', self::PENDING);
    }

    /**
     * Vérifie si le paiement est réussi
     */
    public function isPaid(): bool
    {
        return $this->status === self::PAID;
    }

    /**
     * Vérifie si le paiement est en attente
     */
    public function isPending(): bool
    {
        return $this->status === self::PENDING;
    }

}
