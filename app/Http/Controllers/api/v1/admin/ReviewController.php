<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Resources\Review\BookCommentsResource;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request){
        $result=$request->validated();
        $user_id=auth()->user()->id;
        $result['user_id']=$user_id;
        $book_id=$request->book_id;
        // $book=Order::where('user_id',$user_id)->where('book_id',$book_id)->get();
        // if(count($book))
        //     $status=$book[0]['status'];
        // else
        //     $status=false;
        // if($status)
        // {
            // $review=Review::where('user_id',$user_id)->where('book_id',$book_id)->get();
            // if(!count($review))
            // {
                $review=Review::create($result);
                $reviews=Review::where('book_id',$book_id)->select('rating')->get();
                $summa=0;
                $k=0;
                foreach ($reviews as $value) {
                    $summa+=$value->rating;
                    $k++;
                }
                Book::find($book_id)->update([
                    'rating'=>$summa/$k
                ]);
                return response([
                    'message' =>'review created successfully',
                ]);
            // }
            // else {
            //     return response([
            //         'message' =>'you already commented',
            //     ]);
            // }
        // }
        // else {
        //     return response([
        //         'message' =>'You have not purchased this book',
        //     ]);   
        // }
    }

    public function index(Request $request,$id){
        $book=Book::find($id);
        if(isset($book)){
            $comments=Review::orderBy('id','desc')->where('book_id',$id)->paginate($request->input('limit'));
            return response([
                'message'=>'all book comments',
                'data'=>BookCommentsResource::collection($comments)
            ]);
        }else{
            return response([
                'message'=>'id not found',
            ],404);
        }
    }
}
