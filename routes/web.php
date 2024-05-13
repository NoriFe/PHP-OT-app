<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OvertimeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [OvertimeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('add-overtime', [OvertimeController::class, 'add']);


Route::resource('overtimes', 'App\Http\Controllers\OvertimeController')->middleware('auth');

require __DIR__.'/auth.php';
