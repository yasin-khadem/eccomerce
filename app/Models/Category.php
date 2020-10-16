<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Category extends Model
{
    use Sluggable;
    protected $fillable = ['name'];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function scopeSearchFromUrl(Builder $builder){
        if (request()->search) {
            $builder->where('name', 'LIKE', '%' . request()->search . '%');
        }
        return $builder;
    }
}
