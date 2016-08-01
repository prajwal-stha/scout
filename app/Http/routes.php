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
//Auth::logout();


Route::group( ['middleware' => ['web']], function () {

    Route::auth();
    /*
     * Admin Authentication Routes
     */
    Route::get('/admin/login','AdminAuth\AuthController@showLoginForm');
    Route::post('/admin/login','AdminAuth\AuthController@login');
    Route::get('/admin/logout','AdminAuth\AuthController@logout');

    // Registration Routes...
    Route::get('admin/register', 'AdminAuth\AuthController@showRegistrationForm');
    Route::post('admin/register', 'AdminAuth\AuthController@register');

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

    Route::get('confirm/{token}', function($token){
        $user = App\User::whereToken($token)->firstOrFail();
        $user->verified = 1;
        $user->token = null;
        $user->save();
//        Auth::logout();

        return redirect('/login')->with('verified', 'Thanks for verifying your email-address. Now, you can continue to login');
    });


    Route::get('test', function(){
        return view('scouter/print');
    });

    Route::get('clone/{id}', array(
        'as'    => 'clone',
        'uses'  => 'AdminController@cloneModel'
    ));

    Route::get('unclone/{id}', array(
        'as'    => 'unclone',
        'uses'  => 'AdminController@uncloneModel'
    ));

    Route::controller( '/', 'ScouterController' );

});