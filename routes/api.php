<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\ServiceTypeController;
use Illuminate\Support\Facades\Route;

//----------------------- Login -----------------------
Route::post('/login', [AuthController::class, 'login']);
//--------------------- End Login --------------------

//------------------- Authentication -----------------
Route::middleware('auth:sanctum')->group(function () {

    //----------------------- Logout -----------------------
    Route::post('/logout', [AuthController::class, 'logout']);
    //--------------------- End Logout --------------------

    //------------------- Service Type -------------------
    // Get all service types
    Route::get('/service-types', [ServiceTypeController::class, 'index']);
    //----------------- End Service Type ------------------

    //----------------------- Booking ----------------------
    // Create booking
    Route::post('/bookings', [BookingController::class, 'store']);
    //--------------------- End Booking -------------------
});
//----------------- End Authentication -----------------
