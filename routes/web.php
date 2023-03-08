<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PagesController;
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

Route::get('/', [PagesController::class, 'home'])->name('home');

//Customers
Route::get('/customer/create', [CustomerController::class, 'create'])->name('create.customers');
Route::post('/customer/create/store', [CustomerController::class, 'store'])->name('store.customers');
