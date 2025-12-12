<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

// Главная страница - перенаправляем на автомобили
Route::get('/', function () {
    return redirect()->route('cars.index');
});

// Дашборд Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Маршруты аутентификации Breeze
require __DIR__.'/auth.php';

// Маршруты автомобилей
Route::resource('cars', CarController::class);

//  Список всех пользователей
Route::get('/users', [CarController::class, 'users'])->name('users.index');

//  Автомобили конкретного пользователя по username
Route::get('users/{username}/cars', [CarController::class, 'userCars'])
    ->name('users.cars');

// Маршруты для администратора с использованием Gates
Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('admin/trash', [CarController::class, 'trash'])->name('cars.trash');
    Route::post('admin/cars/{id}/restore', [CarController::class, 'restore'])->name('cars.restore');
    Route::delete('admin/cars/{id}/force-delete', [CarController::class, 'forceDelete'])->name('cars.force-delete'); 
});