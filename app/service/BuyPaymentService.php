<?php

namespace App\service;

use App\Models\Product;
use App\Models\Payment;
use App\Models\Order;
use Zarinpal\Laravel\Facade\Zarinpal;

class BuyPaymentService
{
    protected $product;
    protected $order;
    protected $amount;
    protected $user;
    protected $results;
    protected $response;

    public function handle()
    {
        return $this->setProps()->checkAmountMoreThanThousand()->isProductExist()->isOrderExist()
            ->getResponseFromZarinpal()->tryToConnectToZarinpal()->getResponse();
    }
    public function redirectToZarinpal()
    {
        return $this->handle();
    }
    /**
     * 
     * @return $this
     */
    protected function setProps()
    {
        $this->product = Product::findOrFail(request()->product_id);

        $this->order = Order::where('product_code', $this->product->code)
            ->where('address', request()->address)
            ->where('phone_number', request()->phone_number)
            ->where('mobile_number', request()->mobile_number)
            ->where('post_code', request()->post_code)->first();

        $this->amount = $this->product->price;

        $this->user = request()->user();
        return $this;
    }
    /**
     * 
     * @return $this
     */
    protected function isOrderExist()
    {
        if (is_null($this->order)) {
            $this->response = back();
        }
        return $this;
    }
    /**
     * 
     * @return $this
     */
    protected function isProductExist()
    {
        if (!$this->product->exist) {
            $this->order->delete();
            $this->response = back();
        }
        return $this;
    }
    /**
     * 
     * @return $this
     */
    protected function getResponseFromZarinpal()
    {
        $this->results = Zarinpal::request(
            url(route('callback')),
            $this->amount,
            $this->product->name,
        );
        return $this;
    }
    /**
     * 
     * @return $this
     */
    protected function tryToConnectToZarinpal()
    {
        if ($this->isResponseSet()) {

            if ($this->isAuthoritySet()) {
                $this->savePayment();

                Zarinpal::redirect();
            }
            $this->connectionFail();
        }

        return $this;
    }
    protected function checkAmountMoreThanThousand()
    {
        if ($this->amount < 1000) {
            session()->flash('notify', [
                'title' => 'به مشکل خوردیم!',
                'text' => 'قیمت نباید کمتر از هزار تومان باشد',
                'icon' => 'error',
                'confirm_text' => 'باشه'
            ]);
            $this->response = back();
        }
        return $this;
    }

    /**
     * 
     * @return bool
     */
    protected function isResponseSet()
    {
        return !isset($this->response) && empty($this->response);
    }
    /**
     * 
     * @return bool
     */
    protected function isAuthoritySet()
    {
        return (isset($this->results['Authority']) && !empty($this->results['Authority'])) ? true : false;
    }
    protected function savePayment(): void
    {
        Payment::create([
            'price' => $this->amount,
            'user_id' => $this->user->id,
            'product_id' => $this->product->id,
            'order_id' => $this->order->id,
            'product_code' => $this->product->code,
            'authority' => $this->results['Authority']
        ]);
    }
    protected function connectionFail()
    {
        session()->flash('notify', [
            'title' => 'به مشکل خوردیم!',
            'text' => 'در ارتباط با زرین پال به مشکل خوردیم!',
            'icon' => 'error',
            'confirm_text' => 'بعدا خرید میکنم'
        ]);
        $this->response = back();
    }
    protected function getResponse()
    {
        return $this->response;
    }
}
