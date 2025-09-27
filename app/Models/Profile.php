<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country',
        'local',

    ];
    protected $primaryKey='user_id';
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}