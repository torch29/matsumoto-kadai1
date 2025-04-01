<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Livewire\Modal;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

//表示
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'admin']);
});

/* 不要
Route::get('/register', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'signin'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
*/

Route::get('/modal', Modal::class);


//登録・ログイン機能
Route::post('/register', [RegisteredUserController::class, 'store']);
//Route::post('/login', [AuthenticatedSessionController::class, 'store']);

//プロフィール画面の表示
Route::get('/profile', [AuthController::class, 'profile']);
Route::post('/profile_entry', [AuthController::class, 'profile_entry']);

//問い合わせフォーム
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);

//お問い合わせの削除
Route::delete('/delete', [ContactController::class, 'delete']);

//検索
Route::get('/search', [ContactController::class, 'search']);
