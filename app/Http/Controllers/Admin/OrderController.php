<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollction;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResourceCollction;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index()
    {
        return new OrderCollection(Order::whereNotNull('payment_id')->orderBy('delivered','asc')->orderBy('created_at','desc')->searchByUrl()->paginate(10));
    }

    
    public function store(Request $request)
    {
        //
    }

  
    public function show(Order $order)
    {
        //
    }

    
    public function update(Request $request, Order $order)
    {
        //
    }

    public function deliver(Request $request,Order $order){
        $order->update([
            'delivered'=> true
        ]);
    }
    public function destroy(Order $order)
    {
        //
    }
}
