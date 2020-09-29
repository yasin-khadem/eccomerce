<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\service\BuyPaymentService;
use Illuminate\Http\Request;
use Zarinpal\Laravel\Facade\Zarinpal;

class PaymentController extends Controller
{
    // public function buy(Request $request)
    public function buy(BuyPaymentService $buyPaymentService)
    {
        return $buyPaymentService->redirectToZarinpal();
        // $product = Product::findOrFail($request->product_id);

        // $order = Order::where('product_code', $product->code)
        // ->where('address',$request->address)->where('phone_number',$request->phone_number)
        // ->where('mobile_number',$request->mobile_number)->where('post_code',$request->post_code)->first();

        // $amount = $product->price;

        // $user = $request->user();

        // if ($product->exist && $order) {
        //     $results = Zarinpal::request(
        //         url(route('callback')),
        //         $amount,
        //         $product->name,
        //     );

        //     if (isset($results['Authority']) && !empty($results['Authority'])) {
        //         Payment::create([
        //             'price' => $amount,
        //             'user_id' => $user->id,
        //             'product_id' => $product->id,
        //             'order_id' => $order->id,
        //             'product_code' => $product->code,
        //             'authority' => $results['Authority']
        //         ]);

        //         Zarinpal::redirect();

        //     }else{
        //         session()->flash('notify',[
        //             'title'=>'به مشکل خوردیم!',
        //             'text'=>'در ارتباط با زرین پال به مشکل خوردیم!',
        //             'icon'=>'error',
        //             'confirm_text'=> 'بعدا خرید میکنم'
        //         ]);
        //         return redirect(url('/'));
        //     }


        // } else {
        //     $order->delete();
        //     return redirect(url('/'));
        // }

    }

    public function callback(Request $request)
    {
        $authority =  request('Authority');
        $status = request('Status');
        $payment = Payment::firstWhere('authority', $authority);

        if(is_null($authority) || is_null($status) || is_null($payment)){
            session()->flash('notify', [
                'title' => 'به مشکل خوردیم!',
                'text' => 'اطلاعات کافی نیست',
                'icon' => 'error',
                'confirm_text' => 'بعدا خرید میکنم'
            ]);
            return redirect(url('/'));
        }

        $product = Product::firstWhere('code', $payment->product_code);

        $order = Order::findOrFail($payment->order_id);


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
            session()->flash('notify', [
                'title' => 'محصول خریداری شد',
                'text' => 'شناسه خرید:' . $verified_request['RefID'],
                'icon' => 'success',
                'confirm_text' => 'اوکی'
            ]);
            return redirect(url('/')); //TODO redirect to Shopping list


        } elseif ($verified_request['Status'] === 'verified_before') {
            session()->flash('notify', [
                'title' => 'مشکل به وجود آمد',
                'text' => 'درخواست قبلا تایید شده است',
                'icon' => 'error',
                'confirm_text' => 'اوکی برمیگردم به صفحه اصلی'
            ]);
            return redirect(url('/'));
        } else {
            $order->delete();
            $payment->delete();
            session()->flash('notify', [
                'title' => 'مشکل به وجود آمد',
                'text' => 'پرداخت شما به مشکل خورد',
                'icon' => 'error',
                'confirm_text' => 'اوکی برمیگردم به صفحه اصلی'
            ]);
            return redirect(url('/'));
        }
    }
}
