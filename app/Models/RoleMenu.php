<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class RoleMenu extends Model
{
    use HasFactory;

    protected $fillable = ['role_id', 'menu_id', 'droit', 'slug'];

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }
}
