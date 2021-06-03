<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/******************** Catalog ************************/

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

Route::post('/catalog/ajax_add', [CatalogController::class, 'ajax_add'])->name('catalog.ajax_add');

Route::post('/catalog/ajax_edit', [CatalogController::class, 'ajax_edit'])->name('catalog.ajax_edit');

Route::delete('/catalog/destroy/{id}', [CatalogController::class, 'destroy'])->name('catalog.destroy');

/******************* ./catalog **********************/


/******************** Room ************************/

Route::get('/room', [RoomController::class, 'index'])->name('room.index');

Route::post('/room/ajax_add', [RoomController::class, 'ajax_add'])->name('room.ajax_add');

Route::post('/room/ajax_edit', [RoomController::class, 'ajax_edit'])->name('room.ajax_edit');

Route::delete('/room/destroy/{id}', [RoomController::class, 'destroy'])->name('room.destroy');

/******************* ./room **********************/


/******************** Quality ************************/

Route::get('/quality', [QualityController::class, 'index'])->name('quality.index');

Route::post('/quality/ajax_add', [QualityController::class, 'ajax_add'])->name('quality.ajax_add');

Route::post('/quality/ajax_edit', [QualityController::class, 'ajax_edit'])->name('quality.ajax_edit');

Route::delete('/quality/destroy/{id}', [QualityController::class, 'destroy'])->name('quality.destroy');

/******************* ./Quality **********************/


/******************** User ************************/

Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::post('/user/ajax_add', [UserController::class, 'ajax_add'])->name('user.ajax_add');

Route::post('/user/ajax_edit', [UserController::class, 'ajax_edit'])->name('user.ajax_edit');

Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

/******************* ./User **********************/


