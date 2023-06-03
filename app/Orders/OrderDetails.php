<?php

namespace App\Orders;

use App\Billing\BankPaymentGateway;

class OrderDetails
{

    private BankPaymentGateway $paymentGateway;

    public function __construct(BankPaymentGateway $paymentGateway)
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
