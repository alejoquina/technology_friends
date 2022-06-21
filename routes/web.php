<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Models\Like;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/configuracion',[UserController::class,'config'])->name('config');
Route::post('/user/update',[UserController::class,'update'])->name('user.update');
Route::get('/user/avatar/{filename}',[UserController::class,'getImage'])->name('user.avatar');

Route::get('/subir-imagen',[ImageController::class,'create'])->name('image.create');
Route::post('/image/save',[ImageController::class,'save'])->name('image.save');
Route::get('/image/file/{filename}',[ImageController::class,'getImage'])->name('image.file');
Route::get('/image/detail/{id}',[ImageController::class,'detail'])->name('image.detail');
Route::post('comment/{id}',[CommentController::class,'store'])->name('comment');
Route::get('/comment/delete/{id}',[CommentController::class,'delete'])->name('comment.delete');
Route::get('/like/{image_id}',[LikeController::class,'like'])->name('like.save');
Route::get('/dislike/{image_id}',[LikeController::class,'dislike'])->name('like.delete');

