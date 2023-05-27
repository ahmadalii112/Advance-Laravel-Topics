<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function checkout()
    {
        # setup api key
        Stripe::setApiKey(env('STRIPE_SECRET'));
        # Get All Products
        $products = Product::all();

        $lineItems = [];
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->price;
            $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $product->name,
                            'images' => [$product->image],
                        ],
                        'unit_amount' => $product->price * 100,
                    ],
                    'quantity' => 1,
                ];
        }
        # checkout Session
        $checkout_session = Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);
        # Order
        $order = Order::create([
            'status' => "unpaid",
            'total_price' => $totalPrice,
            'session_id' => $checkout_session->id,
        ]);


        return redirect($checkout_session->url);
    }

    public function success()
    {
        return view('products.checkout-success');
    }

    public function cancel()
    {

    }
}
