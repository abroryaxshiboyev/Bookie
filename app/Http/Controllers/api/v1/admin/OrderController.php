<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Order\OneOrderResource;
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
        // if(isset($request->book_id))
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
