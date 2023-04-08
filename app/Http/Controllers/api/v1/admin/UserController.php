<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
