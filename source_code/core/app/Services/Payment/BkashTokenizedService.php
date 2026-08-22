<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BkashTokenizedService implements PaymentGatewayInterface
{
    protected $appKey;
    protected $appSecret;
    protected $username;
    protected $password;
    protected $baseUrl;

    public function __construct()
    {
        $bkash = \App\Models\PaymentSetting::where('unique_keyword', 'bkash')->first();
        $bkashData = $bkash ? $bkash->convertJsonData() : null;

        $this->appKey = $bkashData['app_key'] ?? env('BKASH_APP_KEY');
        $this->appSecret = $bkashData['app_secret'] ?? env('BKASH_APP_SECRET');
        $this->username = $bkashData['username'] ?? env('BKASH_USERNAME');
        $this->password = $bkashData['password'] ?? env('BKASH_PASSWORD');
        
        // Handle sandbox conditionally, defaulting to true if not found.
        if (isset($bkashData['check_sandbox'])) {
            $isSandbox = $bkashData['check_sandbox'] == 1;
        } else {
            $isSandbox = env('BKASH_SANDBOX', true);
        }
        
        $this->baseUrl = $isSandbox 
            ? 'https://tokenized.sandbox.bka.sh/v1.2.0-beta' 
            : 'https://tokenized.pay.bka.sh/v1.2.0-beta';
    }

    /**
     * Get bKash Auth Token
     */
    private function grantToken()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'username' => $this->username,
            'password' => $this->password,
        ])->post("{$this->baseUrl}/tokenized/checkout/token/grant", [
            'app_key' => $this->appKey,
            'app_secret' => $this->appSecret,
        ]);

        $data = $response->json();
        if (isset($data['id_token'])) {
            Session::put('bkash_token', $data['id_token']);
            return $data['id_token'];
        }

        throw new \Exception('Failed to get bKash token: ' . ($data['statusMessage'] ?? 'Unknown error'));
    }

    /**
     * Create the payment and return redirect URL.
     */
    public function initializePayment(array $orderData)
    {
        $token = $this->grantToken();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $token,
            'X-APP-Key' => $this->appKey
        ])->post("{$this->baseUrl}/tokenized/checkout/create", [
            'mode' => '0011', // Checkout Mode
            'payerReference' => ' ',
            'callbackURL' => route('front.bkash.callback'),
            'amount' => $orderData['amount'],
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $orderData['transaction_number'],
        ]);

        $data = $response->json();

        if (isset($data['bkashURL'])) {
            return [
                'status' => true,
                'link' => $data['bkashURL']
            ];
        }

        return [
            'status' => false,
            'message' => $data['statusMessage'] ?? 'Failed to create payment'
        ];
    }

    /**
     * Execute the payment when the user returns.
     */
    public function executePayment(array $callbackData)
    {
        $paymentID = $callbackData['paymentID'] ?? null;
        $status = $callbackData['status'] ?? null;

        if ($status !== 'success' || !$paymentID) {
            return [
                'status' => false,
                'message' => 'Payment was cancelled or failed.'
            ];
        }

        $token = Session::get('bkash_token');
        if (!$token) {
            $token = $this->grantToken(); // Fallback if token expired
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $token,
            'X-APP-Key' => $this->appKey
        ])->post("{$this->baseUrl}/tokenized/checkout/execute", [
            'paymentID' => $paymentID,
        ]);

        $data = $response->json();

        if (isset($data['transactionStatus']) && $data['transactionStatus'] === 'Completed') {
            return [
                'status' => true,
                'transaction_number' => $data['merchantInvoiceNumber'] ?? null,
                'trxID' => $data['trxID'] ?? null,
            ];
        }

        return [
            'status' => false,
            'message' => $data['statusMessage'] ?? 'Payment execution failed.'
        ];
    }

    /**
     * Verify Server-to-Server Webhook.
     */
    public function handleWebhook(array $webhookData)
    {
        // Webhook handles asynchronous updates, e.g., signature verification.
        // For bKash, IPN usually sends a payload with 'Message' containing details.
        
        // This is a placeholder for actual bKash B2B webhook validation.
        return true;
    }
}
