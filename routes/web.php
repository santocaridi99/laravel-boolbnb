<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Rotta con middleware  Host
Route::middleware('auth')
    ->namespace('Host')->prefix('host')->name('host.')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        
        // rotta v/appartamenti cestinati
        Route::get("apartments/deletedApartments", "ApartmentController@deletedApartments")->name('apartments.deletedApartments');
        // soft delete degli appartamenti
        Route::delete("apartments/{apartment}/softDeleteApartment", "ApartmentController@softDeleteApartment")->name('apartments.softDeleteApartment');
        // restore degli appartamenti cancellati
        Route::get("apartments/{apartment}/restoreApartment", "ApartmentController@restoreApartment")->name("apartments.restoreApartment");

        // !! LASCIARE INFONDO A TUTTE LE ALTRE ROTTE !!
        // resource prende tutte le pagine relative alla crud Apartment
        Route::resource('apartments', 'ApartmentController');

    });

Route::get("{any?}", function () {
    return view("index");
})->where("any", ".*");
