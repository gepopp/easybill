<?php

use Illuminate\Support\Facades\Log;
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

Route::get( 'testmail', function () {

    $customer = \App\Models\Customer::where( 'last_name', 'Popp' )->first();
    $bill     = \App\Models\Bill::find( 5 );
    dd( $customer->notify( new \App\Notifications\SendBillNotification( $bill ) ) );

} );


Route::get( '/', function () {

    return view( 'welcome' );
} );

Route::middleware( [ 'auth:sanctum', 'verified' ] )->get( '/dashboard', function () {

    return view( 'dashboard' );
} )->name( 'dashboard' );


Route::middleware( [ 'auth:sanctum', 'verified' ] )->group( function () {

    Route::resource( 'customers', \App\Http\Controllers\CustomerController::class );
    Route::resource( 'products', \App\Http\Controllers\ProductController::class );
    Route::resource( 'paymentaccounts', \App\Models\PaymentAccount::class );
    Route::resource( 'quotation', \App\Http\Controllers\QuotationController::class );
    Route::get( 'billsettings', '\App\Http\Controllers\BillSettingController@edit' )->name( 'billsettings' );
} );

Route::middleware( [ 'auth:sanctum', 'verified', 'bill' ] )->group( function () {

    Route::resource( 'bills', \App\Http\Controllers\BillController::class );
    Route::get( 'bills/{bill}/send', '\App\Http\Controllers\BillController@send' )->name( 'bills.send' );
    Route::get( 'bills/{bill}/remind', '\App\Http\Controllers\BillController@remind' )->name( 'bills.remind' );
    Route::get( 'bills/{bill}/duplicate', '\App\Http\Controllers\BillController@duplicate' )->name( 'bills.duplicate' );
    Route::get( 'bills/{bill}/storno', '\App\Http\Controllers\BillController@storno' )->name( 'bills.storno' );
    Route::get( 'bills/{bill}/document', '\App\Http\Controllers\BillController@document' )->name( 'bills.document' );
    Route::get( 'bills/{bill}/sent', '\App\Http\Controllers\BillController@sent' )->name( 'bills.sent' );
    Route::get( 'bills/{bill}/download', '\App\Http\Controllers\BillController@download' )->name( 'bills.download' );

} );

Route::resource( 'lead', \App\Http\Controllers\LeadController::class )
     ->middleware( [ 'auth:sanctum', 'verified' ] );

Route::get( 'mailtest', function () {

    return view( 'newsletter.raw' );

} );


Route::get( 'beacon/{mailtrack}/image.png', '\App\Http\Controllers\MailTrackController@track')->name( 'beacon' );


Route::get('mailraw', function (){
   return view('newsletter.raw', ['beacon' => '#']);
});
