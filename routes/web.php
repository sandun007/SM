<?php

use App\Http\Controllers\AdminController;
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

Route::get('/',[AdminController::class,'register'])->name('register');
Route::get('list',[AdminController::class,'list'])->name('list');
Route::post('list',[AdminController::class,'store'])->name('store');
Route::get('update/{id}',[AdminController::class,'edit'])->name('edit');
Route::post('update',[AdminController::class,'update'])->name('update');

Route::get('update-form/{id}', [AdminController::class, 'editForm'])->name('update.form');
Route::delete('list/{id}', [AdminController::class, 'delete'])->name('delete');

