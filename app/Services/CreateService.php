<?php

namespace App\Services;

use App\Models\Role;
use App\Models\RoleMenu;

class CreateService {

    public function createRole($data){
        $role = Role::create([
            'libelle' => $data['libelle'],
            'description' => $data['description'] ?? null,
            'slug' => generateSlug('Role', $data['libelle']),
        ]);

        return $role->id;
    }

    public function createRoleMenu($data_menu, $role_id){
        try{
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

    public function addRightToRoleMenu($role_id, $menu_id, $droit)  {
        $rolemenu_exist = RoleMenu::where('role_id', $role_id)->where('menu_id', $menu_id)->first();
        if($rolemenu_exist){
            $droits = json_decode($rolemenu_exist->droit);
            $droits = array_merge($droits, $droit);
            $droit = array_unique($droits);

            $rolemenu_exist->update([
                'droit' => json_encode($droit),
            ]);

            return true;
        }else{
            return false;
        }
    }

   
}
