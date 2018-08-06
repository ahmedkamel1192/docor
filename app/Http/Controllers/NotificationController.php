<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

     public function sendNotification()
     {
         dd(request('deviceToken'));
         PushNotification::app('superDoctorAndroid')
             ->to(request('deviceToken'))
             ->send('Hello World, i`m a push message');
     }
}
