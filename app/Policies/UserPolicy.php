<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;

class UserPolicy
{
    use HandlesAuthorization;


    public function login(User $user)
    {
//        return $user->verified == 1;
        
   }
}
