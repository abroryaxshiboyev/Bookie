<?php

use App\Http\Controllers\api\v1\admin\AuthController;
use App\Http\Controllers\api\v1\admin\CategoryController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function(){
    //Auth
    Route::get('check',[AuthController::class,'check']);

   //Category
    Route::post('category',[CategoryController::class,'store']);
    Route::put('category/{id}',[CategoryController::class,'update']);
    Route::delete('category/{id}',[CategoryController::class,'destroy']);
    Route::post('logout',[AuthController::class,'logout']);

});
//Auth
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

//Catgory
Route::get('category',[CategoryController::class,'index']);
Route::get('category/{id}',[CategoryController::class,'show']);

