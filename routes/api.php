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


Route::post("/login",[\App\Http\Controllers\ApiAuthController::class,'login']);
Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/items',[\App\Http\Controllers\POSAppController::class,'get_items']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
