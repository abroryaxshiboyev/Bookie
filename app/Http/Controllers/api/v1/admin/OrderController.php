<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Basket;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    
    public function store()
    {
        $user_id=auth()->user()->id;
        $basket=Basket::where('user_id',$user_id);
        $baskets=$basket->pluck('book_id')->toarray();
        if(count($baskets)!=0){
            foreach ($baskets as $value) {
                Order::create([
                    'user_id' => $user_id,
                    'book_id' => $value,
                ]);
            }
            $basket->delete();
            return response([
                'message'=>"created"
            ]);
        }else {
            return response([
                'message'=>"there are no books in the basket"
            ],404);
        }    
        
    }

   
    public function show($id)
    {
        //
    }

   
    public function update( $id)
    {
        $orders=Order::where('user_id',$id)->where('status',false)->update([
            'status'=>true
        ]);
        return response([
           'message'=>"updated"
        ]);
    }

   
    public function destroy($id)
    {
        //
    }
}
