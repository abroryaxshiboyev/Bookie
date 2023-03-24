<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\StoreBasketRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Resources\Basket\OneBasketCollection;
use App\Http\Resources\Basket\OneBasketResource;
use App\Models\Basket;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function store(StoreBasketRequest $r){
        $user_id=auth()->user()->id;
        $r->validated();
        $basket=Basket::create([
            'book_id'=>$r->book_id,
            'user_id'=>$user_id
        ]);
       return response([
        'message' => 'Basket created successfully',
       ], 201);
    }
    public function index(){
        $user_id=auth()->user()->id;
        $baskets=Basket::where('user_id',$user_id)->get();
        return response([
           'message' => 'User Basket books',
            'data' =>OneBasketResource::collection($baskets)
        ]);
    }

    public function destroy($id){
        $user_id=auth()->user()->id;
        Basket::where('user_id',$user_id)->where('book_id',$id)->delete();
         return response([
            'message'=>'User Basket deleted',
         ]);
    }
}
