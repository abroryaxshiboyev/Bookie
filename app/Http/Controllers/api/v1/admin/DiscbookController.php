<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Discbook\StoreDiscbookRequest;
use App\Http\Requests\Discbook\UpdateDiscbookRequest;
use App\Models\Discbook;
use Illuminate\Http\Request;

class DiscbookController extends Controller
{
    public function store(StoreDiscbookRequest $request){
        $result=$request->validated();

        $discount=Discbook::where('discount_id',$request->discount_id)->where('book_id',$request->book_id)->first();
        if(!isset($discount)){
            Discbook::create($result);

            return response([
                'message' =>'discbook created successfully'
            ],201);

        }else {
            return response([
                'message' =>'this has already been added'
            ]);
        } 
    }
    public function update(UpdateDiscbookRequest $request,$id){
        $abs=Discbook::find($id);
        if(isset($abs)){
            $result=$request->validated();

            $discount=Discbook::where('discount_id',$request->discount_id)->where('book_id',$request->book_id)->first();
            
            if(!isset($discount)){
                $abs->update($result);

                return response([
                    'message' =>'discbook updated successfully'
                ]);

            }else {
                return response([
                    'message' =>'this has already been added'
                ]);
            } 
        }else {
            return response([
                'message' =>'id not found'
            ],404);
        }
    }

    public function destroy($id) {
        $discbook=Discbook::find($id);
        if (isset($discbook)) {
            $discbook->delete();
            return response([
                'message' =>'discbook deleted'
            ]);
        }else {
            return response([
                'message' =>'id not found'
            ]);
        }
    }
}
