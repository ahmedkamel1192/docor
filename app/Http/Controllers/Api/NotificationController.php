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

         $current_user = auth()->user();
         \PushNotification::app('superDoctorAndroid')
             ->to($doctor->device_token)
             ->send($current_user->name.' need your help');
     }
}
