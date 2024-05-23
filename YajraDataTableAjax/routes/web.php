<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'index'])->name('users.index');
Route::post('/', [UserController::class, 'store'])->name('users.store');
Route::get('/get-users', [UserController::class, 'getUsers'])->name('users.get');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::post('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
