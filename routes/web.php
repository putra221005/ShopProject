<?php

use App\Http\Controllers\ShopsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login_page');
});

Route::get('/home', [ShopsController::class, 'index'])->name('pesan.home');
Route::get('/home/detail/{id}', [ShopsController::class, 'show'])->name('pesan.detail');
Route::post('/home/detail/pesan', [ShopsController::class, 'store'])->name('pesan.store');
Route::get('/home/cart', [ShopsController::class, 'cart'])->name('pesan.cart');

//Untuk ADmin
Route::get('/home/admin/index', [AdminController::class, 'index'])->name('admin.index');
Route::get('/home/admin/index/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/home/admin/index/add', [AdminController::class, 'store'])->name('admin.store');
Route::get('/home/admin/index/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/home/admin/index/update', [AdminController::class, 'update'])->name('admin.update');
Route::post('/home/admin/index/delete', [AdminController::class, 'delete'])->name('admin.delete');

//Untuk Login
Route::get('/auth/login', [AdminController::class, 'viewlogin'])->name('login_page');
Route::post('/auth/login', [AdminController::class, 'login'])->name('auth.login');

Route::get('/auth/register', [AdminController::class, 'viewregister']);
Route::post('/auth/register', [AdminController::class, 'register'])->name('auth.register');
