<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index(){
        return Discussion::all();
    }
    public function show($video_id, $user_id){
        return Discussion::where('video_id', $video_id)->where('user_id', $user_id)->get();
    }
    public function store(Request $req){
        $discussion = new Discussion;
        $discussion->user_id = $req->user_id;
        $discussion->video_id = $req->video_id;
        $discussion->text = $req->text;
        $result = $discussion->save();
        if($result){
            return response()->json(["Result"=>"Discussion has been saved"], 200);
        }else{
            return response()->json(["Result"=>"Operation failed"], 500 );
        }
    }
}
