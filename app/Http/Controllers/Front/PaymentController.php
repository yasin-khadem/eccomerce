<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\service\BuyPaymentService;
use App\service\VerifyPaymentService;
use Illuminate\Http\Request;
use Zarinpal\Laravel\Facade\Zarinpal;

class PaymentController extends Controller
{
    // public function buy(Request $request)
    public function buy(BuyPaymentService $buyPaymentService)
    {
        return $buyPaymentService->redirectToZarinpal();

    }

    public function callback(VerifyPaymentService $verifyPaymentService)
    {
       return $verifyPaymentService->verifyRequest();
       
    }
}
