<?php
namespace App\Http\Controllers;

use Inertia\Inertia;

class StripeController extends Controller
{
    public function index()
    {
        // Set your Stripe secret key
        \Stripe\Stripe::setApiKey(config('sk_test_51PSJdMDpWnANxoexzALQJdElVr5Py61lMoi4RrMC0QdC7DeZmIXTSHmacqE42pRejqntKc91dYYnJIwy2IFrV9I200BGaAMIM1'));
    
        // Create a Checkout Session
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur', // Replace with your desired currency
                    'product_data' => [
                        'name' => 'Your Product Name',
                    ],
                    'unit_amount' => 500, // Amount in cents (5.00 EUR)
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true), // Replace with your success route
            'cancel_url' => route('checkout.cancel', [], true), // Replace with your cancel route
        ]);
    
        // Redirect the user to the Checkout Session URL
        return redirect()->away($session->url);
    }

    public function success()
    {
        // Handle the successful payment
        return Inertia::render('Store/Checkout');
    }
    
    public function cancel()
    {
        // Handle the canceled payment
        return Inertia::render('Store/Cart');
    }
}