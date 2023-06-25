<?php

use App\Http\Controllers\AircraftController;
use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\SoldTicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'show'])->name('login');

Route::middleware('auth')->group(function (){
    Route::get('dashboard', DashboardController::class);
    Route::prefix('flights')->group(function (){
        Route::get('', [FlightController::class, 'index']);
        Route::get('{id}/cancel', [FlightController::class, 'cancelFlight']);
    });
    Route::get('airline/{id}/bankrupt', [AirlineController::class, 'goBankrupt']);
    Route::get('aircraft/{id}/grounded', [AircraftController::class, 'getGrounded']);
    Route::post('sold-tickets', [SoldTicketController::class, 'store']);
});

Route::post('login', [AuthController::class, 'login'])->name('login-airline-ticketing-system');
Route::get('logout', [AuthController::class, 'logout'])->name('logout-airline-ticketing-system');
