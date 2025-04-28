<?php

namespace App\Models;

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
    ];

    protected $casts = [
        'frais_service' => 'integer',
        'snapshot_categories' => 'array', // pour travailler snapshot directement en array
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
}
