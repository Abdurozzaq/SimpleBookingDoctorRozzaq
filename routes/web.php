<?php

use App\Http\Controllers\BookingDoctorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// AUTH PAGES
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/logout', function () {
    return view('auth.logout');
})->name('logout');


// HOME PAGES
Route::get('/patient-dashboard', [BookingDoctorController::class, 'showForm'])->name('patient-dashboard');

Route::get('/admin-dashboard', function () {
    return view('admin.index');
})->name('admin-dashboard');

// TREATMENT PAGES
Route::get('/manage-treatment', function () {
    return view('admin.manage-treatment');
})->name('manage-treatment');

// DOCTOR PAGES
Route::get('/manage-doctor', function () {
    return view('admin.manage-doctor');
})->name('manage-doctor');

// BOOKING PAGES
Route::get('/manage-booking', function () {
    return view('admin.manage-booking');
})->name('manage-booking');




