<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['gallery_src'];


    public function product()
    {   
        return $this->belongsTo(Product::class);
    }
    public function getGallerySrcAttribute()
    {
        return 'gallery/' . $this->image;
    }
    public function scopeSearchByUrl(Builder $builder){
        if(request()->search){
            $builder->where('product_code', request()->search );
        }
        return $builder;
    }
    
   
}
