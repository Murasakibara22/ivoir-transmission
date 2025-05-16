<?php

use App\Models\Role;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('notification', function ($user) {
    // Récupérer l'ID du rôle "Utilisateur"
    $roleUser = Role::where('libelle', 'Utilisateur')->first()->id;

    // Seuls les utilisateurs qui ne sont pas "Utilisateur" sont dans le canal
    return $user->role_id != $roleUser ? ['id' => $user->id, 'name' => $user->name] : null;
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
