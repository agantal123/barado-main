<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrapController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|




Route::get('/dashboard', function () {
    return view('dashboard');
});
*/


Route::get('/welcome', function () {
    return view('welcome');
});

//Route::get('/', 'HomeController@index');
// Route::get('/', 'App\Http\Controllers\HomeController@index');
// Route::get('chart', 'App\Http\Controllers\HomeController@mayChart')->name('api.chart');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);
Route::get('chart', [HomeController::class, 'mayChart'])->name('api.chart');

Route::POST('/trap_store', [HomeController::class, 'trap_store'])->name('trap_store'); 
Route::GET('/delete_trap/{id}', [TrapController::class, 'delete_trap'])->name('delete_trap'); 

Route::get('trap/{id}', [TrapController::class, 'index'])->name('trap_page'); 

