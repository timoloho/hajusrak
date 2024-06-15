<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DiscController;
use App\Http\Controllers\GoogleMarkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/google-maps/markers', [GoogleMarkerController::class, 'index']);
Route::post('/google-maps/markers', [GoogleMarkerController::class, 'store']);
Route::put('/google-maps/markers/{id}', [GoogleMarkerController::class, 'update']);
Route::delete('/google-maps/markers/{id}', [GoogleMarkerController::class, 'destroy']);

Route::get('/disc', [DiscController::class, 'index']);
Route::post('/disc', [DiscController::class, 'store']);
Route::put('/disc/{disc}', [DiscController::class, 'update']);
Route::get('/disc/{disc}', [DiscController::class, 'show']);
Route::delete('/disc/{disc}', [DiscController::class, 'destroy']);

Route::get('api/class', [ApiController::class, 'index']);