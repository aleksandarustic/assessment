<?php

use App\Http\Controllers\TickerController;
use App\Http\Controllers\TickerStockPriceController;
use App\Http\Controllers\ReportingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/tickers', [TickerController::class, 'index']);
Route::get('/tickers/{ticker}', [TickerController::class, 'show']);

Route::get('/tickers-stock-prices', [TickerStockPriceController::class, 'index']);
Route::get('/tickers-stock-prices/{ticker-stock-price}', [TickerStockPriceController::class, 'show']);
Route::get('/tickers-stock-prices/latest', [TickerStockPriceController::class, 'latest']);

Route::get('/report', [ReportingController::class,'report']);



