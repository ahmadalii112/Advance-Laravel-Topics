<?php

namespace App\Orders;

use App\Billing\PaymentGateway;

class OrderDetails
{

    private PaymentGateway $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * This is about Order Details
     * @return array
     */
    public function all()
    {
        $this->paymentGateway->setDiscount(500);
        return [
            'name' => 'Ahmad Ali',
            'address' => 'PCSIR Staff Society Lahore',
        ];
    }
}
