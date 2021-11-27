<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
});
Auth::routes([
    'register' => false,
]);
Route::get('superadmin', 'HomeController@handleAdmin')->name('admin.route')->middleware('is_admin');
Route::prefix('home')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::group(['middleware' => 'auth'], function () {
        Route::resource('category', CategoryController::class);
        Route::resource('news', NewsController::class);
        Route::resource('advertisement', AdvertisementController::class);
        Route::resource('photogallery', PhotoGalleryController::class);
        Route::resource('video', videoController::class);
           
    });
});