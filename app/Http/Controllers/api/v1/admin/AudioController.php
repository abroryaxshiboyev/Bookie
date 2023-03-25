<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audio\StoreAudioRequest;
use App\Http\Requests\Audio\UpdateAudioRequest;
use App\Http\Resources\Audio\OneAudioResource;
use App\Models\Audio;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function store(StoreAudioRequest $request){
        $result=$request->validated();
        if ($file = $request->file('audio')) {
            $folder=uniqid().'-'.now()->timestamp.uniqid().rand();
            $name = $folder.time() . $file->getClientOriginalName();
            $file->storeAs('public/audios/', $name);
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
                $file->storeAs('public/audios/', $name);
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
