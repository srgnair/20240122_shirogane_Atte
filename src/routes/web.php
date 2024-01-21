<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TimeStampController;

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

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::get('/home', [LoginController::class, 'stampView'])->name('stampView');

    Route::post('/start', [TimestampController::class, 'stampStart'])->name('stampStart');
    Route::post('/end', [TimestampController::class, 'stampEnd'])->name('stampEnd');
    Route::post('/reststart', [TimestampController::class, 'stampRestStart'])->name('stampRestStart');
    Route::post('/restend', [TimestampController::class, 'stampRestEnd'])->name('stampRestEnd');

    Route::get('/date/{date?}', [TimeStampController::class, 'dateView'])->name('dateView');
    Route::get('/date/user/{date?}/{username?}', [TimeStampController::class, 'userDateView'])->name('userDateView');
    Route::get('/users}', [TimeStampController::class, 'usersView'])->name('usersView');
});

Route::get('/login', [LoginController::class, 'loginView'])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('register/form', [LoginController::class, 'registerform'])->name('registerForm');
Route::post('register/form', [LoginController::class, 'registerconfirm'])->name('registerConfirm');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/send', [LoginController::class, 'verifyEmail'])->name('verifyEmail');
Route::get('/thanks', [LoginController::class, 'thanks'])->name('home');
