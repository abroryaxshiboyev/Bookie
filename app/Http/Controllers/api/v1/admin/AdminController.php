<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function store(Request $request){
        $user=User::find($request->user_id);
        $user->assignRole('admin');
        $user->removeRole('user');
        return response([
            'message' => 'admin created successfully',
            'data' => new UserResource($user)
        ]);
    }
    public function destroy($id){
        $user=User::find($id);
        $user->assignRole('user');
        $user->removeRole('admin');
        return response([
            'message' => 'admin created successfully',
            'data' => new UserResource($user)
        ]);
    }
}
