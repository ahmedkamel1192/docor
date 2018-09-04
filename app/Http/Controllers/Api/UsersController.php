<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    //note we can use $request or helper funcion request()
    public function setDeviceToken(Request $request)
    {
        $current_user = auth()->user();
        $current_user->device_token = request('device_token');
        $current_user->save();
        return response()->json(['message' => 'deviceToken is saved successfully'], 200);


    }
    public function beOnLine()
    {
        $current_user = auth()->user();
        if($current_user->is_online == false)
        $current_user->is_online= true;
        else
        $current_user->is_lone = false ;
        $current_user->save();
    }

    public function allVerifiedAndNonBlockedDoctors()
    {
        $all_doctors = User::allVerifiedAndNonBlockedDoctors();
        return response()->json(['message'=>'true','data' => $all_doctors], 200);
     }
   
}
