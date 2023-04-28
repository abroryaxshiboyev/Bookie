<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DubAuthor\StoreDubAuthorRequest;
use App\Http\Requests\DubAuthor\UpdateDubAuthorRequest;
use App\Http\Resources\DubAuthor\OneDubAuthorResource;
use App\Models\Dubauthor;
use Illuminate\Http\Request;

class DubAuthorController extends Controller
{
   
    public function index(Request $r)
    {
        $dubauthor=Dubauthor::paginate($r->input('limit'));
        return response([
            'message'=>"all DubAuthors",
            'data'=>OneDubAuthorResource::collection($dubauthor)
        ]);
    }

   
    public function store(StoreDubAuthorRequest $request)
    {
        $book=Dubauthor::create($request->validated());
        return response([
            'message'=>"created DubAuthor",
            'data'=>new OneDubAuthorResource($book)
        ], 201);
    }

    
    public function show($id)
    {
        $dubauthor=Dubauthor::find($id);
        if(isset($dubauthor))
        {
            return response([
                'message'=>'one DubAuthor',
                'data'=>new OneDubAuthorResource($dubauthor)
            ]);
        }
        else {
            return response([
                'message'=>'id not found'
            ],404);
        }
    }

   
    public function update(UpdateDubAuthorRequest $request, $id)
    {
        $category=Dubauthor::find($id);
        if ($category) {
            $category->update($request->validated());
            $category=Dubauthor::find($id);
            return response([
                'message'=>'DubAuthor updated succsesfull',
                'data'=>new OneDubAuthorResource($category)
            ]);
        } else {
            return response([
               'message'=>'id not found'
            ],404);
        }
    }

   
    public function destroy($id)
    {
        $dubauthor=Dubauthor::find($id);
        if($dubauthor)
        {
            $dubauthor->delete();
            return response([
               'message'=>'dubauthor deleted'
            ]);
        }
        else {
            return response([
               'message'=>'id not found'
            ],404);
        }
    }
}
