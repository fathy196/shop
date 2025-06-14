<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('PAYMOB_API_KEY'); // Store API Key in .env file
        $this->baseUrl = 'https://accept.paymob.com/api';
    }

    // Step 1: Authenticate and get token
    public function getAuthToken()
    {
        $response = Http::post("{$this->baseUrl}/auth/tokens", [
            'api_key' => $this->apiKey,
        ]);

        return $response->json()['token'] ?? null;
    }
    public function createOrder($authToken, $amount, $merchantId, $yourOrderId)
    {
        $response = Http::post("{$this->baseUrl}/ecommerce/orders", [
            'auth_token' => $authToken,
            'delivery_needed' => false,
            'amount_cents' => $amount * 100, // Convert to cents
            'currency' => 'EGP',
            'merchant_order_id' => $yourOrderId, // Unique order ID
            'items' => [],
        ]);

        return $response->json();
    }
    public function getPaymentKey($authToken, $orderId, $amount, $integrationId, $billingData)
    {
        $response = Http::post("{$this->baseUrl}/acceptance/payment_keys", [
            'auth_token' => $authToken,
            'amount_cents' => $amount * 100,
            'expiration' => 3600, // 1 hour
            'order_id' => $orderId,
            'currency' => 'EGP',
            'integration_id' => $integrationId,
            'billing_data' => $billingData,
            'return_url' => url('/payment/callback') . '?order=' . $orderId,
        ]);

        // \Log::info('Payment Key Response:', $response->json()); // Log response

        return $response->json();
    }
    public function getIframeUrl($paymentToken)
    {
        $iframeId = env('PAYMOB_IFRAME_ID'); // Get from Paymob dashboard
        return "https://accept.paymob.com/api/acceptance/iframes/{$iframeId}?payment_token={$paymentToken}";
    }
}
