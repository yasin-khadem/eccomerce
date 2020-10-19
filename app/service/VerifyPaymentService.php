<?php

namespace App\service;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\purchased;
use Zarinpal\Laravel\Facade\Zarinpal;


class VerifyPaymentService
{
    protected $authority;
    protected $status;
    protected $payment;
    protected $product;
    protected $order;
    protected $response;
    protected $verified_request;

    public function handle()
    {
        return $this->setProps()->isPropsSet()->setVerifiedRequest()->checkVerifiedRequest()->getResponse();
    }
    public function verifyRequest()
    {
        return $this->handle();
    }
    protected function setProps()
    {
        $this->authority =  request('Authority');
        $this->status = request('Status');
        if ($this->authority) {
            $this->payment = Payment::firstWhere('authority', $this->authority);
            if ($this->payment) {
                $this->product = Product::firstWhere('code', $this->payment->product_code);
                if ($this->product) {
                    $this->order = Order::findOrFail($this->payment->order_id);
                }
            }
        }


        return $this;
    }
    protected function isPropsSet()
    {
        if ($this->isPropsNull()) {
            session()->flash('notify', [
                'title' => 'به مشکل خوردیم!',
                'text' => 'اطلاعات کافی نیست',
                'icon' => 'error',
                'confirm_text' => 'بعدا خرید میکنم'
            ]);
            $this->response = redirect(url('/'));
        }

        return $this;
    }
    protected function setVerifiedRequest()
    {
        if ($this->order && $this->payment && $this->authority) {
            $this->verified_request = Zarinpal::verify('OK', $this->payment->price, $this->authority);
        } else {
            if($this->payment){
                $this->payment->delete();
            }
            $this->response = redirect(url('/'));
        }
        return $this;
    }


    protected function checkVerifiedRequest()
    {
        if (!is_null($this->response)) {
            return $this;
        }
        if ($this->verified_request['Status'] === 'success') {
            $this->payment->update([
                'is_paid' => true,
                'ref_id' => $this->verified_request['RefID'],
                'extra_details' => $this->verified_request['ExtraDetail']
            ]);

            $this->order->update([
                'payment_id' => $this->payment->id
            ]);

            $this->product->update([
                'exist' => false
            ]);



            // create purchased list



            purchased::create([
                'user_id'=> $this->order->user_id,
                'product_id'=> $this->product->id,
                'product_name'=>$this->product->name,
                'product_code'=> $this->product->code,
                'price'=>$this->payment->price,
                'order_data'=>$this->order->created_at,
                'image_src'=>$this->product->image_src,
            ]);



            // create purchased list


            session()->flash('notify', [
                'title' => 'محصول خریداری شد',
                'text' => 'شناسه خرید:' . $this->verified_request['RefID'],
                'icon' => 'success',
                'confirm_text' => 'باشه'
            ]);
            $this->response = $this->product ? redirect("/purchased/index") : redirect('/'); //TODO redirect to Shopping list


        } elseif ($this->verified_request['Status'] === 'verified_before') {
            session()->flash('notify', [
                'title' => 'مشکل به وجود آمد',
                'text' => 'درخواست قبلا تایید شده است',
                'icon' => 'error',
                'confirm_text' => 'برمیگردم به صفحه اصلی'
            ]);
            $this->response = $this->product ? redirect($this->product->url_path) : redirect('/');
        } else {
            if($this->order->payment_id === null || $this->order->payment_id !== $this->payment->id){
                $this->order->delete();
            }
            if($this->payment->is_paid === false){
                $this->payment->delete();
            }
            session()->flash('notify', [
                'title' => 'مشکل به وجود آمد',
                'text' => 'پرداخت شما به مشکل خورد',
                'icon' => 'error',
                'confirm_text' => 'برمیگردم به صفحه اصلی'
            ]);
            $this->response = $this->product ? redirect($this->product->url_path) : redirect('/'); //TODO redirect to Shopping list
        }
        return $this;
    }
    /**
     * 
     * 
     * @return bool
     */
    protected function isPropsNull(): bool
    {
        return (is_null($this->authority) || is_null($this->status) || is_null($this->payment) || is_null($this->product) || is_null($this->order)) ? true : false;
    }
    protected function getResponse()
    {
        return $this->response;
    }
}
