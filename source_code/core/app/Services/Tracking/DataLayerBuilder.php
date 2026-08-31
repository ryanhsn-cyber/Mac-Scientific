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
    public static function buildPurchase($order, array $cart, $eventId)
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

        $orderTotal = (float)($order->pay_amount ?? $order->total_amount ?? (method_exists(\App\Helpers\PriceHelper::class, 'OrderTotal') ? \App\Helpers\PriceHelper::OrderTotal($order, true) : 0));

        return [
            'event' => 'purchase',
            'event_id' => $eventId,
            'ecommerce' => [
                'transaction_id' => (string)($order->transaction_number ?? $order->id),
                'value' => $orderTotal,
                'currency' => \App\Helpers\PriceHelper::setCurrencyName(),
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
        return "<script>window.dataLayer = window.dataLayer || []; window.dataLayer.push({$json});</script>";
    }
}
