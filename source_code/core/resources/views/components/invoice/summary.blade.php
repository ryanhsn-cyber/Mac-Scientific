@props(['cart', 'order'])

@php
    $totalQty = 0;
    $lineItems = count($cart);
    foreach ($cart as $it) {
        $totalQty += ($it['qty'] ?? 1);
    }
    
    // Calculate total
    $subtotal = 0;
    foreach ($cart as $it) {
        $subtotal += $it['price'] * ($it['qty'] ?? 1);
    }
    
    // Include shipping/discount/tax if necessary. The order model usually has $order->total or similar.
    // Assuming $order->currency_sign and \App\Helpers\PriceHelper::OrderTotal($order) could be used.
    $currency = $order->currency_sign ?? 'BDT';
    $totalAmount = \App\Helpers\PriceHelper::OrderTotal($order, true);
    
    if (empty($totalAmount) || $totalAmount == 0) {
        // Fallback calculation if helper doesn't work or returns 0
        $shipping = $order->shipping['price'] ?? 0;
        $discount = $order->discount['discount'] ?? 0;
        $tax = $order->tax ?? 0;
        $statePrice = $order->state_price ?? 0;
        
        $total = $subtotal + $shipping + $tax + $statePrice - $discount;
        $totalAmount = number_format($total, 2);
    } else {
        // If PriceHelper returned a number/string, ensure it's formatted. It might already have the sign.
        // We will strip any non-numeric except dot and comma, then re-format, or just use it.
        // Actually PriceHelper::OrderTotal($order, true) usually returns the plain number if we pass true?
        // Let's just safely rely on $order->total if it exists, otherwise the helper.
        // But $order doesn't have 'total' field in fillable, it's calculated.
        
        // Let's stick to our own precise calculation for safety if helper formats it with currency.
        $shipping = $order->shipping ? (is_array($order->shipping) ? ($order->shipping['price'] ?? 0) : (json_decode($order->shipping, true)['price'] ?? 0)) : 0;
        $discount = $order->discount ? (is_array($order->discount) ? ($order->discount['discount'] ?? 0) : (json_decode($order->discount, true)['discount'] ?? 0)) : 0;
        $tax = $order->tax ?? 0;
        $statePrice = $order->state_price ?? 0;
        
        $calculatedTotal = $subtotal + $shipping + $tax + $statePrice - $discount;
        $totalAmount = number_format($calculatedTotal, 2);
    }
@endphp

<div style="margin-top: 10px;">
    <table>
        <tr>
            <!-- Left Info -->
            <td style="width: 50%; vertical-align: top; padding-top: 15px;">
                <div style="font-size: 9px; color: #888888; line-height: 1.6;">
                    {{ $lineItems }} line items &nbsp;|&nbsp; Total quantity: {{ $totalQty }}<br>
                    Payment method: {{ $order->payment_method ?: 'Nagad' }}
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
