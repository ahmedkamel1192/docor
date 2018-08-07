<?php

namespace App\Http\Controllers;
//use Davibennun\LaravelPushNotification\PushNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

     public function sendNotification()
     {
         $device_token = request('deviceToken');

         \PushNotification::app('superDoctorAndroid')
             ->to($device_token)
             ->send('Hello World, i`m a push message');
     }
}
