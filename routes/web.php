<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\InvoiceController;

Route::get('/', [DomainController::class, 'index'])->name('home');
Route::post('/search-domain', [DomainController::class, 'searchDomain'])->name('search.domain');
Route::get('/configure/{domain}', [DomainController::class, 'configure'])->name('configure');
Route::post('/checkout', [DomainController::class, 'checkout'])->name('checkout');
Route::get('/login', [DomainController::class, 'login'])->name('login');
Route::post('/login', [DomainController::class, 'authenticate'])->name('login.authenticate');
Route::get('/invoice', [InvoiceController::class, 'invoice'])->middleware('auth')->name('invoice.invoice');
