<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Note;
use App\Models\Role;
use App\Models\Paiement;
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

}
