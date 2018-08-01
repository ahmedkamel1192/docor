<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RatesController extends Controller
{

    //note we can use $request or helper funcion request()
    public function addRate(Request $request)
    {
        $current_user = auth()->user();
        $current_user->rating()->attach($request->get('doctor_id'), ['rate' => $request->get('rate')]);
    }
    public function getTotalRate()
    {
        $totalRate = DB::table('rating')->where('doctor_id', request('doctor_id'))->avg('rate');
        return $totalRate;
    }
}
