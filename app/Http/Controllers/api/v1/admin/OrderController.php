<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOneOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Order\OneOrderResource;
use App\Models\Basket;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders=Order::all();
        return response([
            'message' => 'all orders',
            'data' => OneOrderResource::collection($orders)
        ]);
    }

    
    public function store(StoreOrderRequest $request)
    {
        $request->validated();
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

    public function storeOne(StoreOneOrderRequest $request){
        $request->validated();
        $user_id=auth()->user()->id;
        $book_id=$request->book_id;
        $status=Order::where('user_id',$user_id)->where('book_id',$book_id)->first();
        if($status){
            return response([
                'message' =>'You have already placed an order'
            ]);
        }else {
            Order::create([
                'book_id' =>$book_id,
                'user_id' =>$user_id
            ]);
            return response([
                'message' =>'order completed successfully'
            ]);
        }
    }

    public function update($id)
    {
        $orders=Order::find($id);
        if($orders){
            $orders->update([
                'status'=>true,
                'admin_id'=>auth()->user()->id
            ]);
            return response([
            'message'=>"updated"
            ]);
        }else {
            return response([
                'message'=>'id not found'
            ]);
        }
    }

   
    public function destroy($id)
    {
        Order::where('user_id',$id)->where('status',false)->delete();
        return response([
            'message'=>"deleted"
         ]);
    }
}
