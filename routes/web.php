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

Route::get('/', \App\Http\Controllers\HomeController::class.'@index');
Route::get('/product', \App\Http\Controllers\Pages\ProductDescriptionController::class.'@index');
Route::get('/about', \App\Http\Controllers\Pages\AboutController::class.'@index');
Route::get('/sign-up', \App\Http\Controllers\Pages\PreviewLandingContoller::class.'@index');
Route::post('/customer/lead', \App\Actions\Customers\Leads\PostLead::class);
