<?php

namespace App\Services;

use App\Models\Role;
use App\Models\RoleMenu;

class UpdateService {

    public function updateRole($data, $id){
        return Role::where('id',$id)->update([
            'libelle' => $data['libelle'],
            'description' => $data['description'] ?? null,
            'slug' => generateSlug('Role', $data['libelle']),
        ]);
    }

    public function updateRoleMenu($data_menu, $role_id){
        try{
            RoleMenu::where('role_id', $role_id)->delete();
            foreach ($data_menu as $key => $value) {
                RoleMenu::create([
                    'role_id' => $role_id,
                    'menu_id' => $value,
                    'droit' => json_encode(['READ']),
                    'slug' => generateSlug('RoleMenu', $value),
                ]);
            }

            return true;
        }catch(\Exception $e){
            return false;
        }
    }
}
