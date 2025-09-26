<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Post\IndexController;

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

Route::get('/posts', '\App\Http\Controllers\Post\IndexController')->name('post.index');
Route::get('/posts/create', '\App\Http\Controllers\Post\CreateController')->name('post.create');
Route::post('/posts', '\App\Http\Controllers\Post\StoreController')->name('post.store');
Route::get('/posts/{post}', '\App\Http\Controllers\Post\ShowController')->name('post.show');
Route::get('/posts/{post}/edit', '\App\Http\Controllers\Post\EditController')->name('post.edit');
Route::patch('/posts/{post}', '\App\Http\Controllers\Post\UpdateController')->name('post.update');
Route::delete('/posts/{post}', '\App\Http\Controllers\Post\DestroyController')->name('post.delete');

Route::get('/posts/update', [\App\Http\Controllers\MyPostController::class, 'update']);
Route::get('/posts/delete', [\App\Http\Controllers\MyPostController::class, 'delete']);
Route::get('/posts/first_or_create', [\App\Http\Controllers\MyPostController::class, 'firstOrCreate']);
Route::get('/posts/update_or_create', [\App\Http\Controllers\MyPostController::class, 'updateOrCreate']);


Route::prefix('admin')->group(function () {
    Route::get('/post', IndexController::class)->name('admin.post.index');
});




Route::get('/main', [\App\Http\Controllers\MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [\App\Http\Controllers\ContactController::class, 'index'])->name('contacts.index');
Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about.index');

