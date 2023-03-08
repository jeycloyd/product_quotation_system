<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuotationController;

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
Route::get('/customers/create', [CustomerController::class, 'create'])->name('create.customers');
Route::post('/customers/create/store', [CustomerController::class, 'store'])->name('store.customers');

//Products
Route::get('/products/create', [ProductController::class, 'create'])->name('create.products');
Route::post('/products/create/store', [ProductController::class, 'store'])->name('store.products');

//Quotations
Route::get('/quotations/create', [QuotationController::class, 'create'])->name('create.quotations');
