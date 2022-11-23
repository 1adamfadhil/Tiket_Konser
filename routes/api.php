<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\DataPesananController;
use App\Http\Controllers\KonserController;
use App\Http\Controllers\JadwalKonserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// public route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/books', [BookController::class, 'index']);
Route::post('/books/{id}', [BookController::class, 'show']);
Route::post('/Authors', [AuthController::class, 'index']);
Route::post('/Authors/{id}', [AuthController::class, 'show']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('books',BookController::class)->except('create', 'edit', 'show', 'index');
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::resource('authors',AuthController::class)->except('create', 'edit', 'show', 'index');
    Route::post('isi',[TiketController::class,"store"]);
    Route::get('cetak/{tikets}',[TiketController::class,"show"]);
    Route::get('cetak/',[TiketController::class,"index"]);
    Route::put('/tiket/{tikets}',[TiketController::class,"update"]);
    Route::resource('datapesanan',DataPesananController::class);
    Route::resource('konser',KonserController::class);
    Route::put('/konser/{konsers}',[KonserController::class,"update"]);
    Route::resource('jadwalkonser',JadwalKonserController::class);
    Route::put('/jadwalkonser/{jadwalkonsers}',[JadwalKonserController::class,"update"]);
});