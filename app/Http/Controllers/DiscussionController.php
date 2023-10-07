<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index(){
        return Discussion::all();
    }
    public function show($video_id){
        $discussionList= Discussion::where('video_id', $video_id)->get();
        foreach($discussionList as $discussion){
            $userName = User::where('id', $discussion->user_id)->first();

            $discussion->user_name = $userName->name;
        }
        return $discussionList;
    }
    public function store(Request $req){
        
        $discussion = new Discussion;
        $discussion->user_id = $req->user_id;
        $discussion->video_id = $req->video_id;
        $discussion->text = $req->text;
        
        $rules = array(
            'user_id' => 'required',
            'video_id' => 'required',
            'text' => 'required|min:5|max:100'
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        $result = $discussion->save();
        
        if($result){
            return response()->json(["Result"=>"Discussion has been saved"], 200);
        }else{
            return response()->json(["Result"=>"Operation failed"], 500 );
        }
    }
}
