<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use JWTFactory;
use JWTAuth;
use App\User;
use Illuminate\Support\Facades\Auth;

class APILoginController extends Controller
{
    public function login(Request $request)
{
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 200);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 200);
        }
        //if($request->type ='user' && )
        $email=$request->email;
        $type=$request->type;
       if(User::checkIfUserHasSameType($email,$type)>0) 
       {
        return response()->json(compact('token'));
       }
       else{
        return response()->json(['error' => 'invalid_credentials'], 200);
    }
    }
}