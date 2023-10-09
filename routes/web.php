<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\OrderController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/network/{level}', [NetworkController::class, 'index'])->name('network')->middleware('only.user');
    Route::get('/bonus', [BonusController::class, 'index'])->name('bonus')->middleware('only.user');
    Route::get('/points', [PointController::class, 'index'])->name('points')->middleware('only.user');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/new', [OrderController::class, 'create'])->name('orders.new')->middleware('only.user');
    Route::post('/orders/new', [OrderController::class, 'store'])->name('orders.store')->middleware('only.user');
    Route::get('/orders/status/{status}/{order}', [OrderController::class, 'update'])->name('orders.update')->middleware('only.admin');
});

require __DIR__.'/auth.php';
