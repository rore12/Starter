<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Secondcontroller;
use App\Http\Controllers\CrudController;
use App\Mail\NotifyEmail;
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

Auth::routes(['verify' =>true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home') ->middleware('verified');

Route::get('fillable',[CrudController::class,'getOffers']);

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

    Route::group(['prefix' =>'offers'], function () {
        Route::get('create', [CrudController::class,'create']);
        Route::post('/storee', [CrudController::class, 'store']);
        Route::get('all', [CrudController::class, 'getAllOffers'])->name('offers.all');
    

    });
    });


    Route::post('store',function()
{
    return view('offers.create');
});