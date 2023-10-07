<?php

use Illuminate\Http\Request;
use App\Http\Controllers\dummyAPI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DiscussionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    // Posts
    Route::get("/data",[dummyAPI::class,'getData']);
    Route::get("/list/{id?}",[PostController::class,'list']);
    Route::post("/add",[PostController::class,'add']);
    Route::put("/update",[PostController::class,'update']);
    Route::get("/search/{name}", [PostController::class,'search']);
    Route::delete("/delete/{id}", [PostController::class,'delete']);
    Route::post("/upload",[FileController::class,'upload']);
    

    // Video
    Route::get("/list_video/{id?}",[VideoController::class,'list']);
    Route::post("/add_video",[VideoController::class,'add']);
    Route::put("/update_video",[VideoController::class,'update']);
    Route::post("/upload_video",[FileController::class,'video']);
    Route::get("/search_video/{caption}", [VideoController::class,'search']);
    Route::delete("/delete_video/{id}", [VideoController::class,'delete']);


    // Discussion
    Route::get("/list_discussion/{video_id}/{user_id}",[DiscussionController::class,'show']);
    Route::post("/add_discussion",[DiscussionController::class,'store']);

    
    // Route::apiResource("member", MemberController::class);
 });

// Auth
Route::post("/login",[UserController::class,'index']);
Route::post("/register",[UserController::class,'register']);
