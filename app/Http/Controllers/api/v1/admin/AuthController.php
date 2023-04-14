<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CheckUserRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserRoleResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserStoreRequest $request){

        $request->validated();

        $user=User::create([
            'name' =>$request->name,
            'phone' =>$request->phone,
            'password' =>Hash::make($request->password)
        ]);
        $user->assignRole('user');
        $tokenResult = $user->createToken('token')->plainTextToken;
        return response()->json([
            'message' =>'Registration successful',
            'data' =>[
                'user'=>new UserResource($user),
                'token'=>$tokenResult
            ],
            
        ],200);
    }
    public function login(CheckUserRequest $request){
        $input = $request -> validated();
        if(!Auth::attempt($input))
        {
            return response()->json(['message' => 'Unauthorized!'], 401);
        }
        $tokenResult = $request->user()->createToken('token')->plainTextToken;
        return response()->json([
            'message'=>'login successful',
            'data' => [
                'user' => new UserResource(Auth::user()),
                'token' => $tokenResult
        ]]); 
    } 
    public function check(Request $request)
    {
     
        return response([
            'message' => 'success',
            'data'=>new UserResource($request->user())
        ]);
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()-> where('id', $request->token_id)->delete();
        return response()->json(['message' => 'you are successfully logout']);
    }
}
