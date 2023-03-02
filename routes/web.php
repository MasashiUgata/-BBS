<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostsController;


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

// ログインページ
Route::get('/', function () {
    return view('auth.login');
});

// トップページ
Route::get('index', [PostsController::class, 'index']);

// 新規投稿ページ
Route::get('/create-form', [PostsController::class, 'createForm']);

// 新規投稿処理
Route::post('post/create', [PostsController::class, 'create']);

// 編集ページ
Route::get('post/{id}/update-form', [PostsController::class, 'updateForm']);

// 編集処理
Route::post('/post/update', [PostsController::class, 'update']);

// 削除処理
Route::get('post/{id}/delete', [PostsController::class, 'delete']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');