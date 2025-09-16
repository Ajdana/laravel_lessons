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

Route::get('/posts', [MyPostController::class, 'index']);
Route::get('/posts/create', [MyPostController::class, 'create']);
Route::get('/posts/update', [MyPostController::class, 'update']);
