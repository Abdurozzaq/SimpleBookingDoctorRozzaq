<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingDoctorController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::group(['middleware' => 'auth:api'], function () {
        // Patient - Booking Doctor
        Route::post('/booking-doctor', [BookingDoctorController::class, 'submitForm'])->name('booking-doctor');

        // Admin - Manage Treatment
        Route::apiResource('treatment', TreatmentController::class)->except([
            'create', 'edit'
        ]);

        // Admin - Manage Doctor
        Route::apiResource('doctor', DoctorController::class)->except([
            'create', 'edit'
        ]);

        // Admin - Manage Booking Doctor
        Route::apiResource('bookingdoctor', BookingDoctorController::class)->except([
            'create', 'edit', 'store'
        ]);
        Route::get('/booking/patient', [BookingDoctorController::class, 'getPatient']);
        Route::get('/booking/doctor', [BookingDoctorController::class, 'getDoctor']);
        Route::get('/booking/treatment', [BookingDoctorController::class, 'getTreatment']);
    });
});
