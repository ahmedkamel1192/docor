<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bodunde\GoogleGeocoder\Geocoder;
use App\User;

class LocationController extends Controller
{
    public function updateLocation(Geocoder $geocoder)
    {
        $current_user = auth()->user();
        $current_user->longitude=request('longitude');
        $current_user->latitude=request('latitude');
        $current_user->save();
        $this->calcDistance(1.555,5.3333,9.5555,120.222);


    }

    public function getNearestDoctorsWithCategory()
    {

        $doctors = User::where('type','doctor')->where('category_id',request('category_id'))->get();
        $array_of_doctors=[];
        if( $doctors->count() >0) {
            foreach ($doctors as $doctor) {
                $array_of_doctors[$doctor->id] = $this->calcDistance(request('src_lat'), request('src_lng'), $doctor->latitude, $doctor->longitude);
            }
            //dd($array_of_doctors);
            $id_of_nearst_doctor = array_keys($array_of_doctors, min($array_of_doctors))[0];
            $nearst_doctor = User::find($id_of_nearst_doctor);

            return ($nearst_doctor);
        }else{ return 'there are no doctor for your request';}
    }
    private function calcDistance($src_lat,$src_lng,$doc_lat,$doc_lng) {

        $geocoder = new Geocoder;

        $location1 = [
            "lat" => $src_lat,
            "lng" => $src_lng
        ];

        $location2 = [
            "lat" => $doc_lat,
            "lng" => $doc_lng
        ];
        $distance = $geocoder->getDistanceBetween($location1, $location2);
        return ($distance);

    }
}
