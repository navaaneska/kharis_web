<?php

use App\Http\Controllers\EventCategorieController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventMediaController;
use App\Http\Controllers\EventPesertaController;
use App\Http\Controllers\EventPesertaPresensiController;
use App\Http\Controllers\EventQrCodeController;
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

// Route::get('/', function () {
//     // return view('auth.login');
//     return view('index');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



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
    Route::resource('events-peserta', EventPesertaController::class);
    Route::resource('events-qrcode', EventQrCodeController::class);
    Route::get('events-qrcode/create-new/{id}', [EventQrCodeController::class, 'createNew'])->name('events-qrcode.createNew');
    Route::resource('events-peserta-presensi', EventPesertaPresensiController::class);
});
