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

//    Route::get('districts', 'DistrictsController@index')->name('districts/create');
//
//    Route::get('districts/update/{districts}', 'DistrictsController@editDistricts');
//
//    Route::post('districts', 'DistrictsController@createDistricts');
//
//    Route::delete('districts/delete', 'DistrictsController@deleteManyDistricts')->name('districts/delete');
//
//    Route::delete('districts/remove/{districts}', 'DistrictsController@deleteDistricts');
//
//    Route::get('rate', [
//        'as'    => 'rate', 'uses'   => 'RateController@showRates'
//    ]);
//
//    Route::post('rate', [
//        'as'    => 'rate', 'uses'   => 'RateController@createRate'
//
//    ]);
//
//    Route::patch('rate/{rate}',[
//        'as'    => 'rate', 'uses'   => 'RateController@editRate'
//    ]);




    Route::controller( 'districts', 'DistrictsController');
    Route::controller( 'organizations', 'OrganizationsController');
    Route::controller( 'rate', 'RateController');
    Route::controller( 'teams', 'TeamsController');
    Route::controller( 'scouter', 'ScouterController' );
    Route::controller( '/', 'AdminController' );

});