<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

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
   
}
