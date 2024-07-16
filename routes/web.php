<?php

use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Instructor\PeriodController;
use App\Http\Controllers\Admin\InstructorRequestController;
use App\Http\Controllers\Instructor\CourseRequestController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;

Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::view('/dashboard', 'admin.home');

    // Instructor routes
    Route::prefix('instructors')->name('instructors.')->group(function () {
        Route::get('/', [InstructorController::class, 'display'])->name('index');
        Route::get('/data', [InstructorController::class, 'index'])->name('data');
        Route::get('{id}', [InstructorController::class, 'show'])->name('show');
        Route::delete('/destroy/{id}', [InstructorController::class, 'destroy'])->name('destroy');
        Route::post('{id}/block', [InstructorController::class, 'block'])->name('block');
        Route::post('{id}/unblock', [InstructorController::class, 'unblock'])->name('unblock');
    });

    // Instructor request routes
    Route::prefix('requests')->name('requests.')->group(function () {
        Route::get('/', [InstructorRequestController::class, 'index'])->name('index');
        Route::get('/display', [InstructorRequestController::class, 'display'])->name('display');
        Route::post('{id}/accept', [InstructorRequestController::class, 'accept'])->name('accept');
        Route::post('{id}/reject', [InstructorRequestController::class, 'reject'])->name('reject');
    });

    // Student routes
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'display'])->name('index');
        Route::get('/data', [StudentController::class, 'index'])->name('data');
        Route::get('{id}', [StudentController::class, 'show'])->name('show');
        Route::delete('/destroy/{id}', [StudentController::class, 'destroy'])->name('destroy');
        Route::post('{id}/block', [StudentController::class, 'block'])->name('block');
        Route::post('{id}/unblock', [StudentController::class, 'unblock'])->name('unblock');
    });

    // Course routes
    Route::prefix('courses')->name('courses.')->group(function () {

        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/display', [CourseController::class, 'display'])->name('display');

        Route::get('create', [CourseController::class, 'create'])->name('create');
        Route::post('/', [CourseController::class, 'store'])->name('store');

        Route::get('{id}', [CourseController::class, 'show'])->name('show');
        Route::get('{id}/edit', [CourseController::class, 'edit'])->name('edit');
        Route::post('{id}', [CourseController::class, 'update'])->name('update');

        Route::post('{course}/block', [CourseController::class, 'block'])->name('block');
        Route::post('{course}/unblock', [CourseController::class, 'unblock'])->name('unblock');
        Route::delete('{course}', [CourseController::class, 'destroy'])->name('destroy');
    });
});




Route::middleware(['role:instructor'])->group(function () {
    Route::view('/instructor/dashboard', 'instructor.home');

    Route::get('/instructors/periods', [PeriodController::class, 'index'])->name('instructor.periods.index');
    Route::get('/instructors/periods/display', [PeriodController::class, 'display'])->name('instructor.periods.display');

    Route::get('/instructors/periods/create', [PeriodController::class, 'create'])->name('instructor.periods.create');
    Route::post('/instructors/periods', [PeriodController::class, 'store'])->name('instructor.period.store');

    Route::get('/instructors/periods/{id}', [PeriodController::class, 'show'])->name('instructor.periods.show');
    Route::get('/instructors/periods/{id}/edit', [PeriodController::class, 'edit'])->name('instructor.periods.edit');
    Route::post('/instructors/periods/{id}', [PeriodController::class, 'update'])->name('instructor.periods.update');

    Route::delete('/instructors/periods/{period}', [PeriodController::class, 'destroy'])->name('instructor.periods.destroy');

    Route::get('/instructors/courses', [CourseRequestController::class, 'create'])->name('instructor.courses.request');
    Route::get('/instructors/courses/display', [CourseRequestController::class, 'display'])->name('instructor.courses.display');
    Route::post('/instructors/courses/request', [CourseRequestController::class, 'store'])->name('instructor.courses.store_request');

    Route::get('/instructor/students/data', [StudentController::class])->name('instructor.students');
});

Route::get('/', [HomeController::class, 'index'])->name('student.home');
Route::get('/students/instructors', [HomeController::class, 'instructors'])->name('student.instructors.index');


Route::view('/students/about', 'student.about')->name('students.about');
Route::view('/students/contact', 'student.contact')->name('students.contact');


Route::get('/students/mycourses', [StudentCourseController::class, 'mycourses'])->name('students.mycourses');
Route::get('/courses/index', [StudentCourseController::class, 'index'])->name('student.courses.index');
Route::get('/courses/{id}', [StudentCourseController::class, 'show'])->name('student.courses.show');
Route::get('/courses/{id}/enroll', [StudentCourseController::class, 'create'])->name('courses.create')->middleware('role:student');
Route::post('/course-enroll/{id}', [StudentCourseController::class, 'store'])->name('courses.store')->middleware('role:student');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::get('/profile-edit', [SessionController::class, 'edit'])->name('edit.profile');
Route::put('/profile', [SessionController::class, 'update'])->name('profile.update');

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
