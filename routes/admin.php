<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\InstructorRequestController;

Route::middleware(['role:admin'])->name('admin.')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
   
    // Instructor routes
    Route::prefix('instructors')->name('instructors.')->controller(InstructorController::class)->group(function () 
    {
        Route::get('/', 'display')->name('index');
        Route::get('/data', 'index')->name('data');
        Route::get('{id}', 'show')->name('show');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        Route::post('{id}/block', 'block')->name('block');
        Route::post('{id}/unblock', 'unblock')->name('unblock');
    });

    // Instructor request routes
    Route::prefix('requests')->name('requests.')->controller(InstructorRequestController::class)->group(function ()
    {
        Route::get('/', 'index')->name('index');
        Route::get('/display', 'display')->name('display');
        Route::post('{id}/accept', 'accept')->name('accept');
        Route::post('{id}/reject', 'reject')->name('reject');
    });

    // Student routes
    Route::prefix('students')->name('students.')->controller(StudentController::class)->group(function () 
    {
        Route::get('/', 'display')->name('index');
        Route::get('/data', 'index')->name('data');
        Route::get('{id}', 'show')->name('show');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        Route::post('{id}/block', 'block')->name('block');
        Route::post('{id}/unblock', 'unblock')->name('unblock');
    });

    // Course routes
    Route::prefix('courses')->name('courses.')->controller(CourseController::class)->group(function ()
     {
        Route::get('/', 'index')->name('index');
        Route::get('/display', 'display')->name('display');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('{id}', 'show')->name('show');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::post('{id}', 'update')->name('update');
        Route::post('{course}/block', 'block')->name('block');
        Route::post('{course}/unblock', 'unblock')->name('unblock');
        Route::delete('{course}', 'destroy')->name('destroy');
    });
});
