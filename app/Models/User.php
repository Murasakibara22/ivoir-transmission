<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Note;
use App\Models\Role;
use App\Models\Paiement;
use App\Models\Vehicule;
use App\Models\Reservation;
use App\Models\NotificationAdmin;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'username',
        'phone',
        'dial_code',
        'phone_number',
        'email',
        'gender',
        'password',
        'photo_url',
        'slug',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function reservation()  {
        return $this->hasMany(Reservation::class);
    }

    public function role()  {
        return $this->belongsTo(Role::class);
    }

    public function note() {
        return $this->hasMany(Note::class);
    }

    public function paiements() {
        return $this->hasMany(Paiement::class);
    }

    public function NotificationAdmin()  {
        return $this->hasMany(NotificationAdmin::class);
    }

    /**
     * Véhicules du client
     */
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }

    // ================================
    // ACCESSORS POUR LA PWA
    // ================================

    /**
     * Nom complet de l'utilisateur
     */
    public function getNomCompletAttribute(): string
    {
        return trim("{$this->prenom} {$this->nom}");
    }

    /**
     * Initiales pour avatar
     */
    public function getInitialesAttribute(): string
    {
        $prenom = substr($this->prenom ?? '', 0, 1);
        $nom = substr($this->nom ?? '', 0, 1);
        return strtoupper($prenom . $nom);
    }

    /**
     * Photo ou avatar par défaut
     */
    public function getAvatarAttribute(): string
    {
        return $this->photo_url ?? "https://ui-avatars.com/api/?name={$this->initiales}&background=3B82F6&color=fff";
    }

    /**
     * Téléphone formaté
     */
    public function getTelephoneFormatAttribute(): string
    {
        return $this->dial_code ? "{$this->dial_code} {$this->phone_number}" : $this->phone;
    }


    public function reservationsAvenir()
    {
        return $this->reservation()
            ->where('date_debut', '>', now())
            ->whereIn('status', [Reservation::PENDING, Reservation::VALIDATE])
            ->orderBy('date_debut', 'asc');
    }

    /**
     * Prochaine réservation
     */
    public function prochaineReservation()
    {
        return $this->reservationsAvenir()->first();
    }

    /**
     * Réservations passées
     */
    public function reservationsPassees()
    {
        return $this->reservation()
            ->where('date_debut', '<', now())
            ->orWhere('status', Reservation::COMPLETED)
            ->orderBy('date_debut', 'desc');
    }

    /**
     * Réservation en cours
     */
    public function reservationEnCours()
    {
        return $this->reservation()
            ->where('status', Reservation::STARTED)
            ->first();
    }

    /**
     * Total dépensé cette année
     */
    public function totalDepenseAnnee(): int
    {
        return $this->paiements()
            ->where('status', Paiement::PAID)
            ->whereYear('created_at', now()->year)
            ->sum('montant');
    }

    /**
     * Nombre de réservations totales
     */
    public function nombreReservationsTotal(): int
    {
        return $this->reservation()->count();
    }

    /**
     * Statistiques pour le dashboard
     */
    public function statistiquesDashboard(): array
    {
        return [
            'total_reservations' => $this->nombreReservationsTotal(),
            'depense_annee' => $this->totalDepenseAnnee(),
            'reservations_en_cours' => $this->reservation()
                ->whereIn('status', [Reservation::VALIDATE, Reservation::STARTED])
                ->count(),
            'prochaine_reservation' => $this->prochaineReservation(),
        ];
    }
}
