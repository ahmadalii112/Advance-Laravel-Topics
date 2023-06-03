<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store(PaymentGateway $paymentGateway) # If we want laravel to Inject class for us it uses Reflection Class and inject it
    {
       // $paymentGateway = new PaymentGateway(); # instance of PaymentGateway Class
        dd($paymentGateway->charge(200));
    }
}
