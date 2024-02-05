<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\ProjcommentController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\TypeoffoodController;

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

/*Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class,'index'])
    ->name('dashboard');

Route::get('/about', function () {
    return view('about');
});

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
Route:: get('/recipeupload/{recipeid}', function($recipeid) {
    return view('/recipes/recipeupload')->with('recipeid', $recipeid);
});

Route:: post('/uploadmemory',[UploadFileController::class,'memories']);
Route:: post('/uploadrecipe',[UploadFileController::class,'recipes']);
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

Route::resource('/articles', ArticleController::class)
    ->name('*','articles');

Route::resource('/categories', CategoryController::class)
    ->name('*','categories');

Route::get('/blog', [BlogController::class,'index']);
Route::post('/blog', [BlogController::class,'index']);

Route::resource('/comments', CommentController::class)
    ->name('*','comments');

//Recept:

Route::resource('/recipes', RecipeController::class)
    ->name('*','recipes');

Route::resource('/ingredients', IngredientController::class)
    ->name('*','ingredients');

Route::resource('/typeoffoods', TypeoffoodController::class)
    ->name('*','typeoffoods');

