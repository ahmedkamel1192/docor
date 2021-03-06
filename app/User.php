<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\Category;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','type','category_id','logitude','latitude'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function doctors()
    {
        return $this->belongsToMany('\App\User', 'doctor_user', 'user_id', 'doctor_id');
    }
    public function has_same_doctor($doctor_id)
    {
        return $this->doctors()->where('doctor_id', $doctor_id)->exists();
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function rating()
    {
        return $this->belongsToMany('\App\User', 'rating', 'user_id', 'doctor_id')->withPivot('rate');

    }
    static function allVerifiedAndNonBlockedDoctors($category_id)
    {
        # code...
        return User::where([['type','=','doctor'],['category_id','=',$category_id],['is_verified','=',1],['is_blocked','=',0],['is_online','=',1],['is_busy','=',0]])->get();

    }
    static function checkIfUserHasSameType($email,$type)
    {
       return User::where([['email','=',$email],['type','=',$type]])->count();
    }

}
