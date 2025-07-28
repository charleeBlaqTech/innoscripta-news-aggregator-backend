<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\UserPreferenceController;
use App\Http\Controllers\UserController;


// ===========USER REGISTRATION & AUTHENTICATION==========================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes that require authentication through Sanctum=====protected on the frontend as well=====
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/preferences', [UserPreferenceController::class, 'show']);
    Route::post('/preferences', [UserPreferenceController::class, 'store']);
    Route::get('/preferences/options', [UserPreferenceController::class, 'options']);

    Route::get('/feed', [FeedController::class, 'index']);
    Route::get('/feed/{id}', [FeedController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/articles', [ArticleController::class, 'all']);
    Route::get('/articles/search', [ArticleController::class, 'search']);
});

// ===========Four admin user to access users=============
Route::get('/users', [UserController::class, 'index']);