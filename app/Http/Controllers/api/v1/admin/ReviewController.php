<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request){
        $result=$request->validated();
        $user_id=auth()->user()->id;
        $result['user_id']=$user_id;
        $book=Order::where('user_id',$user_id)->where('book_id',$request->book_id)->get();
        if(count($book))
            $status=$book[0]['status'];
        else
            $status=false;
        if($status)
        {
            $review=Review::where('user_id',$user_id)->where('book_id',$request->book_id)->get();
            if(!count($review))
            {
                Review::create($result);
                return response([
                    'message' =>'review created successfully',
                ]);
            }
            else {
                return response([
                    'message' =>'you already commented',
                ]);
            }
        }
        else {
            return response([
                'message' =>'You have not purchased this book',
            ]);   
        }
    }
}
