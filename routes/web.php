<?php

use Illuminate\Support\Facades\Route;

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

Route::get('testmail', function (){

    $customer = \App\Models\Customer::where('last_name', 'Popp')->first();
    $bill = \App\Models\Bill::find(5);
    dd($customer->notify(new \App\Notifications\SendBill($bill)));

});


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('bills', \App\Http\Controllers\BillController::class);


Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('paymentaccounts', \App\Models\PaymentAccount::class);

    Route::get('bill/{bill}/send', '\App\Http\Controllers\BillController@send')->name('bill.send');
    Route::get('bill/{bill}/duplicate', '\App\Http\Controllers\BillController@duplicate')->name('bill.duplicate');
    Route::get('bill/{bill}/storno', '\App\Http\Controllers\BillController@storno')->name('bill.storno');
    Route::get('bill/{bill}/document', '\App\Http\Controllers\BillController@document')->name('bill.document');

    Route::get('billsettings', '\App\Http\Controllers\BillSettingController@edit')->name('billsettings');
});
