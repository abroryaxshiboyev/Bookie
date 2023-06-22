<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOneOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\Order\OneOrderResource;
use App\Http\Resources\Order\UserOrderResource;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Utils\Paginate;

class OrderController extends Controller
{
    public function user_orders(Request $request)
    {
        $user = auth()->user();
        $orders=Order::where('user_id',$user->id)->where('status',false)->get();
        $purchased=Order::where('user_id',$user->id)->where('status',true)->get();
        return response([
            'message' => 'all orders',
            'data' => [
                'orders' => UserOrderResource::collection($orders),
                'purchased' => UserOrderResource::collection($purchased)
            ]
                ,
            'total'=>$orders->total()
        ]);
    }
    public function index(Request $request)
    {
        $order=Order::orderBy('status','asc')->orderBy('id','asc')->paginate($request->input('limit'));
        // $order1=Order::where('status',0)->get();
        // $order2=Order::where('status',1)->orderBy('id','desc')->get();
        // $userAndAssociate = $order1->merge($order2);
        // $orders=Paginate::paginate($userAndAssociate,$request->input('limit'));
        return response([
            'message' => 'all orders',
            'data' => OneOrderResource::collection($order),
            'total'=>$order->total()
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
        $order=Order::find($id);
        if(isset($order)) {
            $order->delete();
            return response([
                'message'=>"deleted"
            ]);
        }else {
            return response([
                'message'=>"id not found"
            ],404);
        }
    }
}
