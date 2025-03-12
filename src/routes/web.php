<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'admin']);
});

/*
Route::get('/admin', [ContactController::class, 'index']);
*/

Route::get('/register', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'signin'])->name('login');
/*Route::post('/login', [AuthController::class, 'login']);*/
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'thanks']);