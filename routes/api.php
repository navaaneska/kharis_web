<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventCategorieController;
use App\Http\Controllers\API\EventController;
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
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/event', [EventController::class, 'index']);
    Route::get('/event-detail/{id}', [EventController::class, 'event_detail']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/event-categories', [EventCategorieController::class, 'index']);
