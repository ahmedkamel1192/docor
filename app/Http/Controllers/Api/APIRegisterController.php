<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;

class APIRegisterController extends Controller
{
    public function register(Request $request,$type)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'phone'=> 'required|unique:users',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {

           // $errors= $validator->errors();
          return  response()->json(['errors' => $validator->errors()]);
       }
      $user =  User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone'=> $request->get('phone'),
            'category_id'=>$request->get('category_id'),
            'type'=>$type,
            'password' => bcrypt($request->get('password')),
        ]);
        $token = JWTAuth::fromUser($user);

        return Response::json(compact('token'));
    }
}