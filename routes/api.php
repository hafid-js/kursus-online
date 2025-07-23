<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Frontend\BlogController;
use App\Http\Controllers\Api\Frontend\FrontendController;

Route::prefix('api')->group(function() {
    Route::get('/home', [FrontendController::class, 'index']);
    Route::get('/about', [FrontendController::class, 'about']);
    Route::post('/subscribe', [FrontendController::class, 'subscribe']);
    Route::get('/custom-page/{slug}', [FrontendController::class, 'customPage']);

    Route::get('/blog', [FrontendController::class, 'blogIndex']);
    Route::get('/blog/{blog}', [FrontendController::class, 'blogShow']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/blog/{blog}/comment', [FrontendController::class, 'storeComment']);
    });
});
