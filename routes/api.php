<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ServiceController;

Route::prefix('v1')->group(function () {
    // Services (public)
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{id}', [ServiceController::class, 'show']);

    // Bookings
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::patch('/bookings/{id}/cancel', [BookingController::class, 'cancel']);

    // Contact
    Route::post('/contact', [ContactController::class, 'store']);
});
