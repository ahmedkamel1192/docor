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
        $current_user->is_online= true;
        $current_user->save();
    }
    public function beOffLine()
    {
        $current_user = auth()->user();
        $current_user->is_online = false ;
        $current_user->save();
    }

    public function allVerifiedAndNonBlockedDoctors()
    {
        $all_doctors = User::allVerifiedAndNonBlockedDoctors(request('category_id'));
        return response()->json(['message'=>'true','data' => $all_doctors], 200);
     }
     public function allComletedEvents()
     {
       $current_user=auth()->user();
       $id=$current_user->id;
       if($current_user->type == doctor)
       $comleted_events=Event::where([['doctor_id','=',$id],['status','=','mission completed']])->get();
       else{
        $comleted_events=Event::where([['patient_id','=',$id],['status','=','mission completed']])->get();
          }
       return response()->json(['message'=>'true','data' => $comleted_events], 200);

     }
   
   
}
