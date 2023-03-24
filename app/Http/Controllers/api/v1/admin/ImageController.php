<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function store(Request $request){
        // if($request->hasFile('avatar')){
        //     $file=$request->file('avatar');
        //     $filename=$file->getClientOriginalName();
        //     $folder=uniqid().'-'.now()->timestamp;
        //     $file->storeAs('avatars/'.$folder,$filename);
            
        //     Image::create([
        //         'filename' => $filename,
        //         'folder' => $folder
        //     ]);
        // }
        // return 'err';

        $user = Auth::user();
        if(isset($request->book_id))
            $user=Book::find($request->book_id);
        if ($file = $request->file('photo_id')) {
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
