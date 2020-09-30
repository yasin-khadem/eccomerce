<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['slug'];
    protected $appends = ['is_delivered'];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'product_name'
            ]
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getIsDeliveredAttribute()
    {
        return $this->delivered ? 'ارسال شده' 
        : 'در انتظار';
    }
}
