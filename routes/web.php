<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\UserController;

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

//pages that can be accessed by everyone
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    //pages that both admin and viewer can see but must be logged in
    //Pages 
    Route::get('/', [PagesController::class, 'home'])->name('home');
    Route::get('/quotations/select-customer', [PagesController::class, 'selectCustomer'])->name('select_customers');
    
    Route::get('/quotations/view', [QuotationController::class, 'viewQuotations'])->name('view.quotations');
    Route::get('/quotations/view/{id}', [QuotationController::class, 'show'])->name('show.quotations');
    
    //PDF for Quotation
    Route::get('quotations/download/{id}',[QuotationController::class, 'downloadPDF'])->name('downloadPDF.quotations');
    Route::get('quotations/preview/{id}',[QuotationController::class, 'previewPDF'])->name('previewPDF.quotations');

    //pages that only the admin can access and use
    Route::middleware(['check_role'])->group(function () {
        
        // For customers
        Route::get('/customers/index', [CustomerController::class, 'index'])->name('index.customers');
        Route::get('/customers/edit/{id}', [CustomerController::class, 'show'])->name('show.customers');
        Route::get('/customers/create', [CustomerController::class, 'create'])->name('create.customers');
        Route::get('/customers/search', [CustomerController::class, 'search'])->name('search.customers');
        Route::post('/customers/create/store', [CustomerController::class, 'store'])->name('store.customers');
        Route::post('/customers/update/{id}', [CustomerController::class, 'update'])->name('update.customers');
        Route::get('/customers/delete', [CustomerController::class, 'destroy'])->name('destroy.customers');
        Route::get('/customers/view/{id}',[CustomerController::class, 'view'])->name('view.customers');
        
        //Quotations
        Route::get('/quotations/select-customer', [QuotationController::class, 'showSelectCustomer'])->name('select.customers');
        Route::get('/quotations/create', [QuotationController::class, 'create'])->name('create.quotations');
        Route::get('/quotations/success', [QuotationController::class, 'success'])->name('success.quotations');
        Route::post('/quotations/create/add', [QuotationController::class, 'addProducts'])->name('add.products');
        Route::post('/quotations/store', [QuotationController::class, 'store'])->name('store.quotations');
        Route::get('quotations/delete',[QuotationController::class, 'destroy'])->name('destroy.quotations');
        Route::get('quotations/search/',[QuotationController::class, 'search'])->name('search.quotations');

       

        //Temp-tables for products
        Route::get('quotations/create/{product_name}/{quotation_id}',[ProductController::class, 'destroyProductQuotation'])->name('destroy.quotationsProducts');
        Route::get('quotations/create/subtract/{product_name}/{quotation_id}',[ProductController::class, 'subtractOne'])->name('subtractOne.quotationsProducts');

        //Products
        Route::get('/products/index', [ProductController::class, 'index'])->name('index.products');
        Route::get('/products/edit/{id}', [ProductController::class, 'show'])->name('show.products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('create.products');
        Route::get('/products/search', [ProductController::class, 'search'])->name('search.products');
        Route::post('/products/create/store', [ProductController::class, 'store'])->name('store.products');
        Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('update.products');
        Route::get('/products/delete', [ProductController::class, 'destroy'])->name('destroy.products');

        //Users
        Route::get('/users/index', [UserController::class, 'index'])->name('index.users');
        Route::get('/users/update', [UserController::class, 'update'])->name('update.users');
    });
});