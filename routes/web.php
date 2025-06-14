<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ExeController;
use App\Http\Controllers\DoAnNhomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleControllers;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartCheckoutController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\OrderController;

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

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('indexadmin', [AdminController::class, 'indexadmin'])->name('indexadmin');
    //category
    Route::get('categoriesadmin', [AdminController::class, 'categoriesadmin'])->name('categoriesadmin');

    Route::get('from_add_category', [AdminController::class, 'from_add_category'])->name('from_add_category');
    Route::post('from_add_category', [AdminController::class, 'post_from_add_category'])->name('post_from_add_category');

    Route::get('from_update_category', [AdminController::class, 'from_update_category'])->name('from_update_category');
    Route::post('from_update_category', [AdminController::class, 'post_from_update_category'])->name('post_from_update_category');

    Route::get('usersadmin', [AdminController::class, 'usersadmin'])->name('usersadmin');


    Route::get('itemadmin', [AdminController::class, 'itemadmin'])->name('itemadmin');

    Route::get('from_add_user', [AdminController::class, 'from_add_user'])->name('from_add_user');
    Route::post('from_add_user', [AdminController::class, 'post_from_add_user'])->name('post_from_add_user');

    Route::get('from_update_user', [AdminController::class, 'from_update_user'])->name('from_update_user');
    Route::post('from_update_user', [AdminController::class, 'post_from_update_user'])->name('post_from_update_user');

    Route::get('deleteUser', [AdminController::class, 'deleteUser'])->name('deleteUser');

    Route::get('revenuetadmin', [AdminController::class, 'revenuetadmin'])->name('revenuetadmin');

    Route::get('resultadmin', [AdminController::class, 'resultadmin'])->name('resultadmin');

    Route::get('voucheradmin', [AdminController::class, 'voucheradmin'])->name('voucheradmin');

    Route::get('from_add_voucher', [AdminController::class, 'from_add_voucher'])->name('from_add_voucher');
    Route::post('from_add_voucher', [AdminController::class, 'post_from_add_voucher'])->name('post_from_add_voucher');

    Route::get('from_update_voucher', [AdminController::class, 'from_update_voucher'])->name('from_update_voucher');
    Route::post('from_update_voucher', [AdminController::class, 'post_from_update_voucher'])->name('post_from_update_voucher');

    Route::get('deleteVoucher', [AdminController::class, 'deleteVoucher'])->name('deleteVoucher');





    Route::get('orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('shippedorder', [OrderController::class, 'showShippedOrder'])
        ->name('orders.showShippedOrder');

    Route::post('/orders/{order}/confirm', [OrderController::class, 'confirm'])
        ->name('orders.confirm');

    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])
        ->name('orders.cancel');
});
// Admin
Route::get('indexadmin', [AdminController::class, 'indexadmin'])->name('indexadmin');

Route::get('itemadmin', [AdminController::class, 'itemadmin'])->name('itemadmin');

Route::get('resultadmin', [AdminController::class, 'resultadmin'])->name('resultadmin');

Route::get('sidebaradmin', [AdminController::class, 'sidebaradmin'])->name('sidebaradmin');

Route::get('usersadmin', [AdminController::class, 'usersadmin'])->name('usersadmin');

Route::get('footeradmin', [AdminController::class, 'footeradmin'])->name('footeradmin');

Route::get('headeradmin', [AdminController::class, 'headeradmin'])->name('headeradmin');

Route::get('categoriesadmin', [AdminController::class, 'categoriesadmin'])->name('categoriesadmin');

Route::get('from_add_user', [AdminController::class, 'from_add_user'])->name('from_add_user');
Route::post('from_add_user', [AdminController::class, 'post_from_add_user'])->name('post_from_add_user');

Route::get('from_update_user', [AdminController::class, 'from_update_user'])->name('from_update_user');
Route::post('from_update_user', [AdminController::class, 'post_from_update_user'])->name('post_from_update_user');

