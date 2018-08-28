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

            return response()->json(['message'=>' added to favourite successfully','all_favourite'=>$current_user->doctors()->get()]);
        }else
             return response()->json(['messgae'=>'you have already added this doctor to favourite']);
    }
    public function favourites()
    {
        $current_user = auth()->user();
       $favourites =  $current_user->doctors();
       return response()->json(['favourites doctors' => $favourites], 200);


    }

}
