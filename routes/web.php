<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Route::get('/', [TodoController::class, 'index']);
Route::get('/create', [TodoController::class, 'create']);
Route::post('/', [TodoController::class, 'store']);
Route::get('/edit/{id}', [TodoController::class, 'edit']);
Route::post('/update/', [TodoController::class, 'update']);
Route::get('/info/{id}', [TodoController::class, 'show']);
Route::get('/delete/{id}', [TodoController::class, 'destroy']);
Route::get('/done/{id}', [TodoController::class, 'done']);

Route::get('/search/', [TodoController::class, 'search'])->name('search');

Route::get('/order/status', [TodoController::class, 'order_status']);
Route::get('/order/date', [TodoController::class, 'order_date']);
// Route::get('/orderbystatus', [TodoController::class, 'orderbyDate']);
