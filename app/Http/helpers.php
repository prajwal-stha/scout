<?php


function is_admin(){
    $user = Auth::user();

    if($user->level == 1)
    {
        return true;
    }
    return false;
}
