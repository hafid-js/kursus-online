<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Frontend\FrontendController;
use App\Http\Controllers\Api\Frontend\InstructorDashboardController;
use App\Http\Controllers\Api\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

Route::get('/about', [FrontendController::class, 'about']);
Route::post('/subscribe', [FrontendController::class, 'subscribe']);
Route::get('/custom-page/{slug}', [FrontendController::class, 'customPage']);
Route::get('/blog', [FrontendController::class, 'blogIndex']);
Route::get('/blog/{blog}', [FrontendController::class, 'blogShow']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy']);

    Route::middleware('role:student')->group(function () {
        Route::get('/student/dashboard', [StudentDashboardController::class, 'index']);
    });

    Route::middleware('role:instructor')->group(function () {
        Route::get('/home', [FrontendController::class, 'index']);
        Route::get('/instructor/dashboard', [InstructorDashboardController::class, 'index']);
    });
});
