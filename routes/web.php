<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('cars.index');
})->name('cars.index');

Route::get('/', [CarController::class, 'index'])->name('cars.index');

Route::resource('cars', CarController::class)->except(['index']);

// Для проверки - тестовый маршрут
Route::get('/test', function () {
    return view('cars.index');
});