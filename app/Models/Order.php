<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function scopeSearchByUrl(Builder $builder)
    {
        if (request()->search) {
            $builder->where('post_code', request()->search)
                ->orWhere('product_name', 'LIKE', '%' . request()->search . '%')
                ->orWhere('product_code', request()->search);
        }
        return $builder;
    }
}
