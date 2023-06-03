<?php

namespace App\Billing;

interface PaymentGatewayContract
{
    # Interface is just a road map that how a class can be constructed
    public function charge($amount);

    public function setDiscount($amount);
}
