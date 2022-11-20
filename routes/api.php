<?php

//use App\Http\Controllers\apiAuthController;

use App\Http\Controllers\apiAuthController;
use App\Http\Controllers\catController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/register',[apiAuthController::class,'register']);
Route::post('/login',[apiAuthController::class,'login']);
Route::post('/logout',[apiAuthController::class,'logout']);

Route::get('/index',[catController::class,'index']);
Route::post('/store',[catController::class,'store']);
Route::get('/show/{id}',[catController::class,'show']);
Route::post('/update/{id}',[catController::class,'update']);
Route::post('/delete/{id}',[catController::class,'destroy']);
