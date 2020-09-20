<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['slug', 'exist','image'];
    protected $appends = ['is_exist'];
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
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function syncCategories(array $categories){
        $this->categories()->sync(
            array_filter(collect($categories)->pluck('key')->toArray())
        );
    }
    public function getIsExistAttribute(){
        return $this->exist ? "موجود" 
        : "ناموجود";
    }
}
