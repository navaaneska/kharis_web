<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ComponentController;
use App\Http\Controllers\API\EventCategorieController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\EventPesertaPresensiController;
use App\Http\Controllers\API\MidtransController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     // return $request->user();


// });

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/event_index', [EventController::class, 'index']);
    Route::get('/event-detail/{id}', [EventController::class, 'event_detail']);

    // EventCategories
    Route::get('/event-categories', [EventCategorieController::class, 'index']);


    // Event
    Route::get('/event', [EventController::class, 'EventList']);
    Route::get('/event/online/{online}', [EventController::class, 'EventList']);
    Route::get('/event/kategori/{kategori}', [EventController::class, 'EventList']);
    Route::get('/event/kategori/{kategori}/online/{online}', [EventController::class, 'EventList']);
    Route::get('/event/kategori/{kategori}/status/{status}', [EventController::class, 'EventList']);
    Route::get('/event/group/{group}', [EventController::class, 'EventList']);
    Route::get('/event/content/{content}/take/{take}', [EventController::class, 'EventList']);
    Route::get('/event/streaming/{streaming}/content/{content}', [EventController::class, 'Streaming']);
    Route::get('/event/upcoming/{upcoming}/streaming/{streaming}/content/{content}', [EventController::class, 'Streaming']);
    Route::get('/media/content/{content}', [EventController::class, 'Media']);
    Route::get('/check-event/event/{event}/user/{user}', [EventController::class, 'CheckEvent']);
    Route::post('/daftar-event', [EventController::class, 'DaftarEvent']);
    Route::get('/cart-list/user/{user}', [EventController::class, 'CartList']);
    Route::get('/cart-list-detail/user/{user}/event/{event}', [EventController::class, 'CartListDetail']);
    Route::post('create-peserta-presensi', [EventPesertaPresensiController::class, 'store']);

    Route::post('/check-data-transaksi', [MidtransController::class, 'check_transaksi']);

    // Payment Gateway
    Route::post('/checkout-item', [MidtransController::class, 'create']);
    // Route::post('/token/payment', [MidtransController::class, 'getTokenCreditCard']);

    // Component
    Route::get('/information/kegiatan', [ComponentController::class, 'JumlahKegiatan']);
    Route::get('/information/pelayanan', [ComponentController::class, 'JumlahPelayanan']);
    Route::get('/information/bookmark', [ComponentController::class, 'JumlahBookmark']);
});

Route::post('/midtrans-webhook', [MidtransController::class, 'midtrans_hook']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/checkGoogleLogin', [AuthController::class, 'checkGoogleLogin']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('event_kategori_by_jenis_kategori/{kategori}', [EventController::class, 'event_kategori_by_jenis_kategori']);




// Route::get('/event-detail/{id}', [EventController::class, 'event_detail']);
