<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function storeImage(Request $request){

        $user = Auth::user();
        
        if ($file = $request->file('image')) {
            $folder=uniqid().'-'.now()->timestamp.uniqid().rand();
            $name = $folder.time() . $file->getClientOriginalName();
            $file->storeAs('public/images/', $name);
            
        }
        $user->photo()->create([
            'file'=>$name,
        ]);
        return response([
            'message' => 'created image successfully',
        ]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user=auth()->user();
        $b=false;
        if ($file = $request->file('image')) {
            $folder=uniqid().'-'.now()->timestamp.uniqid().rand();
            $name = $folder.time() . $file->getClientOriginalName();
            $file->storeAs('public/images/',$name);
            $b=true;
        }
        $result=$request->validated();
        if($user->photo)
        {
            Storage::delete("public/images/".$user->photo->file);
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
