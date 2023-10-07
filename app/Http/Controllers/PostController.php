<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    public function list($id=null){
        if($id !=null){

            $post= Post::find($id);
        }
        $post= Post::all();
        foreach($post as $p){
            $p->user;
        }
        return $post;
    }
    
    public function add(Request $req){
      
        $post = new Post;
        

        $post->photo_path=$req->photo_path;
        $post->caption=$req->caption;
        $post->user_id=$req->user_id;
        $post->is_donation = $req->is_donation;
        $post->donation_amount = $req->donation_amount;

        $rules = array(
            'caption' => 'required|min:10|max:100',
            'photo_path' => 'required',
            'user_id' => 'required',
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        $result=$post->save();

        if($result){

            return response()->json(["Result"=>"Data has been saved"], 200);
        }else{
            return response()->json(["Result"=>"Operation failed"], 500 );
        }
    }

    public function update(Request $req){
        $post = Post::find($req->id);
       
        $post->caption=$req->caption;
        $post->user_id=$req->user_id;
        $post->is_donation = $req->is_donation;
        $post->donation_amount = $req->donation_amount;

      
        $result=$post->save();
        if($result){
            return response()->json(["Result"=>"Data has been updated"], 200);
        }
        else{
            return response()->json(["Result"=>"Operation failed"], 500 );
        }
    }
    public function search($name){
        $result= Post::where("caption", "like", "%".$name."%")->get();
        foreach($result as $p){
            $p->user;
        }
        
        if($result->isEmpty()){
            return response()->json(["Result"=>"Data not found"], 404);
        }
        return response()->json($result, 200);

    }
    public function delete($id){
        $post = Post::find($id);
        if($post==null){
            return response()->json(["Result"=>"Data not found"], 404);
        }
        $result=$post->delete();
        if($result){
            return response()->json(["Result"=>"Data has been deleted"], 200);
        }
        else{
            return response()->json(["Result"=>"Operation failed"], 500 );
        }
    }


}
