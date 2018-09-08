<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

//use Davibennun\LaravelPushNotification\PushNotification;
use Illuminate\Http\Request;
use App\User;
class NotificationController extends Controller
{

     public function requestDoctor()
     {

         $doctor_id = request('doctor_id');
         $doctor = User::find($doctor_id);
         return response()->json(['message'=>'true','data' =>$doctor->device_token ], 200);

         $current_user = auth()->user();
         \PushNotification::app('superDoctorAndroid')
             ->to($doctor->device_token)
             ->send($current_user->name.' need your help');
     }
}
