<?php

namespace App\Policies;

use App\Models\Publication;
use App\Models\User;

class PublicationPolicy
{
    // Consulter les publications
    public function viewAny(User $user): bool
    {
        return true;
    }

    // Consulter une publication
    public function view(User $user, Publication $publication): bool
    {
        return true;
    }

    // Créer une publication
    public function create(User $user): bool
    {
        return true;
    }

    // Modifier une publication
    public function update(User $user, Publication $publication): bool
    {
        return $user->id === $publication->user_id
            || $user->role === 'admin';
    }

    // Supprimer une publication
    public function delete(User $user, Publication $publication): bool
    {
        return $user->id === $publication->user_id
            || $user->role === 'admin';
    }
}