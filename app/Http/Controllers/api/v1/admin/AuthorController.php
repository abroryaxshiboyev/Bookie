<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\Author\AllAuthorResource;
use App\Http\Resources\Author\OneAuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
  
    public function index(Request $request)
    {
        $dubauthor=Author::paginate($request->input('limit'));
        return response([
            'message'=>"all Authors",
            'data'=>AllAuthorResource::collection($dubauthor),
            'total'=>$dubauthor->total()
        ]);
    }

    
    public function store(StoreAuthorRequest $request)
    {
        $author=Author::create($request->validated());

        return response([
            'message'=>"created Author",
            'data'=>new AllAuthorResource($author)
        ], 201);

    }

    
    public function show($id,Request $request)
    {
        $author=Author::find($id);
        if(isset($author))
        {
            $count = $author->books();
            $author->setRelation(
                'books',
                $count->orderBy('id')->paginate($request->input('limit'))
            );
            return response([
                'message'=>'one Author',
                'data'=>new OneAuthorResource($author),
                'total'=>$author->total()
            ]);
        }
        else {
            return response([
                'message'=>'id not found'
            ],404);
        }
    }

  
    public function update(UpdateAuthorRequest $request, $id)
    {
        $category=Author::find($id);
        if ($category) {
            $category->update($request->validated());
            $category=Author::find($id);
            return response([
                'message'=>'Author updated succsesfull',
                'data'=>new AllAuthorResource($category)
            ]);
        } else {
            return response([
               'message'=>'id not found'
            ],404);
        }
    }

   
    public function destroy($id)
    {
        $dubauthor=Author::find($id);
        if($dubauthor)
        {
            $dubauthor->delete();
            return response([
               'message'=>'author deleted'
            ]);
        }
        else {
            return response([
               'message'=>'id not found'
            ],404);
        }
    }
}
