<?php

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

// Route::get('/about', function () {
//     return view('pages.about');
// });
//
// Route::get('/ram', function () {
//     return '<h1>Welcome ram</h1>';
// });
//
// Route::get('/users/{id}/{name}', function ($id, $name) {
//     return 'This is user '.$name.' with id '.$id;
// });

Route::get('/', 'ImagesController@index');
// Route::get('/about', 'PagesController@about');
// Route::get('/services', 'PagesController@services');

Route::resource('/images', 'ImagesController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
