<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    protected $table = 'marques';

    protected $fillable = [
        'libelle',
    ];
}
