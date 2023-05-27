<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\StoreDiscountRequest;
use App\Http\Requests\Discount\UpdateDiscountRequest;
use App\Http\Resources\Discount\DiskbookResource;
use App\Http\Resources\Discount\OneDiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    
    public function index(Request $request){
        $discount=Discount::paginate($request->input('limit'));
        return response([
            'message' => 'all discount',
            'data' => OneDiscountResource::collection($discount)
        ]);
    }
    
    public function show($id,Request $request){
        $discount=Discount::find($id);
        if(isset($discount)){
            $books=$discount->books()->paginate($request->input('limit'));
            return response([
                'message' => 'one discount',
                'data' =>[
                    'id'=>$discount->id,
                    'name'=>$discount->name,
                    'amount'=>$discount->amount,
                    'books'=>DiskbookResource::collection($books)
                ],
                'total'=>$books->total()
            ]);
        }
    }

    public function store(StoreDiscountRequest $request){
        $discount=Discount::create($request->validated());
        $b=false;
        if ($file = $request->file('image')) {
            $name = time() . $file->getClientOriginalName();
            $request->image->move(public_path('/images'),$name);
            $b=true; 
        }
        $result=$request->validated();
        $discount=Discount::create($result);
        $discount=Discount::find($discount->id);
        if($b)
            $discount->photo()->create([
                'file'=>$name,
            ]);
        return response([
            'message' => 'discount created successfully',
            'data'=>new OneDiscountResource($discount)
        ]);

    }

    public function update(UpdateDiscountRequest $request,$id){
        $result=$request->validated();
        $discount=Discount::find($id);
        if($discount){
            $b=false;
            if ($file = $request->file('image')) {
                $name = time() . $file->getClientOriginalName();
                // $file->storeAs('public/images/', $name);
                $request->image->move(public_path('/images'),$name);

                $b=true;
            }
            $result=$request->validated();
            if(isset($discount->photo) && $b)
            {
                // Storage::delete("public/images/".$book->photo->file);
                unlink('images/'.$discount->photo->file);
                $discount->photo()->delete();
                $discount->photo()->create([
                    'file'=>$name,
                ]);
            }
            $discount->update($result);
            return response([
                'message' => 'discount update successfully',
            ]);
        }else {
            return response([
                'message' => 'id not found',
            ],404);  
        }

    }

    public function destroy($id){
        $discount=Discount::find($id);
        if($discount)
        {
            $discount->delete();
            return response([
                'message' =>'deleted'
            ]);
        }else {
            return response([
                'message' =>'id not found'
            ],404);
        }

    }
}
