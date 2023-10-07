<?php

use Illuminate\Http\Request;
use App\Http\Controllers\dummyAPI;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\FileController;
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

    
    // Route::apiResource("member", MemberController::class);
 });


Route::post("/login",[UserController::class,'index']);
Route::post("/register",[UserController::class,'register']);
