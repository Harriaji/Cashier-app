<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Models\cart;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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


// Route::get('EditCategory', function () {
//     return view('layo    uts.editCategory');
// });


Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/History',[TransactionController::class, 'transaction'])->name('sejarah');
    Route::get('/reset',[TransactionController::class, 'reset'])->name('transaction.reset');
    Route::post('/Transaction/checkout',[TransactionController::class, 'checkout'])->name('transaction.checkout');
    Route::resource('/Item',ItemController::class);
    Route::resource('/Transaction',TransactionController::class);
    Route::resource('/Category',CategoryController::class);
});

Route::middleware('guest')->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});