Route::get('deleteUser', [AdminController::class, 'deleteUser'])->name('deleteUser');

Route::get('revenuetadmin', [AdminController::class, 'revenuetadmin'])->name('revenuetadmin');

// voucheradmin
Route::get('voucheradmin', [AdminController::class, 'voucheradmin'])->name('voucheradmin');
Route::get('from_add_voucher', [AdminController::class, 'from_add_voucher'])->name('from_add_voucher');
Route::post('from_add_voucher', [AdminController::class, 'post_from_add_voucher'])->name('post_from_add_voucher');

Route::get('from_update_voucher', [AdminController::class, 'from_update_voucher'])->name('from_update_voucher');
Route::post('from_update_voucher', [AdminController::class, 'post_from_update_voucher'])->name('post_from_update_voucher');

Route::get('deleteVoucher', [AdminController::class, 'deleteVoucher'])->name('deleteVoucher');

// Đồ Án Nhóm F
Route::get('index', [DoAnNhomController::class, 'index'])->name('index');

Route::get('shop', [DoAnNhomController::class, 'shop'])->name('shop');

Route::get('detail', [DoAnNhomController::class, 'detail'])->name('detail');

Route::get('checkout', [DoAnNhomController::class, 'checkout'])->name('checkout');

Route::get('contact', [DoAnNhomController::class, 'contact'])->name('contact');

Route::get('search', [DoAnNhomController::class, 'search'])->name('search');

Route::get('detailsearch', [DoAnNhomController::class, 'detailsearch'])->name('detailsearch');


// crud_User

Route::get('productadmin', [AdminController::class, 'productsadmin'])->name('admin.productadmin');

Route::get('addproduct', [AdminController::class, 'form_add_product'])->name('form_add_product');
Route::post('addproduct', [AdminController::class, 'post_form_add_product'])->name('post_form_add_product');

Route::get('editproduct', [AdminController::class, 'form_edit_product'])->name('form_edit_product');
Route::post('editproduct', [AdminController::class, 'post_edit_product'])->name('post_edit_product');

Route::get('deleteProduct', [AdminController::class, 'deleteProduct'])->name('deleteProduct');

//Login & Register
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

Route::get('role', [RoleControllers::class, 'role'])->name('user.role');

Route::get('auth/google/', [SocialAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::post('/logout', [CrudUserController::class, 'signOut'])->name('logout');

//Forgot Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.form');
Route::post('forgot-password/send-code', [ForgotPasswordController::class, 'sendCode'])->name('forgot.sendCode');

Route::get('verify-code', [ForgotPasswordController::class, 'showVerifyForm'])->name('forgot.verifyCode');
Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('forgot.resetPassword');



//Gio hang
Route::get('cart', [CartController::class, 'getCartDetails'])->name('cart');

Route::get('/cart/item/delete/{cart_item_id}', [CartController::class, 'destroy'])
    ->name('cartItem.Delete');

Route::post('/cart/checkout/{cart_item_id}', [CartController::class, 'store'])
    ->name('cart.checkout');

Route::delete('/cart/checkout/{checkout_id}', [CartCheckoutController::class, 'destroy'])
    ->name('cart.checkout.delete');

Route::post('/check-voucher', [VoucherController::class, 'checkVoucher']);

Route::post('/checkoutitem', [CheckOutController::class, 'checkout'])->name('checkoutitem');

Route::post('/ordercreate', [CheckOutController::class, 'placeOrder'])->name('ordercreate');

Route::get('orders', [OrderController::class, 'index'])
    ->name('orders.index');

Route::get('shippedorder', [OrderController::class, 'showShippedOrder'])
    ->name('orders.showShippedOrder');

Route::post('/orders/{order}/confirm', [OrderController::class, 'confirm'])
    ->name('orders.confirm');

Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])
    ->name('orders.cancel');


Route::get('/', function () {
    return view('welcome');
});
