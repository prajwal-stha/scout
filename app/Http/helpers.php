<?php


function is_admin(){
    $user = Auth::user();

    if($user->level == 1)
    {
        return true;
    }
    return false;
}


function flash($message){
    session()->flash('message', $message);
}

// Format the input date to mysql format
function formatDate( $date ){
    $date = explode('/', $date);
    $date = $date[2].'-'.$date[1].'-'.$date[0];
    return date('Y-m-d', strtotime($date));
}
