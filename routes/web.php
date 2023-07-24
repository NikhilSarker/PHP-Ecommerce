<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [FrontendController::class, 'index']);
// Route::get('/about', [FrontendController::class, 'about']);
// Route::get('/contact', [FrontendController::class, 'contact']);
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard',[HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Profile Update
Route::get('/user/profile', [HomeController::class, 'user_profile'])->name('user.profile');
Route::post('/user/info/update', [HomeController::class, 'user_info_update'])->name('user.info.update');
Route::post('/user/password/update', [HomeController::class, 'user_password_update'])->name('user.password.update');
Route::post('/user/photo/update', [HomeController::class, 'user_photo_update'])->name('user.photo.update');

// User list
Route::get('/user/list', [UserController::class, 'user_list'])->name('user.list');
Route::get('/user/remove/{user_id}', [UserController::class, 'user_remove'])->name('user.remove');
