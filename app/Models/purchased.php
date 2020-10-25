<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchased extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['display_code'];
    public function getDisplayCodeAttribute()
    {
        $code = $this->product_code . "";
        for ($i = 0; $i < 4 - strlen($code); $i++) {
            $code = "0" . $code;
            return $code;
        }
    }

}
