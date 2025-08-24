<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\StripePayment;
use Stripe\Checkout\Session;
use Stripe\Refund;
use Stripe\Exception\ApiErrorException;

class StripeController extends Controller
{

    public function index()
    {
        return view('stripe-integration.index');

    }
    public function showcardForm()
    {

        return view('stripe-integration.card');

    }
    public function showcheckoutForm()
    {
        return view('stripe-integration.checkout');

    }
    public function showrefundForm()
    {
        return view('stripe-integration.refund');

    }


    public function processPayment(Request $request)
    {
        try {

            $stripeSecretKey = config('services.stripe.secret');
            Stripe::setApiKey($stripeSecretKey);
            $amount = $request->input('amount') * 100;

            $charge = \Stripe\Charge::create([
                "amount" => $amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test Payment",
            ]);

            StripePayment::create([
                'stripe_charge_id' => $charge->id,
            ]);

            return back()->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function checkout(Request $request)
    {
        $stripeSecretKey = config('services.stripe.secret');
        Stripe::setApiKey($stripeSecretKey);
        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Test Payment',
                    ],
                    'unit_amount' => $request->amount, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($checkoutSession->url);
    }

    public function success()
    {
        return "Payment successful!"; // You can redirect to a success page
    }

    public function cancel()
    {
        return "Payment cancelled."; // You can redirect to a cancel page
    }
    public function refund(Request $request)
    {
        try {
            $stripeSecretKey = config('services.stripe.secret');
            Stripe::setApiKey($stripeSecretKey);
            // Get charge ID from the form
            $chargeId = $request->input('charge_id');

            // Refund the charge
            $refund = Refund::create([
                'charge' => $chargeId,
            ]);

            return back()->with('success', 'Refund processed successfully!');
        } catch (ApiErrorException $e) {
            return back()->with('error', 'Refund failed: ' . $e->getMessage());
        }
    }
}
