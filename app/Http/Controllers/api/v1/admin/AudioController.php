<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audio\StoreAudioRequest;
use App\Http\Requests\Audio\UpdateAudioRequest;
use App\Http\Resources\Audio\BookAudioResource;
use App\Http\Resources\Audio\OneAudioResource;
use App\Models\Audio;
use App\Models\Book;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class AudioController extends Controller
{
    public function book_audios($id,Request $request){
        $book=Book::find($id);

        if(isset($book)){
            $audios = $book->audios();
            $count=$audios->count();
            $book->setRelation(
                'audios',
                $audios->orderBy('id')->paginate($request->input('limit'))
            );
            return response([
                'message'=>"audio books",
                'data'=>new BookAudioResource($book),
                'total'=>$count
            ]);
        }
    }
    public function store(StoreAudioRequest $request){
        $result=$request->validated();
        if ($file = $request->file('audio')) {
            $folder=uniqid().'-'.now()->timestamp.uniqid().rand();
            $name = $folder.time() . $file->getClientOriginalName();
            // $file->storeAs('public/audios/', $name);
            $request->audio->move(public_path('/audios'),$name);
        }
        $result['url']=$name;
        $audio=Audio::create($result);
        return response([
            'message' => 'audio created successfully',
            'data' => new OneAudioResource($audio)
        ],201);
    }

    public function update(UpdateAudioRequest $request,$id){
        $audio_=Audio::find($id);
        if(isset($audio_)){
            $result=$request->validated();
            $b=false;
            if ($file = $request->file('audio')) {
                $folder=uniqid().'-'.now()->timestamp.uniqid().rand();
                $name = $folder.time() . $file->getClientOriginalName();
                // $file->storeAs('public/audios/', $name);
                $request->audio->move(public_path('/audios'),$name);

                $b=true;
            }
            if($b)
                $result['url']=$name;
            $audio_->update($result);
            $audio=Audio::find($id);
            return response([
                'message' => 'audio created successfully',
                'data' => new OneAudioResource($audio)
            ]);
        }else {
            return response([
                'message' => 'id not found',
            ],404);
        }
    }

    public function destroy($id){
        $audio=Audio::find($id);
        if(isset($audio)){
            $audio->delete();
            return response([
                'message' => 'audio deleted successfully'
            ]);
        }else {
            return response([
                'message' => 'id not found'
            ],404);
        }
    }
}
