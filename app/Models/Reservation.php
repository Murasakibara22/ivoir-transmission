<?php

namespace App\Models;

use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'montant',
        'status',
        'status_paiement',
        'description',
        'adresse_name',
        'location',
        'date_debut',
        'images',
        'start_at',
        'date_fin',
        'user_id',
        'service_id',
        'snapshot_services',
        'snapshot_users',
        'snapshot_vehicule',
        'slug',
        'name_prestataire',
    ];

    protected $casts = [
        'montant' => 'integer',
        'location' => 'array',
        'snapshot_services' => 'array',
        'snapshot_users' => 'array',
        'snapshot_vehicule' => 'array',
        'date_debut' => 'datetime',
        'start_at' => 'datetime',
        'date_fin' => 'datetime',
    ];

    // ================================
    // Boot pour formater les snapshots avant save
    // ================================
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($reservation) {
            $reservation->formatSnapshots();
        });
    }

    // ================================
    // Génération automatique des snapshots
    // ================================
    public function formatSnapshots()
    {
        // Snapshot du Service
        if ($this->service_id) {
            $service = Service::find($this->service_id);

            if ($service) {
                $this->snapshot_services = [
                    'id' => $service->id,
                    'libelle' => $service->libelle,
                    'slug' => $service->slug,
                    'frais_service' => $service->frais_service,
                ];
            }
        }

        // Snapshot de l'Utilisateur
        if ($this->user_id) {
            $user = User::find($this->user_id);

            if ($user) {
                $this->snapshot_users = [
                    'id' => $user->id,
                    'nom' => $user->nom,
                    'prenom' => $user->prenom,
                    'username' => $user->username,
                    'phone' => $user->phone,
                    'email' => $user->email,
                ];
            }
        }

    }

    // ================================
    // Relations
    // ================================
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
