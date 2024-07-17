<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;

Route::middleware(['role:student'])->group(function () {
    Route::prefix('students')->name('student.')->group(function () {
        Route::get('/instructors', [HomeController::class, 'instructors'])->name('instructors.index');
        
        Route::get('/mycourses', [StudentCourseController::class, 'mycourses'])->name('mycourses');
        
        Route::prefix('courses')->name('courses.')->group(function () {
            Route::get('/index', [StudentCourseController::class, 'index'])->name('index');
            Route::get('/{id}', [StudentCourseController::class, 'show'])->name('show');
            Route::get('/{id}/enroll', [StudentCourseController::class, 'create'])->name('create');
            Route::post('/enroll/{id}', [StudentCourseController::class, 'store'])->name('store');
        });
    });
});
