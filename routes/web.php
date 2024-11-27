<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\WeatherRecordController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/create', [LocationController::class, 'create'])->name('locations.create');
Route::get('locations/{id}', [LocationController::class, 'show'])->name('locations.show');
Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');

Route::get('/weather-records', [WeatherRecordController::class, 'index'])->name('weather-records.index');
Route::post('/weather-records', [WeatherRecordController::class, 'store'])->name('weather-records.store');