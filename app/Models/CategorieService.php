<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategorieService extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
        'frais_service',
        'logo',
        'slug',
    ];

    protected $casts = [
        'frais_service' => 'integer',
    ];

    public function services()  {
        return $this->hasMany(Service::class, 'categorie_service_id');
    }
}
