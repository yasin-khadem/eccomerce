<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['status'];


    protected $casts = [
        'is_paid' => 'boolean',
        'extra_details' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function getStatusAttribute(){
        return $this->is_paid ? "پرداخت شده" 
        : "به مشکل خورده";
    }
    public function scopeSearchByUrl(Builder $builder){
        if(request()->search){
            $builder->where('ref_id', request()->search )
                ->orWhere('product_code', request()->search);
        }
        return $builder;
    }
}
