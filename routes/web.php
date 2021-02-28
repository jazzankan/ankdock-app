<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


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
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*Route::get('/projects', [ProjectController::class, 'index'])
    ->middleware(['auth'])
    ->name('projlist');*/

Route::resource('/projects', ProjectController::class)
    ->middleware(['auth'])
    ->name('*','projlist');

Route::get('/todos/create/{projectid}', [TodoController::class, 'create']);
Route::resource('/todos', TodoController::class)
    ->middleware(['auth'])
    ->name('*','todolist');
