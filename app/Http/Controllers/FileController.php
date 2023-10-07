<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    function upload(Request $req){
        $result =  $req->file('file')->store('apiDocs/photos');
        return ["Result"=>$result];
    }
    function video(Request $req){
        $result =  $req->file('file')->store('apiDocs/videos');
        return ["Result"=>$result];
    }
}
