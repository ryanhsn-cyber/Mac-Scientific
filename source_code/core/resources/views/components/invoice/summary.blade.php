@props(['cart', 'order'])

@php
    $totalQty = 0;
    $lineItems = count($cart);
    foreach ($cart as $it) {
        $totalQty += ($it['qty'] ?? 1);
    }
    
    // Calculate subtotal from perfectly rounded items
    $subtotal = 0;
    foreach ($cart as $it) {
        $basePrice = ($it['main_price'] ?? $it['price'] ?? 0) + ($it['attribute_price'] ?? 0);
        $price = round($basePrice * ($order->currency_value ?? 1), 2);
        $subtotal += $price * ($it['qty'] ?? 1);
    }
    
    $currency = 'BDT';
    $currency_value = $order->currency_value ?? 1;

    // Convert and round all components
    $shippingBase = $order->shipping ? (is_array($order->shipping) ? ($order->shipping['price'] ?? 0) : (json_decode($order->shipping, true)['price'] ?? 0)) : 0;
    $shipping = round($shippingBase * $currency_value, 2);
    
    $discountBase = $order->discount ? (is_array($order->discount) ? ($order->discount['discount'] ?? 0) : (json_decode($order->discount, true)['discount'] ?? 0)) : 0;
    $discount = round($discountBase * $currency_value, 2);
    
    // Tax calculation in original logic: $total_tax += $item::taxCalculate($item) ... then $grand_total * currency_value
    $tax = round(($order->tax ?? 0) * $currency_value, 2);
    $statePrice = round(($order->state_price ?? 0) * $currency_value, 2);
    
    $calculatedTotal = $subtotal + $shipping + $tax + $statePrice - $discount;
    $totalAmount = number_format($calculatedTotal, 2);

@endphp

<div style="margin-top: 10px;">
    <table>
        <tr>
            <!-- Left Info -->
            <td style="width: 50%; vertical-align: top; padding-top: 15px;">
                <div style="font-size: 9px; color: #888888; line-height: 1.6;">
                    <div>{{ $lineItems }} line items | Total quantity: {{ $totalQty }}</div>
                    <div>Payment method: {{ $order->payment_method ?: 'Nagad' }}</div>
                </div>
                
                <div style="margin-top: 25px; font-size: 11px; font-weight: bold; color: #292929;">
                    Thank you for your business.
                </div>
                <div style="font-size: 9px; color: #888888; margin-top: 4px;">
                    Please reference Order #{{ $order->transaction_number }} when contacting us about this invoice.
                </div>
            </td>

            <!-- Right Totals Box -->
            <td style="width: 50%; text-align: right; vertical-align: top;">
                <div style="display: inline-block; background-color: #F6F7F9; padding: 20px 25px; border-radius: 6px; min-width: 200px;">
                    <!-- Additional Rows like Subtotal, Tax, Shipping can be added here if needed, 
                         but reference only shows TOTAL AMOUNT DUE in the main box. We will show them cleanly above the total if present. -->
                    
                    @if($shipping > 0 || $tax > 0 || $discount > 0 || $statePrice > 0)
                        <table style="width: 100%; margin-bottom: 12px;">
                            <tr>
                                <td style="text-align: left; font-size: 9px; color: #6b7280; padding-bottom: 4px;">Subtotal</td>
                                <td style="text-align: right; font-size: 9px; color: #292929; font-weight: bold; padding-bottom: 4px;">{{ number_format($subtotal, 2) }}</td>
                            </tr>
                            @if($shipping > 0)
                            <tr>
                                <td style="text-align: left; font-size: 9px; color: #6b7280; padding-bottom: 4px;">Shipping</td>
                                <td style="text-align: right; font-size: 9px; color: #292929; font-weight: bold; padding-bottom: 4px;">+{{ number_format($shipping, 2) }}</td>
                            </tr>
                            @endif
                            @if($statePrice > 0)
                            <tr>
                                <td style="text-align: left; font-size: 9px; color: #6b7280; padding-bottom: 4px;">State Tax</td>
                                <td style="text-align: right; font-size: 9px; color: #292929; font-weight: bold; padding-bottom: 4px;">+{{ number_format($statePrice, 2) }}</td>
                            </tr>
                            @endif
                            @if($tax > 0)
                            <tr>
                                <td style="text-align: left; font-size: 9px; color: #6b7280; padding-bottom: 4px;">Tax</td>
                                <td style="text-align: right; font-size: 9px; color: #292929; font-weight: bold; padding-bottom: 4px;">+{{ number_format($tax, 2) }}</td>
                            </tr>
                            @endif
                            @if($discount > 0)
                            <tr>
                                <td style="text-align: left; font-size: 9px; color: #6b7280; padding-bottom: 4px;">Discount</td>
                                <td style="text-align: right; font-size: 9px; color: #C92732; font-weight: bold; padding-bottom: 4px;">-{{ number_format($discount, 2) }}</td>
                            </tr>
                            @endif
                        </table>
                        <div style="border-top: 1px solid #E5E6E8; margin-bottom: 12px;"></div>
                    @endif

                    <div style="font-size: 8px; font-weight: bold; color: #888888; text-transform: uppercase; margin-bottom: 5px;">
                        TOTAL AMOUNT DUE
                    </div>
                    <div style="font-size: 16px; font-weight: 700; color: #C92732;">
                        {{ $currency }} {{ $totalAmount }}
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
