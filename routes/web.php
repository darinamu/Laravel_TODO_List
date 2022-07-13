<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'home']);

Route::get('/{id}/view', [MainController::class, 'ShowOneTodo'])->name('showonetodo');

Route::get('/{id}/delete', [MainController::class, 'DeleteTodo'])->name('deletetodo');

Route::post('/create', [MainController::class, 'create']);

Route::post(
    '/{id}/edit',
    [MainController::class, 'edit']
)->name('edit');

Route::post(
    '/{id}/edit_status',
    [MainController::class, 'edit_status']
)->name('edit_status');

Route::get('/filter', [MainController::class, 'filter'])->name('filter');