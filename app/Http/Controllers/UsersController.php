<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\User;
class UsersController extends Controller
{
    public function index()
    {
        $users = new UsersDataTable();
        return $users->render('Admin.index');
    }
   
    public function destroy($id)
    {
      if($id != 1)
        {
            $user= User::find($id);
            $user->delete();
        }else{
            return  response()->json(['errors' => "you can't remove admin" ]);
        }
    }

    public function block($id)
    {
      if($id != 1)
        {
            $user= User::find($id);
            if($user->is_blocked== false)
            $user->is_blocked=true;
            else
            $user->is_blocked=false;
            $user->save();
        }else{
            return  response()->json(['errors' => "you don't have access" ]);
        }
    }


    

}
