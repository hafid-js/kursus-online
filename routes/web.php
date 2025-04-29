<?php

use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class,'index'])->name('home');

// Student Routes
Route::group(['middleware' => ['auth:web', 'verified','check_role:student'], 'prefix' => 'student', 'as' => 'student.'], function() {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/become-instructor', [StudentDashboardController::class, 'becomeInstructor'])->name('become-instructor');
    Route::post('/become-instructor', [StudentDashboardController::class, 'becomeInstructorUpdate'])->name('become-instructor.update');

    // profile routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])->name('profile.update-social');

});

// Instructor Routes
Route::group(['middleware' => ['auth:web', 'verified','check_role:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function() {
    Route::get('/dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
        // profile routes
        Route::get('profile', [ProfileController::class, 'instructorIndex'])->name('profile.index');
        Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
        Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
        Route::post('profile/update-social', [ProfileController::class, 'updateSocial'])->name('profile.update-social');

        // course routes
        Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses/create', [CourseController::class, 'storeBasicInfo'])->name('courses.store-basic-info');
        Route::get('courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::post('courses/update', [CourseController::class, 'update'])->name('courses.update');


        // lfm routes
        Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });
});


require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
