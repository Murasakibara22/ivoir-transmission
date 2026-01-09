<?php

namespace App\Models;

use App\Models\Reservation;
use App\Models\CategorieService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'frais_service',
        'slug',
        'categorie_service_id',
        'snapshot_categories',
        'obligatoire',
        'actif',
    ];

    protected $casts = [
        'frais_service' => 'integer',
        'snapshot_categories' => 'array', // pour travailler snapshot directement en array
        'obligatoire' => 'boolean',
    ];

    // ================================
    // Boot pour formater snapshot avant save
    // ================================
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($service) {
            $service->formatSnapshotCategories();
        });
    }

    // ================================
    // Fonction pour générer snapshot
    // ================================
    public function formatSnapshotCategories()
    {
        if ($this->categorie_service_id) {
            $categorie = CategorieService::find($this->categorie_service_id);

            if ($categorie) {
                $this->snapshot_categories = [
                    'id' => $categorie->id,
                    'libelle' => $categorie->libelle,
                    'slug' => $categorie->slug,
                ];
            }
        }
    }

    // ================================
    // Relation avec CategorieService
    // ================================
    public function categorieService()
    {
        return $this->belongsTo(CategorieService::class, 'categorie_service_id');
    }

    public function scopeObligatoire($query)
    {
        return $query->where('obligatoire', true);
    }

    public function getTypeBadgeAttribute(): ?array
    {
        if ($this->obligatoire) {
            return [
                'label' => 'Obligatoire',
                'color' => 'red',
                'icon' => '⚠️'
            ];
        }

        return null;
    }


    public function getIcone(): string
    {
        return match(true) {
            str_contains(strtolower($this->libelle), 'huile') => '🛢️',
            str_contains(strtolower($this->libelle), 'filtre') => '🔍',
            str_contains(strtolower($this->libelle), 'joint') => '⚙️',
            str_contains(strtolower($this->libelle), 'batterie') => '🔋',
            str_contains(strtolower($this->libelle), 'pneu') => '🚗',
            str_contains(strtolower($this->libelle), 'frein') => '🛑',
            default => '🔧'
        };
    }

    /**
     * Nombre de fois utilisé
     */
    public function nombreUtilisations(): int
    {
        // Compter dans les réservations où ce service est dans le JSON 'outils'
        return Reservation::whereJsonContains('outils', ['id' => $this->id])->count();
    }
}
