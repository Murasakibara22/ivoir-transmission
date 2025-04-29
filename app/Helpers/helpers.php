<?php

use App\Models\Menu;
use App\Models\User;
use App\Models\RoleMenu;

if (!function_exists('generateNameCustomer')) {
    function generateNameCustomer() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $username = 'user' . substr(str_shuffle($permitted_chars), 0, 7);
        $exists = User::where(['username' => $username])->first();
        while ($exists) {
            $username = 'user' . substr(str_shuffle($permitted_chars), 0, 7);
            $exists = User::where(['username' => $username])->first();
        }
        return $username;
    }
}


if (!function_exists('generateSlug')) {
    function generateSlug($model, $title) {
        $modelCible = "App\Models"."\\".$model;
        do {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $slug = substr(str_shuffle($permitted_chars), 0, 43);
            $exists = $modelCible::where(['slug' => $slug])->first();
        } while ($exists);
        return $slug;
    }
}

if (!function_exists('generateRef')) {
    function generateRef() {
        $modelCible = "App\Models"."\\"."Commande";
        do {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $reference = substr(str_shuffle($permitted_chars), 0, 33);
            $exists = $modelCible::where(['reference' => $reference])->first();
        } while ($exists);
        return $reference;
    }
}



if (!function_exists('saveMenuForApp')) {
    function saveMenuForApp()  {
        $menus = Menu::each(function ($menu) {
            $menu?->delete();
        });

        $dataLibelleMenu = [
            'RESERVATIONS',
            'PAIEMENTS',
            'CATEGORIE SERVICES',
            'MARQUE & TYPE',
            'SERVICES',
            'SLIDES',
            'ROLES',
            'HISTORIQUES',
            'POLITIQUE DE CONFIDENTIALITÉ',
            'FAQ',
            'FINANCE',
            'ADMINISTRATEURS',
            'AVIS',
            'TEMOIGNAGES',
            'PROFILE ENTREPRISE',
            'A PROPOS',
            'UTILISATEURS',
            'CONTACT',
            'TEAM',
            'PARTENAIRES',
        ];

        foreach($dataLibelleMenu as $menu) {
            if(Menu::where(['libelle' => $menu])->first() == null){
                $menunu = new Menu ;
                $menunu->libelle = $menu;
                $menunu->slug = generateSlug('Menu', $menu);
                $menunu->save();
            }

        }
    }
}


if (!function_exists('checkifRight')) {
    function checkifRight($role_id, $menu_id, $right = 'READ')  {
        $role = RoleMenu::where(['role_id' => $role_id, 'menu_id' => $menu_id])->whereJsonContains('droit', $right)->first();
        return $role ? true : false;
    }
}
