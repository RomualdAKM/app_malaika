<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/app', [AppController::class, 'index']);
Route::get('/faqs', [AppController::class, 'faqs']);
Route::post('/structure', [AppController::class, 'search']);
Route::get('/room-detail/{id}', [AppController::class, 'roomDetail']);
Route::post('/reservation-store', [AppController::class, 'storeReservation']);
Route::get('/get_structure_room/{idRoom}', [AppController::class, 'getStructureRoom']);
