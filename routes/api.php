<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('user', 'Controller\User\UserController');

Route::resource('product', 'Controller\Product\ProductController');

Route::resource('commune', 'Controller\Commune\CommuneController');

Route::resource('province', 'Controller\Province\ProvinceController');

Route::resource('useraddress', 'Controller\UserAddress\UserAddressController');
