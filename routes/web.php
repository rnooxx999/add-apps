<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
// use App\Models\Apps;

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

Route::get('/', function () {
    return view('welcome');
});




 //game
 Route::get('app', [AppsController::class, 'index'])->name('apps');
 Route::get('new-app', [AppsController::class, 'index'])->name('new-app');
 Route::post('new-app', [AppsController::class, 'app']);


//Route::get('appp','AppsController@index')->name('appp');
//Route::get('game','GameController@index')->name('game');
//Route::post('game/store','AppsController::class')->name('game-store');
//Route::get('slides', [SlidesController::class, 'index'])->name('slides');

Route::get('update-app/{id}' ,[AppsController::class, 'index'])->name('app-game-form');
Route::put('update-game' , [AppsController::class, 'update'])->name('app-update');

//Route::post('/store',['App\Http\Controllers\AppsController', 'store'])->name('app-store');
Route::post('/store','AppsController@store')->name('app-store');

//place
//Route::get('places' , 'PlaceController@index')->name('places');
Route::get('country', [CountryController::class, 'index'])->name('country');
Route::post('country', [CountryController::class, 'store']);
Route::delete('country', [CountryController::class, 'delete']);
Route::put('country', [CountryController::class, 'update']);
Route::get('search-country', [CountryController::class, 'search'])->name('search-country');



//category
// Route::get('categories' , 'CategoryController@index')->name('categories');
// Route::post('categories' , 'CategoryController@store');
// Route::delete('categories' , 'CategoryController@delete');
// Route::put('categories' , 'CategoryController@update');
// Route::get('search-categories' , 'CategoryController@search')->name('search-categories');

Route::get('categories', [CategoryController::class, 'index'])->name('categories');
Route::post('categories', [CategoryController::class, 'store']);
Route::delete('categories', [CategoryController::class, 'delete']);
Route::put('categories', [CategoryController::class, 'update']);
Route::get('search-categories', [CategoryController::class, 'search'])->name('search-categories');


