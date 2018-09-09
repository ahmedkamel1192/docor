<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Davibennun\LaravelPushNotification\PushNotification;
use Illuminate\Http\Request;
use App\User;
class NotificationController extends Controller
{

     public function requestDoctor()
     {

         $doctor_id = request('doctor_id');
         $doctor = User::find($doctor_id);

         $current_user = auth()->user();
         $message = PushNotification::Message('Message Text',array(
            'id_user' => $current_user->id,
            'name' => $current_user->name,
            
           
        ));
         \PushNotification::app('superDoctorAndroid')
             ->to($doctor->device_token)
             ->send($message);
             return response()->json(['message'=>'true','data' =>$doctor->device_token ], 200);

     }

     public function confirmTheRequest()
     {
        
     }
}
