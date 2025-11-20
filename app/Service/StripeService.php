<?php

namespace App\Service;

use Stripe\StripeClient;

class StripeService
{
    private $stripe;

    public function __construct()
    {
        // ✅ Use config() instead of env()
        $stripeSecret = config('services.stripe.secret');

        // Validate that the key exists
        if (empty($stripeSecret)) {
            throw new \Exception('Stripe secret key is not configured. Please check your .env file.');
        }

        $this->stripe = new StripeClient($stripeSecret);
    }

    public function createPaymentPayload($name, $amount, $quantity = 1)
    {
        return [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $name,
                ],
                'unit_amount' => $this->calculatePrice($amount), // Amount in cents
            ],
            'quantity' => $quantity,
        ]];
    }

    public function calculatePrice($amount)
    {
        return intval($amount * 100);
    }

    public function pay($product_name, $amount, $metaData = [])
    {
        $checkout_session = $this->stripe->checkout->sessions->create([
            'line_items' => $this->createPaymentPayload($product_name, $amount),
            'mode' => 'payment',
            'success_url' => route('pay.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('pay.error'),
            'metadata' => $metaData,
        ]);

        return $checkout_session->url;
    }

    public function successPayment($sessionId)
    {
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);

        $data = [
            'payment_intent_id' => $session->payment_intent,
            'amount_total' => $session->amount_total / 100,
            'currency' => strtoupper($session->currency),
            'customer_details' => [
                'name' => $session->customer_details->name ?? null,
                'email' => $session->customer_details->email ?? null,
            ],
            'payment_status' => $session->payment_status,
            'created' => date('Y-m-d H:i:s', $session->created),
            'metadata' => $session->metadata,
        ];

        return $data;
    }
}
