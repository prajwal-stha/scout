<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Auth::loginUsingId(1);

Route::group( ['middleware' => ['web']], function () {

    Route::auth();
    Route::controller( 'districts', 'DistrictsController', [
        'getAllDistricts'  => 'all-districts',
    ]);
    Route::controller( 'organizations', 'OrganizationsController');
    Route::controller( 'rate', 'RateController');
    Route::controller( 'team', 'TeamsController');
    Route::controller( 'admin', 'AdminController' );
    Route::controller( 'scouter', 'ScouterController' );
    Route::controller( 'member', 'TeamMemberController' );
    Route::controller( 'term', 'TermController' );



    Route::get('/confirm/{token?}', function($token){
        $user = App\User::whereToken($token)->firstOrFail();
        $user->verified = 1;
        $user->token = null;
        $user->save();
        return redirect('/login')->with('verified', 'Thanks for verifying your email-address. Now, you can continue to login');
    });

    Route::get('test', function(){
        return view('scouter/print');
    });

    Route::get('clone/{id}', array(
        'as'    => 'clone',
        'uses'  => 'AdminController@cloneModel'
    ));


    Route::controller( '/', 'ScouterController' );

});