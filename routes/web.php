<?php

use App\Http\Controllers\EventCategorieController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventMediaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/index', [EventController::class, 'index']);

// Route::get('/contoh', [EventController::class, 'index']);

Auth::routes([
    'register' => false
]);

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('events', EventController::class);
    Route::get('events-media/create-new/{id}', [EventMediaController::class, 'createNew'])->name('events-media.createNew');
    Route::resource('events-media', EventMediaController::class);
    Route::resource('events-categorie', EventCategorieController::class);
});
