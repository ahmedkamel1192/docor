<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function updateLocation()
    {
        $current_user = auth()->user();
        $current_user->longitude=request('longitude');
        $current_user->latitude=request('latitude');
        $current_user->save();

    }
}
