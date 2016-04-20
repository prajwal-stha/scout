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

//Get the select option

function formatOption( $option )
{
    $data = [];
    if(!empty($option)){
        foreach($option as $value){
            $data[$value->id]   = $value->name;
        }
    }
    return $data;
}


function formatNameOption( $option )
{
    $data = [];
    if(!empty($option)){
        foreach($option as $value){
            $data[$value->f_name . ' ' . $value->m_name . ' '. $value->l_name]   = $value->f_name . ' ' . $value->m_name . ' '. $value->l_name;
        }
    }
    return $data;
}

