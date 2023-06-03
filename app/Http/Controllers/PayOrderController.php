<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    # public function store(PaymentGateway $paymentGateway) // Unresolvable dependency resolving [Parameter #0 [ <required> $currency ]] in class App\Billing\PaymentGateway
    public function store()
    {
        $paymentGateway = new PaymentGateway('usd'); # It works

        dd($paymentGateway->charge(200));
    }
}
