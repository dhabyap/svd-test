<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);  

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('users', UserController::class)->except(['store']);
    Route::apiResource('users.hobbies', HobbyController::class);
});