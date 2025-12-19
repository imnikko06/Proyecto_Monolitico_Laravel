<?php

namespace App\Policies;

use App\Models\Petition;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PetitionPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->role_id == 2) {
            return true;
        }
        return null;
    }

    public function update(User $user, Petition $petition): bool
    {
        return $petition->user_id === $user->id;
    }

    public function delete(User $user, Petition $petition): bool
    {
        return $petition->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function view(User $user, Petition $petition): bool
    {
        return true;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

}
