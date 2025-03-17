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

Route::get('/register', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'signin'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/modal', Modal::class);
Route::get('/testmodal', [ModalController::class, 'testmodal']); //モーダルのテスト用 /testmodalにアクセスすると、/modalが表示される
Route::get('/modal', Modal::class)->name('modal'); //フルページコンポーネントとして利用するとき？

//登録・ログイン機能
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

//問い合わせフォーム
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);

//検索
Route::get('/contacts/search', [ContactController::class, 'search']);
