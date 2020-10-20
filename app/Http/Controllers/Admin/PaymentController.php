<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentCollection;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return new PaymentCollection(
            Payment::with('user')
                ->orderBy('is_paid', 'desc')
                ->orderBy('created_at', 'desc')
                ->searchByUrl()->paginate(10)
        );
    }
}
