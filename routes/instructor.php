<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Instructor\PeriodController;
use App\Http\Controllers\Instructor\StudentController;
use App\Http\Controllers\Instructor\CourseRequestController;

Route::middleware(['role:instructor'])->name('instructor.')->group(function () {
    Route::view('/dashboard', 'instructor.home')->name('dashboard');

    Route::prefix('periods')->name('periods.')->controller(PeriodController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/display', 'display')->name('display');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::post('/{id}', 'update')->name('update');
        Route::delete('/{period}', 'destroy')->name('destroy');
    });

    Route::prefix('courses')->name('courses.')->controller(CourseRequestController::class)->group(function () {
        Route::get('/', 'create')->name('request');
        Route::get('/display', 'display')->name('display');
        Route::post('/request', 'store')->name('store_request');
    });

    Route::prefix('students')->name('students.')->controller(StudentController::class)->group(function () {
        Route::get('/', 'display')->name('display');
        Route::get('/data', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
    });
});
