<?php

use App\Http\Controllers\CategoryApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/categories',CategoryApiController::class);

Route::post('/login',function(){
    $email = request()->email;
    $password = request()->password;

    if(!$email or !$password){
        return response(['msg'=>'email and password required'],403);
    }

    $user = User::where('email',$email)->first();
    // return $user;
    if($user){
        if(password_verify($password,$user->password)){
            return $user->createToken('api')->plainTextToken;
        }
    }
    return response(['msg'=> 'incorrect email and password'], 403);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
