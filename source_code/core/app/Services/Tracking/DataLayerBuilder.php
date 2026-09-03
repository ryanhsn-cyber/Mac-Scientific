<?php

namespace App\Services\Tracking;

use App\Models\TrackingSetting;

class DataLayerBuilder
{
    /**
     * Build View Item (ViewContent) dataLayer object.
     *
     * @param mixed $item
     * @param string $eventId
     * @return array
     */
    public static function buildViewItem($item, $eventId)
    {
        return [
            'event' => 'view_item',
            'event_id' => $eventId,
            'ecommerce' => [
                'items' => [
                    [
                        'item_id' => (string)($item->id ?? $item['id'] ?? ''),
                        'item_name' => $item->name ?? $item['name'] ?? '',
                        'price' => (float)($item->discount_price ?? $item['discount_price'] ?? $item->previous_price ?? $item['previous_price'] ?? 0),
                        'item_category' => $item->category->name ?? $item['category_name'] ?? '',
                        'quantity' => 1,
                    ]
                ]
            ]
        ];
    }

    /**
     * Build Add to Cart dataLayer object.
     *
     * @param mixed $item
     * @param int $quantity
     * @param string $eventId
     * @return array
     */
    public static function buildAddToCart($item, $quantity, $eventId)
    {
        return [
            'event' => 'add_to_cart',
            'event_id' => $eventId,
            'ecommerce' => [
                'currency' => \App\Helpers\PriceHelper::setCurrencyName(),
                'value' => (float)(($item->discount_price ?? $item['discount_price'] ?? $item->previous_price ?? $item['previous_price'] ?? 0) * $quantity),
                'items' => [
                    [
                        'item_id' => (string)($item->id ?? $item['id'] ?? ''),
                        'item_name' => $item->name ?? $item['name'] ?? '',
                        'price' => (float)($item->discount_price ?? $item['discount_price'] ?? $item->previous_price ?? $item['previous_price'] ?? 0),
                        'quantity' => (int)$quantity,
                    ]
                ]
            ]
        ];
    }

    /**
     * Build Begin Checkout dataLayer object.
     *
     * @param array $cart
     * @param float $total
     * @param string $eventId
     * @return array
     */
    public static function buildBeginCheckout(array $cart, $total, $eventId)
    {
        $items = [];
        foreach ($cart as $key => $item) {
            $items[] = [
                'item_id' => (string)($item['id'] ?? $key),
                'item_name' => $item['name'] ?? '',
                'price' => (float)($item['main_price'] ?? $item['price'] ?? 0),
                'quantity' => (int)($item['qty'] ?? 1),
            ];
        }

        return [
            'event' => 'begin_checkout',
            'event_id' => $eventId,
            'ecommerce' => [
                'currency' => \App\Helpers\PriceHelper::setCurrencyName(),
                'value' => (float)$total,
                'items' => $items,
            ]
        ];
    }

    /**
     * Build Purchase dataLayer object.
     *
     * @param mixed $order
     * @param array $cart
     * @param string $eventId
     * @return array
     */
    public static function buildPurchase($order, $cart, $eventId)
    {
        if (is_string($cart)) {
            $cart = json_decode($cart, true) ?: [];
        }
        if (!is_array($cart)) {
            $cart = [];
        }

        $items = [];
        $contentIds = [];
        foreach ($cart as $key => $item) {
            $rawId = (string)($item['id'] ?? explode('-', (string)$key)[0]);
            $contentIds[] = $rawId;
            $items[] = [
                'item_id' => $rawId,
                'item_name' => $item['name'] ?? '',
                'price' => (float)($item['main_price'] ?? $item['price'] ?? 0),
                'quantity' => (int)($item['qty'] ?? 1),
            ];
        }

        $orderTotal = (float)($order->pay_amount ?? $order->total_amount ?? (method_exists(\App\Helpers\PriceHelper::class, 'OrderTotal') ? \App\Helpers\PriceHelper::OrderTotal($order, true) : 0));
        $currency = \App\Helpers\PriceHelper::setCurrencyName();
        $txnId = (string)($order->transaction_number ?? $order->id);

        return [
            'event' => 'purchase',
            'event_id' => $eventId,
            'transaction_id' => $txnId,
            'value' => $orderTotal,
            'currency' => $currency,
            'content_ids' => $contentIds,
            'content_type' => 'product',
            'num_items' => count($contentIds) > 0 ? count($contentIds) : 1,
            'ecommerce' => [
                'transaction_id' => $txnId,
                'value' => $orderTotal,
                'currency' => $currency,
                'tax' => (float)($order->tax ?? 0),
                'shipping' => (float)($order->shipping_cost ?? 0),
                'items' => $items,
            ]
        ];
    }

    /**
     * Render script tag for DataLayer push.
     *
     * @param array $dataLayer
     * @return string
     */
    public static function renderScript(array $dataLayer)
    {
        if (TrackingSetting::get('auto_push_datalayer', '1') != '1') {
            return '';
        }

        $json = json_encode($dataLayer, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $hasEcommerce = isset($dataLayer['ecommerce']);
        $clearEcommerce = $hasEcommerce ? "window.dataLayer.push({ ecommerce: null });\n" : "";

        $eventName = $dataLayer['event'] ?? '';
        $capitalEventPush = '';
        if (!empty($eventName) && ctype_lower($eventName[0])) {
            $capitalData = $dataLayer;
            $capitalData['event'] = ucfirst($eventName);
            $capitalJson = json_encode($capitalData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            $capitalEventPush = "\nwindow.dataLayer.push({$capitalJson});";
        }

        return "<script>\nwindow.dataLayer = window.dataLayer || [];\n{$clearEcommerce}window.dataLayer.push({$json});{$capitalEventPush}\n</script>";
    }
}
