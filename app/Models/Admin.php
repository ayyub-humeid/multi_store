<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory,Notifiable;
    protected $fillable = [
        'name','password','username','email','phone_number','is-super-admin','status'
    ];
    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id')->withDefault();
    }
}
