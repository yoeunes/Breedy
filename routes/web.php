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
|
*/

Route::middleware(['web', 'LocaleSwitcher'])->group(function () {
    Route::get('/', 'WelcomeController@show');
    
    Route::get('/v1', 'HomeController@show');
    
    Route::get('home', function () {
        return redirect()->to('/v1#/dashboard');
    });
});

// Routes animals
//Route::group(
//    [
//        'middleware' => ['web', 'auth'],
//        'prefix'     => 'template'
//    ], function () {
//
//});

//Routes for Dashboard
Route::resource('/v1#/dashboard', 'DashboardController');
Route::get('/v1#/dashboard/searchAnimalAdoption', 'DashboardController@searchAnimalAdoption');

// Routes for Animals Adoption
Route::resource('animals/adoptions', 'AnimalAdoptionController');
Route::get('animals/searchMothers', 'AnimalAdoptionController@searchMother');
Route::get('animals/searchFathers', 'AnimalAdoptionController@searchFather');


// Routes for Animals Breeding
Route::resource('animals/breedings', 'AnimalBreedingController');
Route::get('animals/searchMothers', 'AnimalBreedingController@searchMother');
Route::get('animals/searchFathers', 'AnimalBreedingController@searchFather');


// Routes for Types - Team Configuration
Route::get('/settings/team/create-type', 'TypeController@index');
Route::post('/settings/team/create-type', 'TypeController@store');
Route::put('/settings/' . Spark::teamsPrefix() . '/{team}/types/{type}', 'TypeController@update');
Route::delete('/settings/' . Spark::teamsPrefix() . '/{team}/types/{type}', 'TypeController@destroy');
// Routes for Races - Team Configuration
Route::get('/settings/' . Spark::teamsPrefix() . '/races', 'RaceController@index');
Route::post('/settings/' . Spark::teamsPrefix() . '/{team}/races', 'RaceController@store');
Route::put('/settings/' . Spark::teamsPrefix() . '/{team}/races/{race}', 'RaceController@update');
Route::delete('/settings/' . Spark::teamsPrefix() . '/{team}/races/{race}', 'RaceController@destroy');
// Routes for Colors - Team Configuration
Route::get('/settings/' . Spark::teamsPrefix() . '/colors', 'ColorController@index');
Route::post('/settings/' . Spark::teamsPrefix() . '/{team}/colors', 'ColorController@store');
Route::put('/settings/' . Spark::teamsPrefix() . '/{team}/colors/{color}', 'ColorController@update');
Route::delete('/settings/' . Spark::teamsPrefix() . '/{team}/colors/{color}', 'ColorController@destroy');


// Routes for Team Settings
Route::put('/settings/' . Spark::teamsPrefix() . '/{team}/team-profile-details', 'TeamProfileDetailsController@update');

// Routes form Profile Settings
Route::put('/settings/profile/details', 'ProfileDetailsController@update');
Route::put('/settings/user/preferences', 'SettingsPreferencesController@update');
