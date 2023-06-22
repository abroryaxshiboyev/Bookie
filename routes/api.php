<?php

use App\Http\Controllers\api\v1\admin\AdminController;
use App\Http\Controllers\api\v1\admin\AudioController;
use App\Http\Controllers\api\v1\admin\AuthController;
use App\Http\Controllers\api\v1\admin\AuthorController;
use App\Http\Controllers\api\v1\admin\BookController;
use App\Http\Controllers\api\v1\admin\CategoryController;
use App\Http\Controllers\api\v1\admin\DiscbookController;
use App\Http\Controllers\api\v1\admin\DiscountController;
use App\Http\Controllers\api\v1\admin\DubAuthorController;
use App\Http\Controllers\api\v1\admin\ImageController;
use App\Http\Controllers\api\v1\admin\OrderController;
use App\Http\Controllers\api\v1\admin\ReviewController;
use App\Http\Controllers\api\v1\admin\UserController;
use App\Http\Controllers\api\v1\user\BasketController;
use App\Http\Controllers\api\v1\user\FavoriteController;
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
    Route::get('userabout',[AuthController::class,'userabout']);
    Route::get('check',[AuthController::class,'check']);
    Route::post('logout',[AuthController::class,'logout']);

    //userEdit
    Route::post('userimage',[UserController::class,'storeImage']);
    Route::put('user',[UserController::class,'update']);

    //Admin
    Route::post('admin',[AdminController::class,'store'])->can('admin create');
    Route::delete('admin/{id}',[AdminController::class,'destroy'])->can('admin delete');;

    //User
    Route::get('usersall',[UserController::class,'allusers']);
    Route::put('userpassword/{id}',[UserController::class,'password_edit']);

    //Category
    Route::post('category',[CategoryController::class,'store'])->can('category create');
    Route::put('category/{id}',[CategoryController::class,'update'])->can('category update');
    Route::delete('category/{id}',[CategoryController::class,'destroy'])->can('category delete');

    //Book
    Route::post('book',[BookController::class,'store'])->can('book create');
    Route::post('book/{id}',[BookController::class,'update'])->can('book update');
    Route::delete('book/{id}',[BookController::class,'destroy'])->can('book delete');
    Route::get('new_book',[BookController::class,'newbooks_admin'])->can('book delete');
    Route::get('onebook/{id}',[BookController::class,'show_admin'])->can('book delete');

    //Discount
    Route::post('discount',[DiscountController::class,'store'])->can('discount create');
    Route::put('discount/{id}',[DiscountController::class,'update'])->can('discount update');
    Route::delete('discount/{id}',[DiscountController::class,'destroy'])->can('discount delete');

    //DiscBook
    Route::post('discbook',[DiscbookController::class,'store'])->can('discbook create');
    Route::put('discbook/{id}',[DiscbookController::class,'update'])->can('discbook update');
    Route::delete('discbook/{id}',[DiscbookController::class,'destroy'])->can('discbook deelete');

    //DubAuthor
    Route::post('dubauthor',[DubAuthorController::class,'store'])->can('dubauthor create');
    Route::put('dubauthor/{id}',[DubAuthorController::class,'update'])->can('dubauthor update');
    Route::delete('dubauthor/{id}',[DubAuthorController::class,'destroy'])->can('dubauthor delete');

    //Author
    Route::post('author',[AuthorController::class,'store'])->can('dubauthor create');
    Route::put('author/{id}',[AuthorController::class,'update'])->can('dubauthor update');
    Route::delete('author/{id}',[AuthorController::class,'destroy'])->can('dubauthor delete');


    //Audio
    Route::get('book_audios/{id}',[AudioController::class,'book_audios']);
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
    Route::get('order_user',[OrderController::class,'user_orders']);
    Route::get('order',[OrderController::class,'index'])->can('order view');
    Route::post('order',[OrderController::class,'store']);
    Route::post('oneorder',[OrderController::class,'storeOne']);
    Route::delete('order/{id}',[OrderController::class,'destroy'])->can('order update');
    Route::put('order/{id}',[OrderController::class,'update'])->can('order update');

    //Review
    Route::post('review',[ReviewController::class,'store']);
    // Route::delete('review/{id}',[ReviewController::class,'destroy']);
    // Route::put('review/{id}',[ReviewController::class,'update']);


    Route::get('book_user',[BookController::class,'index_user']);
    Route::get('book_rating_user',[BookController::class,'recommendation_user']);
    Route::get('book_click_user',[BookController::class,'popular_user']);
    Route::get('book_new_user',[BookController::class,'newbooks_user']);
    Route::get('book_user/{id}',[BookController::class,'show_user']);
    
    Route::get('category_user/{id}',[CategoryController::class,'show']);
});


//Auth
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login'])->name('login');

//Catgory
Route::get('category',[CategoryController::class,'index']);
if (auth('sanctum')->check()) {
    Route::middleware('auth:sanctum')->group(function(){
    Route::get('category/{id}', [CategoryController::class, 'show']);
});
}
else{
    Route::get('category/{id}', [CategoryController::class, 'show']);
}

//Book
// if(auth('sanctum')->check()){
//     Route::middleware('auth:sanctum')->group(function(){
//     Route::get('book_rating',[BookController::class,'recommendation']);
//     Route::get('book_click',[BookController::class,'popular']);
//     Route::get('book_new',[BookController::class,'newbooks']);
//     Route::get('book',[BookController::class,'index']);
//     Route::get('book/{id}',[BookController::class,'show']);
// });}
// else{
//     Route::get('book_rating',[BookController::class,'recommendation']);
//     Route::get('book_click',[BookController::class,'popular']);
//     Route::get('book_new',[BookController::class,'newbooks']);
//     Route::get('book',[BookController::class,'index']);
//     Route::get('book/{id}',[BookController::class,'show']);
// }
Route::get('booksearch',[BookController::class,'booksearch']);
Route::get('book_rating',[BookController::class,'recommendation']);
Route::get('book_click',[BookController::class,'popular']);
Route::get('book_new',[BookController::class,'newbooks']);
Route::get('book',[BookController::class,'index']);
Route::get('book/{id}',[BookController::class,'show']);
Route::get('book_rating_click/{id}',[BookController::class,'book_rating_click']);


//DubAuthor
Route::get('dubauthor',[DubAuthorController::class,'index']);
Route::get('dubauthor/{id}',[DubAuthorController::class,'show']);

//Author
Route::get('author',[AuthorController::class,'index']);
Route::get('author/{id}',[AuthorController::class,'show']);

//Discount
Route::get('discount',[DiscountController::class,'index']);
Route::get('discount/{id}',[DiscountController::class,'show']);

//Comments
Route::get('comments/{id}',[ReviewController::class,'index']);
