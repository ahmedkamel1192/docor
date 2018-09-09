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
            'badge' => 1,
            'sound' => 'example.aiff',
            
            'actionLocKey' => 'Action button title!',
            'locKey' => 'localized key',
            'locArgs' => array(
                'localized args',
                'localized args',
            ),
            'launchImage' => 'image.jpg',
            
            'custom' => array('custom data' => array(
                'we' => 'want', 'send to app'
            ))
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
