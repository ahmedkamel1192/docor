<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class ADDToFavouriteController extends Controller
{
    public function add_to_favourite(Request $request)
    {

          $current_user = User::find(1);

         if (!$current_user->has_same_doctor($request->get('doctor_id')))
        {
            $current_user->doctors()->attach($request->get('doctor_id'));   // add friend

            return response()->json(['message'=>' added to favourite successfully','all_favourite'=>$current_user->doctors()->get()]);
        }else
             return response()->json(['messgae'=>'you have already added this doctor to favourite']);
    }

}
