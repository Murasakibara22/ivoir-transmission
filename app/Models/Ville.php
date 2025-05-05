<?php

namespace App\Models;

use App\Models\Commune;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function Commune()  {
        return $this->hasMany(Commune::class);
    }
}
