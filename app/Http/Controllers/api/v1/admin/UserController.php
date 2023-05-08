<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreImageRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function allusers(Request $request){
        $allusers=User::with('roles')->whereHas('roles', function($query) {
            $query->where('name', 'user');
        })->paginate($request->input('limit'));

        return response([
            'message' => 'allusers',
            'data'=>UserResource::collection($allusers),
            'total'=>$allusers->total()
        ]);
    }
    // public function password_edit($id,Request $request){

    // }
    public function storeImage(StoreImageRequest $request){
        $user = Auth::user();
        
        if ($file = $request->file('image')) {
            $folder=uniqid().'-'.now()->timestamp.uniqid().rand();
            $name = $folder.time() . $file->getClientOriginalName();
            // $file->storeAs('public/images/', $name);
            $request->image->move(public_path('/images'),$name);  
            $user->photo()->create([
                'file'=>$name,
            ]);
            return response([
                'message' => 'created image successfully',
            ]);
        }else {
            return response([
                'message' => 'image not found',
            ],422);
        }
        
    }

    public function update(UpdateUserRequest $request)
    {
        $user=auth()->user();
        $b=false;
        if ($file = $request->file('image')) {
            $folder=uniqid().'-'.now()->timestamp.uniqid().rand();
            $name = $folder.time() . $file->getClientOriginalName();
            // $file->storeAs('public/images/',$name);
            $request->image->move(public_path('/images'),$name);
            $b=true;
        }
        $result=$request->validated();
        if($user->photo)
        {
            // Storage::delete("public/images/".$user->photo->file);
            unlink("images/".$user->photo->file);
            $user->photo()->delete();
        }
        if($b){
            $user->photo()->create([
                'file'=>$name,
            ]);
        }
        if(isset($request->name)){
            $user->update([
                'name'=>$request->name
            ]);
        }

        return response([
            'message' =>'user updated successfully',
            'data' =>new UserResource($user)
        ]);
    }
}
