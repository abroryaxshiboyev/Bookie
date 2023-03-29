<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request){
        $result=$request->validated();
        $user_id=auth()->user()->id;
        $result['user_id']=$user_id;
        $review=Review::create($result);
        return response([
            'message' =>'review created successfully',
        ]);
    }
}
