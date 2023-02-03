<?php

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

Route::middleware('auth')
->namespace('Admin')
->prefix('admin')   //localhost:8000/admin/
->name('admin.')
->group(function(){
	Route::get('/','HomeController@index')->name('index');
    Route::resource('/posts', PostController::class);

});

Route::get('{any?}', function(){
	Return view('guest.home');
})->where("any",".*");


// Route::get('/home', 'HomeController@index')->name('home');
