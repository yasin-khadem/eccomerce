<?php

namespace App\Http\Controllers\Purchased;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchasedCollection;
use App\Models\purchased;


class PurchasedController extends Controller
{
    public function getPurchased()
    {
        $user = request()->user();
        return new PurchasedCollection(purchased::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15));
    }
}
