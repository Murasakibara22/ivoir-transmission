<?php

namespace App\Models;

use App\Models\RoleMenu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['libelle','description', 'slug'];

    public function rolemenus() {
        return $this->hasMany(RoleMenu::class,'menu_id');
    }
}
