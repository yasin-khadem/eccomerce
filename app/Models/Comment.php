<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ['reply_comments.user'];
    public function user(){
        return  $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function reply_comments(){
        return $this->hasMany(Comment::class)->whereIsConfirmed(true);
    }
}
