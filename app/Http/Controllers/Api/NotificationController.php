<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Davibennun\LaravelPushNotification\PushNotification;
use Illuminate\Http\Request;
use App\User;
use App\Event;
use Carbon\Carbon;

class NotificationController extends Controller
{

     public function requestDoctor()
     {

         $doctor_id = request('doctor_id');
         $doctor = User::find($doctor_id);
         $current_user = auth()->user(); //patient
         $event = new Event(); 
         $event->patient_name=$current_user->name;
         $event->patient_phone=$current_user->phone;
         $event->src_lat=request('src_lat');
         $event->src_long=request('src_lng');
        // $event->order_date=\Carbon::now();
         $event->status='waiting respond';
         $event->save();


         \PushNotification::app(['environment' => 'development',
         'apiKey'      => 'AIzaSyDIQz2FnSBEo7qaQXmYev_eSZ3pJWW3jHs',
         'service'     => 'gcm'])
             ->to($doctor->device_token)
             ->send(['patient_id'=>$current_user->id,'patient_name'=>$current_user->name,'src_lat'=>request('src_lat'),'src_lng'=>request('src_lng'),'patient_phone'=>$current_user->phone,'message'=>$current_user->name.' needs your help']);
           //  return response()->json(['message'=>'true','data' =>$doctor->device_token ], 200);

     }

     public function confirmTheRequest()
     {
        $current_user = auth()->user();  //doctor
        $patient_id = request('patient_id');
        $event = Event::where('patient_id','=', $patient_id)->orderBy('id', 'desc')->first();
        $event->doctor_name=$current_user->name;
        $event->doctor_phone=$current_user->phone;
        $event->status='doctor on his way';
        $event->save();
        $patient =User::find($patient_id);
        \PushNotification::app(['environment' => 'development',
         'apiKey'      => 'AIzaSyCbUVCjJ5jfoLH-BxCvwoisdYL2YRMkTf4',
         'service'     => 'gcm'])
        ->to($patient->device_token)
        ->send(['doctor_id'=>$current_user->id,'confirmation'=>true,'message'=>$current_user->name.' will come as soon as possible']);

     }
}
