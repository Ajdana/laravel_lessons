<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyPostController;

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
    return 'aaaaaaaaaaaa;';
});

Route::get('/posts', [MyPostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [MyPostController::class, 'create'])->name('post.create');

Route::post('/posts', [MyPostController::class, 'store'])->name('post.store');
Route::get('/posts/{post}', [MyPostController::class, 'show'])->name('post.show');
Route::get('/posts/{post}/edit', [MyPostController::class, 'edit'])->name('post.edit');
Route::patch('/posts/{post}', [MyPostController::class, 'update'])->name('post.update');
Route::delete('/posts/{post}', [MyPostController::class, 'destroy'])->name('post.delete');

Route::get('/posts/update', [MyPostController::class, 'update']);
Route::get('/posts/delete', [MyPostController::class, 'delete']);
Route::get('/posts/first_or_create', [MyPostController::class, 'firstOrCreate']);
Route::get('/posts/update_or_create', [MyPostController::class, 'updateOrCreate']);

Route::get('/main', [\App\Http\Controllers\MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [\App\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');
Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about.index');

