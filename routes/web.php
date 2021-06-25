<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\TermPaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

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

Route::get('/catalog/room/{id}', [CatalogController::class, 'room'])->name('catalog.room');

Route::get('/catalog/quality/{id}', [CatalogController::class, 'quality'])->name('catalog.quality');

Route::post('/catalog/ajax_add', [CatalogController::class, 'ajax_add'])->name('catalog.ajax_add');

Route::post('/catalog/ajax_edit/{id}', [CatalogController::class, 'ajax_edit'])->name('catalog.ajax_edit');

Route::post('/catalog/ajax_delete', [CatalogController::class, 'ajax_delete'])->name('catalog.ajax_delete');

/** SEE AGAIN BTN INDEX **/
Route::post('/catalog/ajax_see_again_index_room', [CatalogController::class, 'ajax_see_again_index_room'])->name('catalog.ajax_see_again_index_room');

/** SEE AGAIN BTN QUALITY **/
Route::post('/catalog/ajax_see_again_quality', [CatalogController::class, 'ajax_see_again_quality'])->name('catalog.ajax_see_again_quality');

/******************* ./catalog **********************/


/******************** Room ************************/

Route::get('/room', [RoomController::class, 'index'])->name('room.index');

Route::post('/room/ajax_add', [RoomController::class, 'ajax_add'])->name('room.ajax_add');

Route::post('/room/ajax_edit', [RoomController::class, 'ajax_edit'])->name('room.ajax_edit');

Route::post('/room/ajax_delete', [RoomController::class, 'ajax_delete'])->name('room.ajax_delete');

/******************* ./room **********************/


/******************** Quality ************************/

Route::get('/quality', [QualityController::class, 'index'])->name('quality.index');

Route::post('/quality/ajax_add', [QualityController::class, 'ajax_add'])->name('quality.ajax_add');

Route::post('/quality/ajax_edit', [QualityController::class, 'ajax_edit'])->name('quality.ajax_edit');

Route::post('/quality/ajax_delete', [QualityController::class, 'ajax_delete'])->name('quality.ajax_delete');

/******************* ./Quality **********************/


/******************** Term payment ************************/

Route::get('/termPayment', [TermPaymentController::class, 'index'])->name('termPayment.index');

Route::post('/termPayment/ajax_edit', [TermPaymentController::class, 'ajax_edit'])->name('termPayment.ajax_edit');

Route::get('/termPayment/term_payment_active', [TermPaymentController::class, 'term_payment_active'])->name('termPayment.term_payment_active');

//Route::delete('/quality/destroy/{id}', [QualityController::class, 'destroy'])->name('quality.destroy');

/******************* ./Term payment **********************/



/******************** User ************************/

Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::post('/user/ajax_add', [UserController::class, 'ajax_add'])->name('user.ajax_add');

Route::post('/user/ajax_edit', [UserController::class, 'ajax_edit'])->name('user.ajax_edit');

Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/user/edit_password', [UserController::class, 'edit_password'])->name('user.edit_password');

Route::post('/user/update_password', [UserController::class, 'update_password'])->name('user.update_password');

/******************* ./User **********************/


/******************** Search product ************************/

Route::get('/search/{name?}', [SearchController::class, 'index'])->name('search.index');

Route::post('/search/ajax_delete', [SearchController::class, 'ajax_delete'])->name('search.ajax_delete');

/******************* ./Search product **********************/


