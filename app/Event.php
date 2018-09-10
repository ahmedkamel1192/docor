<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=['patient_id','doctor_id','patient_name','doctor_name','doctor_phone','patient_phone','src_lat','src_long','dist_lat','dist_long','status','order_date'];

}
