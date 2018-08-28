<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\DoctorsDataTable;
use App\User;


class DoctorsController extends Controller
{
    public function index()
    {
        $doctors = new DoctorsDataTable();
        return $doctors->render('Admin.index');
    }
    public function verify($doctor_id)
    {
      $doctor = User::find($doctor_id);
      if ( $doctor->is_verified == false)
      $doctor->is_verified = true;
      else
      $doctor->is_verified = false;
      $doctor->save();
      //return back();
    }
    public function invalidate($doctor_id)
    {
      $doctor = User::find($doctor_id);
      $doctor->is_verified = false;
      $doctor->save();
      return back();
    }
    
}
