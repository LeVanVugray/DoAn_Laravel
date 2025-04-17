<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ExeController;
use App\Http\Controllers\DoAnNhomController;
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
// Đồ Án Nhóm F
Route::get('index', [DoAnNhomController::class, 'index'])->name('index');

Route::get('shop', [DoAnNhomController::class, 'shop'])->name('shop');

Route::get('detail', [DoAnNhomController::class, 'detail'])->name('detail');

Route::get('cart', [DoAnNhomController::class, 'cart'])->name('cart');

Route::get('checkout', [DoAnNhomController::class, 'checkout'])->name('checkout');

Route::get('contact', [DoAnNhomController::class, 'contact'])->name('contact');

Route::get('search', [DoAnNhomController::class, 'search'])->name('search');

// crud_User
Route::get('dashboard', [CrudUserController::class, 'dashboard']);

Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');

Route::get('create', [CrudUserController::class, 'createUser'])->name('user.createUser');
Route::post('create', [CrudUserController::class, 'postUser'])->name('user.postUser');

Route::get('read', [CrudUserController::class, 'readUser'])->name('user.readUser');

Route::get('delete', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');

Route::get('update', [CrudUserController::class, 'updateUser'])->name('user.updateUser');
Route::post('update', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');

Route::get('list', [CrudUserController::class, 'listUser'])->name('user.list');

Route::get('signout', [CrudUserController::class, 'signOut'])->name('signout');

Route::get('/', function () {
    return view('welcome');
});
