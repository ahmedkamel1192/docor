<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','type'
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
}
