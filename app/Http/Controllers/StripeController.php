<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Stripe\Stripe as StripeGateway;

class StripeController extends Controller
{
    public function index()
    {
        \Stripe\Stripe::setApiKey('sk_test_51PQzd600DnYfwWSKHJ7MTP6SqwbhsKjcFuesleNyR3WxUGjgtgbqvFiXjOtVeDFmGmJQRwD9CKTgBH3mwWmt3gqU00UFG6yp6h');
        header('Content-Type: application/json');

        $line_items = [];

        foreach (session()->get('cart') as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency'     => 'eur',
                    'unit_amount'  => $item['price'] * 100,
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                ],
                'quantity' => $item['quantity']
            ];
        }

        $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => route('store'),
        'cancel_url' => route('store'),
        ]);

        return redirect()->away($checkout_session->url);
        // return Inertia::render('Store/Checkout', [
        //     'checkout_session' => $checkout_session
        // ]);
    }
}
