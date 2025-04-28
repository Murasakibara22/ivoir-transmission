<?php
namespace App\Services;

use App\Models\Role;
use App\Models\RoleMenu;

class DeleteService {
    public function deleteRole($id){
        try{
            RoleMenu::where('role_id',$id)->delete();
            return Role::where('id',$id)->update([
                'deleted' => 1
            ]);

            return true;
        }catch(\Exception $e){
            return false;
        }
    }

    public function distachRightToRoleMenu($role_id, $menu_id, $droit)  {
        $rolemenu_exist = RoleMenu::where('role_id', $role_id)->where('menu_id', $menu_id)->first();
        if($rolemenu_exist){
            $droits = json_decode($rolemenu_exist->droit);
            $droits = array_diff($droits, $droit);
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
