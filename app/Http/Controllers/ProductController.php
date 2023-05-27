<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            'success_url' => route('checkout.success') . "?session_id={CHECKOUT_SESSION_ID}",
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

    public function success(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');
        try {
            $session = Session::retrieve($sessionId);
            throw_if(!$session, NotFoundHttpException::class);
            # $customer = Customer::retrieve($session->customer) // Not Retrieving Customer Object right now

            $order = Order::where('session_id', $session->id)->where('status', 'unpaid')->firstOrFail();
            $order->update(['status' => 'paid']);

            return view('products.checkout-success', [
                'order' => $order,
                # 'customer' => $customer,
            ]);
        } catch (\Exception $e) {
            throw new NotFoundHttpException;
        }
    }

    public function cancel()
    {

    }
}
