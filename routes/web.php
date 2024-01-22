<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KantinController;

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
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/login', [AuthController::class,'auth'])->name('auth');
Route::get('/logout', [AuthController::class,'logout'])->name('logout');
Route::get('/', [IndexController::class,'index'])->name('index');

Route::middleware(['user'])->group(function(){
    Route::get('/profile', [IndexController::class , 'profile'])->name('profile');
    Route::post('/addtocart', [TransactionController::class,'add_to_cart'])->name('cart.add');
    Route::get('/cart', [TransactionController::class,'cart_index'])->name('cart.index');
    Route::delete('/cart/delete/{id}', [TransactionController::class,'cart_delete'])->name('cart.delete');
    Route::post('/paycart', [TransactionController::class,'payCart'])->name('cart.pay');
    Route::get('/receipt', [TransactionController::class,'receipt'])->name('receipt');
    Route::post('/receipt/take', [TransactionController::class,'receipt_take'])->name('receipt.take');
    Route::get('/topup', [TransactionController::class,'topup'])->name('topup.index');
    Route::post('/topup/proceed', [TransactionController::class,'topup_proceed'])->name('topup.proceed');
    Route::get('/topup/receipt/{orderid}',[TransactionController::class,'receipt_topup'])->name('topup.receipt');
    Route::get('/tariktunai', [TransactionController::class,'tarik_tunai'])->name('tarik.tunai');
    Route::get('/tariktunai/receipt/{order_id}',[TransactionController::class, 'receipt_tariktunai'])->name('tarik.tunai.receipt');
    Route::post('/tariktunai', [TransactionController::class,'tarik_tunai_store'])->name('tarik.tunai.store');    
});


Route::prefix('/admin')->group(function () {
    Route::middleware(['admin'])->group(function(){
        Route::get('/', [AdminController::class,'index'])->name('admin.index');
        Route::get('/transaction', [AdminController::class,'transactionindex'])->name('admin.transaction');
        Route::get('/transaction/print/{date}/{user_id}', [AdminController::class,'print'])->name('admin.transaction.print');
        Route::get('/user', [AdminController::class,'userindex'])->name('admin.userindex');
        Route::get('/adduser', [AdminController::class,'adduserindex'])->name('admin.adduser');
        Route::post('/adduser', [AdminController::class,'adduserstore'])->name('admin.adduserstore');
        Route::get('/user/{id}/edit', [AdminController::class,'edituserindex'])->name('admin.edituserindex');
        Route::put('/user/{id}/update', [AdminController::class,'updateuserstore'])->name('admin.updateuserstore');
        Route::delete('/user/{id}/delete', [AdminController::class,'deleteuser'])->name('admin.userdelete');
    });
});

Route::prefix('/bank')->group(function () {
    Route::middleware(['bank'])->group(function () {

    Route::get('/', [BankController::class,'index'])->name('bank.index');
    Route::get('/topup', [BankController::class,'topup'])->name('bank.topup.index');
    Route::post('/topup', [BankController::class,'topupstore'])->name('bank.topup.store');
    Route::get('/topup/baru',[BankController::class,'topupnew'])->name('bank.topup.new');
    Route::post('/topup/baru',[BankController::class,'topupnewpost'])->name('bank.topup.post');
    Route::post('/topup/reject', [BankController::class,'topupreject'])->name('bank.topup.reject');
    Route::get('/tariktunai', [BankController::class,'tarik_tunai'])->name('bank.tariktunai');
    Route::get('/tariktunai/baru',[BankController::class,'tarik_tunai_new'])->name('bank.tariktunai.new');
    Route::post('/tariktunai/baru',[BankController::class,'tarik_tunai_newpost'])->name('bank.tariktunai.post');
    Route::post('/tariktunai', [BankController::class,'tarik_tunai_store'])->name('bank.tariktunai.store');
    Route::post('/tariktunai/reject', [BankController::class,'tarik_tunai_reject'])->name('bank.tariktunai.reject');
    Route::get('/transaction', [BankController::class,'transactionindex'])->name('bank.transaction');
    Route::get('/transaction/print/{date}', [BankController::class,'print'])->name('bank.transaction.print');
   });
});


Route::prefix('/kantin')->group(function () {
    Route::middleware(['kantin'])->group(function () {
        Route::get('/', [KantinController::class,'index'])->name('kantin.index');
        Route::get('/products', [KantinController::class,'productindex'])->name('kantin.product.index');
        Route::get('/addproduct', [KantinController::class,'addproductindex'])->name('kantin.addproduct.index');
        Route::post('/addproduct', [KantinController::class,'addproductstore'])->name('kantin.addproduct.store');
        Route::get('/product/{id}/edit', [KantinController::class,'editproduct'])->name('kantin.editproduct');
        Route::put('/product/{id}/update', [KantinController::class,'updateproduct'])->name('kantin.updateproduct');
        Route::delete('/product/{id}/delete', [KantinController::class,'deleteproduct'])->name('kantin.deleteproduct');
        Route::get('/transaction', [KantinController::class,'transactionindex'])->name('kantin.transaction');
        Route::get('/transaction/print/{date}/{user_id}', [KantinController::class,'print'])->name('kantin.transaction.print');
    });
});
