<?php

namespace App\Models;

use App\Rules\FilterNames;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name','parent_id','description','image','status','slug'
    ];

    public static function rules($id=0){
        return
        [
             'name'=> ['required','string','min:3','max:255',
             Rule::unique('categories','name')->ignore($id),
            //  function($attribute,$value,$fails){
            //     if(strtolower($value)=='laravel'){
            //         $fails('This name is forbidden');
            //     }
            //  }
             new FilterNames(['php','laravel','admin','html'])
             ]
             ,
            'parent_id'=>'nullable|integer|exists:categories,id',
            'image'=> 'image|max:1048576|dimensions:min-width=100,max-width=100',
            'status'=>'required|in:active,archived'
        ];

    }

    public function scopeActive(Builder $builder){
        $builder->where('status','active');
    }
    public function getParentAttribute($id){
        $parent = $this->where('parent_id',$id);
    }
    public function scopeFilters(Builder $builder,$filters){
          $builder->when($filters['name']??false,function(Builder $builder,$value)  {
            $builder->where('categories.name','LIKE',"%{$value}%");
            });

        $builder->when($filters['status'] ??false ,function(Builder $builder,$value)  {
            $builder->where('categories.status',$value);
        });

        // if($filters['name']?? false){
        //     $builder->where('name','LIKE',"%{$filters['name']}%");
        // }
        // if($filters['status'] ?? false){
        //     $builder->where('status',$filters['status']);
        // }
    }
    public function categoryParent(){
        return $this->belongsTo(Category::class,'parent_id','id')
        // ->withDefault(['name'=>'Main Category'])
        ;
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

}