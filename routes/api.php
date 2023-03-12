<?php

use App\Http\Controllers\api\v1\admin\AuthController;
use App\Http\Controllers\api\v1\admin\BookController;
use App\Http\Controllers\api\v1\admin\CategoryController;
use App\Http\Controllers\api\v1\admin\ImageController;
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
    Route::post('logout',[AuthController::class,'logout']);

    //Category
    Route::post('category',[CategoryController::class,'store'])->can('category create');
    Route::put('category/{id}',[CategoryController::class,'update'])->can('category update');
    Route::delete('category/{id}',[CategoryController::class,'destroy'])->can('category delete');

    //Book
    Route::post('book',[BookController::class,'store'])->can('book create');
    Route::put('book/{id}',[BookController::class,'update'])->can('book update');
    Route::delete('book/{id}',[BookController::class,'destroy'])->can('book delete');
    
});


//Auth
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

//Catgory
Route::get('category',[CategoryController::class,'index']);
Route::get('category/{id}',[CategoryController::class,'show']);

//Book
Route::get('book',[BookController::class,'index']);
Route::get('book/{id}',[BookController::class,'show']);

//upload image

