<?php

namespace App\Services\Payment;

interface PaymentGatewayInterface
{
    /**
     * Initialize the payment process and return the redirect URL.
     *
     * @param array $orderData The order details.
     * @return array|string The redirect URL or a response array containing status and URL.
     */
    public function initializePayment(array $orderData);

    /**
     * Execute the payment after the user returns from the payment gateway.
     *
     * @param array $callbackData The data returned by the gateway.
     * @return array A response array containing status (success/failed) and message.
     */
    public function executePayment(array $callbackData);

    /**
     * Handle asynchronous server-to-server webhook notifications.
     *
     * @param array $webhookData The webhook payload.
     * @return mixed Response to send back to the payment gateway.
     */
    public function handleWebhook(array $webhookData);
}
