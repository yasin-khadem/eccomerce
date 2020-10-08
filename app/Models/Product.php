<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Product extends Model
{
    use HasFactory;
    use Sluggable;



    protected $guarded = ['slug'];
    protected $appends = ['is_exist', 'selectedTags', 'image_src', 'url_path'];

    protected $SortingOptions = [
        'id' => 'id',
        'name' => 'name',
        'code' => 'code',
        'price' => 'price',
        'description' => 'description',
        'exist' => 'exist',
        'created_at' => 'created_at'
    ];
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
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function syncCategories(array $categories)
    {
        $this->categories()->sync(
            array_filter(collect($categories)->pluck('key')->toArray())
        );
    }


    public function scopeSortByUrl(Builder $builder)
    {
        $sortBy = $this->SortingOptions[request()->sortBy] ?? 'id';
        $sortDir = request()->sortDir === 'desc' ? 'desc' : 'asc';
        $builder->orderBy($sortBy, $sortDir);
    }

    public function scopeSearchByUrl(Builder $builder)
    {
        if (request()->search) {
            $builder->where('name', 'LIKE', '%' . request()->search . '%')
                ->orWhere('description', 'LIKE', '%' . request()->search . '%')
                ->orWhere('code', request()->search);
        }
        return $builder;
    }


    public function getIsExistAttribute()
    {
        return $this->exist ? "موجود"
            : "ناموجود";
    }
    public function getSelectedTagsAttribute()
    {
        return $this->categories->map(function ($item, $key) {
            return ['key' => $item->id, 'value' => $item->name];
        });
    }
    public function getImageSrcAttribute()
    {
        return 'images/' . $this->image;
    }
    public function getRelatedProductsAttribute(): Collection
    {
        return $this->where('id', '!=', $this->id)->orderBy('exist', 'desc')->whereHas('categories', function ($query) {
            return $query->whereIn('categories.id', $this->categories->pluck('id')->toArray());
        })->inRandomOrder()->limit(3)->get();
    }
    public function getUrlPathAttribute()
    {
        return url("product/show/{$this->slug}");
    }
}
