<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


// Create

Route::get('/', function () {
    return view('welcome');
});

Route::post('/createProduct', [ProductController::class, 'createProduct']);


// Read

Route::get('/show', [ProductController::class, 'showProducts']);


// Update

Route::get('/edit/{id}', [ProductController::class, 'showEdit']);
Route::post('/update/{id}', [ProductController::class, 'updateProduct']);


// Delete

Route::get('/delete/{id}', [ProductController::class, 'deleteProduct']);
