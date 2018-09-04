<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
       // $this->calcDistance(1.555,5.3333,9.5555,120.222);


    }

    public function getNearestDoctorsWithCategory()
    {

        $doctors = User::allVerifiedAndNonBlockedDoctors();
        $array_of_doctors=[];
        if( $doctors->count() >0) {
            foreach ($doctors as $doctor) {
                $array_of_doctors[$doctor->id] = $this->calcDistance(request('src_lat'), request('src_lng'), $doctor->latitude, $doctor->longitude);
            }
            //dd($array_of_doctors);
            asort($array_of_doctors);
           // print_r($array_of_doctors);
          //  print_r(array_keys($array_of_doctors));
            $ids_of_nearest_doctors = array_keys($array_of_doctors);
           // print_r($ids_of_nearest_doctors);
           // print_r(array_keys($ids_of_nearest_doctors));
            $nearest_five_doctors_ids= array_slice($ids_of_nearest_doctors,0,3);
            //print_r($nearest_five_doctors);
            $nearst_doctors=[];
            foreach ($nearest_five_doctors_ids as $doctor_id)
            {
                $nearst_doctors[] = User::find($doctor_id)->with('category')->get();
            }

           // $id_of_nearst_doctor = array_keys($array_of_doctors, min($array_of_doctors))[0];
           // $nearst_doctor = User::find($id_of_nearst_doctor);

           // return ($nearst_doctors);
            return response()->json(['message'=>'true','data' => $nearst_doctors], 200);

        }else{ return response()->json(['message'=>'false','data'=>'there are no result'], 200);}
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
