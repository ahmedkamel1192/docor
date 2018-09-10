<?php

namespace App\Http\Controllers\Api;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ADDToFavouriteController extends Controller
{
    public function add_to_favourite(Request $request)
    {

          $current_user = auth()->user();
        //  return $current_user;

         if (!$current_user->has_same_doctor($request->get('doctor_id')))
        {
            $current_user->doctors()->attach($request->get('doctor_id'));   // add friend

            return response()->json(['message'=>'true'],200);
        }else
             return response()->json(['messgae'=>'false']);
    }
    public function remove_from_favourite(Request $request)
    {

          $current_user = auth()->user();
        //  return $current_user;

         
        
            $current_user->doctors()->detach($request->get('doctor_id'));   // add friend

            return response()->json(['message'=>'true'],200);
       
    }
    public function favourites()
    {
        $current_user = auth()->user();
       $favourites =  $current_user->doctors;
       return response()->json(['message'=>'true','data' => $favourites], 200);


    }

}
