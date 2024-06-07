<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuestController;

Auth::routes();

// Default route
Route::get('/', function () {
    return view('welcome');
})->name('/');



Route::get('/0/{id}', [GuestController::class, 'getUser']);


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/update', [HomeController::class, 'update'])->name('update');

