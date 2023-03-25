<?php

use App\Http\Controllers\api\v1\admin\AdminController;
use App\Http\Controllers\api\v1\admin\AudioController;
use App\Http\Controllers\api\v1\admin\AuthController;
use App\Http\Controllers\api\v1\admin\BookController;
use App\Http\Controllers\api\v1\admin\CategoryController;
use App\Http\Controllers\api\v1\admin\DubAuthorController;
use App\Http\Controllers\api\v1\admin\ImageController;
use App\Http\Controllers\api\v1\admin\OrderController;
use App\Http\Controllers\api\v1\user\BasketController;
use App\Http\Controllers\api\v1\user\FavoriteController;
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

    //Admin
    Route::post('admin',[AdminController::class,'store'])->can('admin create');
    Route::delete('admin/{id}',[AdminController::class,'destroy'])->can('admin delete');;

    //Category
    Route::post('category',[CategoryController::class,'store'])->can('category create');
    Route::put('category/{id}',[CategoryController::class,'update'])->can('category update');
    Route::delete('category/{id}',[CategoryController::class,'destroy'])->can('category delete');

    //Book
    Route::post('book',[BookController::class,'store'])->can('book create');
    Route::put('book/{id}',[BookController::class,'update'])->can('book update');
    Route::delete('book/{id}',[BookController::class,'destroy'])->can('book delete');

    //DubAuthor
    Route::post('dubauthor',[DubAuthorController::class,'store'])->can('dubauthor create');
    Route::put('dubauthor/{id}',[DubAuthorController::class,'update'])->can('dubauthor update');
    Route::delete('dubauthor/{id}',[DubAuthorController::class,'destroy'])->can('dubauthor delete');

    //Audio
    Route::post('audio',[AudioController::class,'store'])->can('audio create');
    Route::put('audio/{id}',[AudioController::class,'update'])->can('audio update');
    Route::delete('audio/{id}',[AudioController::class,'destroy'])->can('audio delete');

    //Basket
    Route::post('basket',[BasketController::class,'store']);
    Route::delete('basket/{id}',[BasketController::class,'destroy']);
    Route::get('basket',[BasketController::class,'index']);

     //Favorite
     Route::post('favorite',[FavoriteController::class,'store']);
     Route::delete('favorite/{id}',[FavoriteController::class,'destroy']);
     Route::get('favorite',[FavoriteController::class,'index']);

    //Order
    Route::post('order',[OrderController::class,'store']);
    Route::delete('order/{id}',[OrderController::class,'destroy'])->can('order update');
    Route::put('order/{id}',[OrderController::class,'update'])->can('order update');

    Route::get('order',[OrderController::class,'index']);

    //Image
    Route::post('upload',[ImageController::class,'store']);
    
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

//DubAuthor
Route::get('dubauthor',[DubAuthorController::class,'index']);
Route::get('dubauthor/{id}',[DubAuthorController::class,'show']);


//upload image

