<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\ProjcommentController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\FileController;

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

Route::resource('/projects', ProjectController::class)
    ->middleware(['auth'])
    ->name('*','projlist');

Route::get('/todos/create/{projectid}', [TodoController::class, 'create']);
Route::resource('/todos', TodoController::class)
    ->middleware(['auth'])
    ->name('*','todolist');

Route:: get('/upload/{projectid}', function($projectid) {
    return view('upload')->with('projectid', $projectid);
});
Route:: get('/memupload/{memoryid}', function($memoryid) {
    return view('/memories/memupload')->with('memoryid', $memoryid);
});

Route:: post('/uploadmemory',[UploadFileController::class,'memories']);
Route:: post('/uploadfile', [UploadFileController::class,'index']);

Route::get('/storage/files/{fileName}', [FileController::class,'index']);

Route::resource('/projcomments', ProjcommentController::class)
    ->middleware(['auth'])
    ->name('*','projlist');

Route::resource('/memories', MemoryController::class)
    ->middleware(['auth'])
    ->name('*','memories');
Route::post('/memsearch', [MemoryController::class,'index']);
Route::get('/memsearch', [MemoryController::class,'index']);


