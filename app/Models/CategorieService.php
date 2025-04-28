<?php

namespace App\Models;

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
}
