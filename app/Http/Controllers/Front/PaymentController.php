<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Zarinpal\Laravel\Facade\Zarinpal;

use function PHPUnit\Framework\returnSelf;

class PaymentController extends Controller
{
    public function buy(Request $request)
    {
        // dd($request->all());
        $product = Product::findOrFail($request->product_id);
        $order = Order::firstWhere('product_code', $product->code);
        $amount = $product->price;
        $user = $request->user();

        if ($product->exist) {

            $results = Zarinpal::request(
                url(route('callback')),
                $amount,
                $product->name,
            );
            if (isset($results['Authority']) && !empty($results['Authority'])) {

                Payment::create([
                    'price' => $amount,
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'product_code' => $product->code,
                    'authority' => $results['Authority']
                ]);

                Zarinpal::redirect();
            }
        } else {
            $order->delete();
            return redirect(url('/'));
        }

        // save $results['Authority'] for verifying step
        // redirect user to zarinpal

        // after that verify transaction by that $results['Authority']
        // Zarinpal::verify('OK',1000,$results['Authority']);
    }

    public function callback(Request $request)
    {
        $authority =  request('Authority');
        $payment = Payment::firstWhere('authority', $authority);

        $product = Product::firstWhere('code', $payment->product_code);

        $order = Order::firstWhere('product_code', $payment->product_code);


        if($order){
            $verified_request = Zarinpal::verify('OK', $payment->price, $authority);
        } else{
            $payment->delete();
            return "پرداخت شما به مشکل خورد";
        }


        if ($verified_request['Status'] === 'success') {
            $payment->update([
                'is_paid' => true,
                'ref_id' => $verified_request['RefID'],
                'extra_details' => $verified_request['ExtraDetail']
            ]);

            $order->update([
                'payment_id' => $payment->id
            ]);

            $product->update([
                'exist' => false
            ]);

            return "درخواست با موفقیت انجام شد";
        } elseif ($verified_request['Status'] === 'verified_before') {
            return "درخواست قبلا تایید شده است";
        } else {
            $order->delete();
            $payment->delete();
            return "پرداخت شما به مشکل خورد";
        }
    }
}
