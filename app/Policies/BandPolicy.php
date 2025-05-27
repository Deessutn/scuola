<?php

namespace App\Policies;

use App\Models\Band;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BandPolicy
{
    use HandlesAuthorization;

       public function view(User $user, Band $band): bool
    {
        // Owner or member can view:
        return $user->id === $band->owner_id
            || $band->users()->where('user_id', $user->id)->exists();
    }

  
    public function create(User $user): bool
    {
      
        return true;
    }

  
    public function update(User $user, Band $band): bool
    {
        // Only owner can update:
        return $user->id === $band->owner_id;
    }

 
    public function delete(User $user, Band $band): bool
    {
        // Only owner can delete:
        return $user->id === $band->owner_id;
    }

   
}
