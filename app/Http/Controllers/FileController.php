<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    function upload(Request $req){
        if(!$req->hasFile('file')){
            return response()->json(["Result"=>"No file uploaded"], 400);
        }

        // fetch file
        $file = $req->file('file');
        // get file extension
        $extension = $file->getClientOriginalExtension();
        // filename to store
        $filename = time().'.'.$extension;
        // upload file
        $file->move('apiDocs/photos', $filename);
     $filename = 'apiDocs/photos/'.$filename;
        return ["Result"=>asset($filename)];
    }
    function video(Request $req){
        if(!$req->hasFile('file')){
            return response()->json(["Result"=>"No file uploaded"], 400);
        }
        $result =  $req->file('file')->store('apiDocs/videos');

        // fetch file
        $file = $req->file('file');
        // get file extension
        $extension = $file->getClientOriginalExtension();
        // filename to store
        $filename = time().'.'.$extension;
        // upload file
        $file->move('apiDocs/videos', $filename);
        $filename = 'apiDocs/videos/'.$filename;
        
        return ["Result"=>asset($filename)];
    }
}
