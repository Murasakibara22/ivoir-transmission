<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('connexion', function() {
    if(auth()->check())  return redirect('/dashboard');

    return view('auth.login');
})->name('login');


Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'verifyAdmin'], function () {
        Route::prefix('dashboard')->as('dashboard.')->group(function () {
            //tableau de bord de l'admin
            Route::view('home','Dashboard.pages.home')->name('home');

            //Paramètres système
            Route::view('roles-menu','Dashboard.pages.role.index')->name('roles-menu');
            Route::get('roles/show/{slug}', function ($slug) {
                $role = Role::where('slug',$slug)->first();
                if(!$role){
                    return redirect()->back();
                }

                return view('Dashboard.pages.role.show', compact('role'));
             })->name('roles.show')->middleware('verify.right:ROLES,READ ONE');

            Route::view('utilisateurs','Dashboard.pages.user.index')->name('users');
            Route::get('utilisateurs/show/{slug}', function ($slug) {
                $user = User::where('slug',$slug)->first();
                if(!$user){
                    return redirect()->back();
                }

                return view('Dashboard.pages.user.show', compact('user'));
             })->name('users.show');
            Route::view('categories','Dashboard.pages.categorie.index')->name('categorie');
            Route::view('marques','Dashboard.pages.marque.index')->name('marque');
            Route::view('admins','Dashboard.pages.admin.index')->name('admins');
            Route::view('profile','Dashboard.pages.profile.index')->name('profile');
            Route::view('temoignage','Dashboard.pages.temoignage.index')->name('temoignage');
            Route::view('contacts','Dashboard.pages.Contact.index')->name('contacts');
            Route::view('terms','Dashboard.pages.privacy.terms')->name('terms');
            Route::view('paiements','Dashboard.pages.paiement.index')->name('paiements');
            Route::get('paiements/show/{slug}', function ($slug) {
                $paiement = Paiement::where('slug',$slug)->first();
                if(!$paiement){
                    return redirect()->back();
                }

                return view('Dashboard.pages.paiement.show', compact('paiement'));
             })->name('paiements.show');
            Route::view('avis','Dashboard.pages.avis.index')->name('avis');

        });
    });
});
