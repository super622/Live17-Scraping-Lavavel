<?php

use Illuminate\Support\Facades\Route;
use League\Csv\Reader;
use Illuminate\Http\Request;

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


// ----------------------------- home dashboard ------------------------------//
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

Route::post('/get_history', [App\Http\Controllers\HomeController::class, 'GetHistory'])->name('get_history');