<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleMenu;
use Illuminate\Contracts\Database\Eloquent\Builder;


class GetDataService
{

    //Rôles
    public function getAllRole() : Builder {
        return Role::where('deleted',0);
    }

    public function getOneRole($id) : Role{
        return Role::where('id',$id)->first();
    }

    public function getRoleMenuid($role_id)  {
        return RoleMenu::where('role_id',$role_id)->pluck('menu_id')->toArray();
    }

    public function getMenuRole($role_id)  {
        return Menu::whereIn('id', $this->getRoleMenuid($role_id))->get();
    }

    public function getAllAdminByRole($role_id) : Builder {
        return User::where('role_id', $role_id);
    }
}
