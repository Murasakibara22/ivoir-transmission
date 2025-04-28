<?php

namespace App\Models;

use App\Models\User;
use App\Models\RoleMenu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['libelle', 'description', 'slug'];

    public function users()
    {
        return $this->hasMany(User::class,'role_id');
    }

    public function rolemenus()
    {
        return $this->hasMany(RoleMenu::class,'role_id');
    }
}
