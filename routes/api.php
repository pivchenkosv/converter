<?php

use App\Http\Controllers\ConvertCurrency;
use App\Http\Controllers\HealthCheck;
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

Route::get('healthcheck', [HealthCheck::class, 'healthCheck']);
Route::get('currencies/get', [ConvertCurrency::class, 'get']);
Route::post('currencies/convert', [ConvertCurrency::class, 'convert']);
