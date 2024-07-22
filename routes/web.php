<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Auth\VerificationController;



Route::view('/about', 'student.about')->name('students.about');
Route::view('/contact', 'student.contact')->name('students.contact');
Route::get('/', [HomeController::class, 'index'])->name('student.home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile-edit', [SessionController::class, 'edit'])->name('edit.profile');
    Route::put('/profile', [SessionController::class, 'update'])->name('profile.update');

    // In your web.php
    Route::get('verify-otp', [VerificationController::class, 'showVerifyForm'])->name('otp.verify.show');
    Route::post('verify-otp', [VerificationController::class, 'verifyOtp'])->name('otp.verify');


    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});
