<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request){
        $image=$request->image;
        $name=$image->getClientOriginalName();
        $image->storeAs('public/images',$name);
        $image_save=new Image;
        $image_save->url=$name;
        $image_save->save();
        return 'created';
    }
}
