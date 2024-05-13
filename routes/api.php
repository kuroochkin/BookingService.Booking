<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::post('booking/create', [BookingController::class, 'create']);
Route::patch('booking/update', [BookingController::class, 'update']);
Route::delete('booking/delete', [BookingController::class, 'delete']);
Route::get('bookings/get', [BookingController::class, 'getItemsByAccommodationId']);
Route::get('booking/get', [BookingController::class, 'getByAccommodationIdAndTenantId']);
