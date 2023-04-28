<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\StoreBasketRequest;
use App\Http\Resources\Favorite\OneFavoriteResource;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index(){
        $user_id=auth()->user()->id;
        $baskets=Favorite::where('user_id',$user_id)->get();
        return response([
           'message' => 'User Favorite books',
            'data' =>OneFavoriteResource::collection($baskets)
        ]);
    }
    
    public function store(StoreBasketRequest $request){
        $user_id=auth()->user()->id;
        $request->validated();
        $count=count(Favorite::where('user_id',$user_id)->where('book_id',$request->book_id)->get());
        if($count)
            return response([
                'message' =>'this book is in favorites'
            ],404);
        Favorite::create([
            'book_id'=>$request->book_id,
            'user_id'=>$user_id
        ]);
       return response([
        'message' => 'Favorite created successfully',
       ], 201);
    }
    

    public function destroy($id){
        $user_id=auth()->user()->id;
        Favorite::where('user_id',$user_id)->where('book_id',$id)->delete();
         return response([
            'message'=>'User Favorite deleted',
         ]);
    }
}
