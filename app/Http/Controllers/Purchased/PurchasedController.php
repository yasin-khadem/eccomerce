<?php

namespace App\Http\Controllers\Purchased;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\PurchasedCollection;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PurchasedController extends Controller
{
    // protected $user;
    // public function __construct()
    // {
    //     $this->user = request()->user();
    // }
    // public function getOrder()
    // {
    //     return new OrderCollection(Order::where('user_id',$this->user->id)->all());
    // }
    // public function getProduct()
    // {

    // }
    public function getPurchased(){
        $user = request()->user(); 
        $orders =  Order::where('user_id', $user->id)->get();
        $payments = Payment::where('user_id', $user->id)->get();
        $ids = [];
        foreach($payments as $payment){ 
            array_push($ids, $payment->product_id); 
        }
        $products = Product::whereIn('id',$ids)->get();
        $purchased = collect([]);
        $purchased = $purchased->union([$orders,$payments,$products])->toArray();
        $MainPurchased = [];

        for($i=0;$i<count($orders);$i++){
            for($j=0;$j<count($purchased);$j++){
                $MainPurchased[$i][$j] = $purchased[$j][$i];
            }
        }
        $MainPurchased = collect($MainPurchased);
        return new PurchasedCollection($MainPurchased->all());
    
    }


}
