<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Validator;

class VideoController extends Controller
{
    public function list($caption=null){
        if($id !=null){
            return Video::where("caption", "like", "%".$caption."%")->get();
        }
        return Video::all();
    }
    
    public function add(Request $req){
      
        $video = new Video();
        $video->user_id=$req->user_id;
        $video->video_path=$req->video_path;
        $video->caption=$req->caption;

        $rules = array(
            'user_id' => 'required',
            'video_path' => 'required',
            'caption' => 'required|min:5|max:100'
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        $result=$video->save();

        if($result){

            return response()->json(["Result"=>"Video has been saved"], 200);
        }else{
            return response()->json(["Result"=>"Operation failed"], 500 );
        }
    }

    public function update(Request $req){
        $video = Video::find($req->id);
        $video->caption=$req->caption;

      
        $result=$video->save();
        if($result){
            return response()->json(["Result"=>"Video has been updated"], 200);
        }
        else{
            return response()->json(["Result"=>"Operation failed"], 500 );
        }
    }
    public function search($caption){
        $result= Video::where("caption", "like", "%".$caption."%")->get();
        if($result->isEmpty()){
            return response()->json(["Result"=>"Video not found"], 404);
        }
        return response()->json($result, 200);

    }
    public function delete($id){
        $video = Video::find($id);
        if($video==null){
            return response()->json(["Result"=>"Data not found"], 404);
        }
        $result=$video->delete();
        if($result){
            return response()->json(["Result"=>"Data has been deleted"], 200);
        }
        else{
            return response()->json(["Result"=>"Operation failed"], 500 );
        }
    }

}
