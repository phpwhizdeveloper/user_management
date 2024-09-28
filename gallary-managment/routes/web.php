<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/image/list',[ImageController::class,'list'])->name('image-list');
Route::post('/image/get',[ImageController::class,'imageGet']);

Route::get('/image/add',[ImageController::class,'add']);
Route::get('/image/edit/{id}',[ImageController::class,'edit']);
Route::post('/image/add',[ImageController::class,'addUpdate']);
Route::get('/image/delete/{id}',[ImageController::class,'delete']);

Route::get('/category/list',[CategoryController::class,'list'])->name('category-list');
Route::get('/category/add',[CategoryController::class,'add']);
Route::get('/category/edit/{id}',[CategoryController::class,'add']);
Route::post('/category/add',[CategoryController::class,'addUpdate']);
Route::get('/category/delete/{id}',[CategoryController::class,'delete']);