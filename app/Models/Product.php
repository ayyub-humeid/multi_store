<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    // protected $fillable = [

    // ]
    protected static function booted()
    {
        // in controller we don't need call this function
        // with glople scope this always will implement
        static::addGlobalScope('store',function(Builder $builder){
            $user = Auth::user();
            if($user->store_id){
            $builder->where('store_id',$user->store_id);

            }
        });
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }

}
