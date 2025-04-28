<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    CONST ACTIVATED = "ACTIVATED";
    CONST DEACTIVATED = "DEACTIVATED";

    protected $fillable = [
        'username',
        'note',
        'description',
        'status',
    ];
}
