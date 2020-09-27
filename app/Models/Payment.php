<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $casts = [
        'is_paid'=> 'boolean',
        'extra_details'=>'json'
    ];
}
