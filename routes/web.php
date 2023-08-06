<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
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

//category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');
Route::get('/category/soft/delete/{category_id}', [CategoryController::class, 'category_soft_delete'])->name('category.soft.delete');
Route::get('/category/trash', [CategoryController::class, 'category_trash'])->name('category.trash');
Route::get('/category/restore/{category_id}', [CategoryController::class, 'category_restore'])->name('category.restore');
Route::get('/category/hard/delete/{category_id}', [CategoryController::class, 'category_hard_delete'])->name('category.hard.delete');
Route::post('/delete/checked', [CategoryController::class, 'delete_checked'])->name('delete.checked');
Route::post('/restore/checked', [CategoryController::class, 'restore_checked'])->name('restore.checked');



//Subcategory
Route::get('/subcategory',[SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/store',[SubcategoryController::class, 'subcategory_store'])->name('subcategory.store');
Route::get('/subcategory/edit/{id}',[SubcategoryController::class, 'subcategory_edit'])->name('subcategory.edit');
Route::post('/subcategory/update/{id}',[SubcategoryController::class, 'subcategory_update'])->name('subcategory.update');
Route::get('/subcategory/delete/{id}',[SubcategoryController::class, 'subcategory_delete'])->name('subcategory.delete');


// Brand
Route::get('/brand',[BrandController::class, 'brand'])->name('brand');
Route::post('/brand/store',[BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/edit/{id}',[BrandController::class, 'brand_edit'])->name('brand.edit');
Route::post('/brand/update',[BrandController::class, 'brand_update'])->name('brand.update');
Route::get('/brand/delete/{id}',[BrandController::class, 'brand_delete'])->name('brand.delete');

