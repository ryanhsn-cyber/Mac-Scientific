@props(['order'])

<div style="border-top: 1px solid #E5E6E8; border-bottom: 1px solid #E5E6E8; padding: 12px 0; margin-bottom: 25px;">
    <table>
        <tr>
            <td style="width: 33.33%;">
                <div style="font-size: 8px; font-weight: bold; color: #888888; text-transform: uppercase; margin-bottom: 4px;">ORDER DATE</div>
                <div style="font-size: 11px; font-weight: 600; color: #292929;">
                    {{ $order->created_at ? $order->created_at->format('d M Y') : date('d M Y') }}
                </div>
            </td>
            <td style="width: 33.33%;">
                <div style="font-size: 8px; font-weight: bold; color: #888888; text-transform: uppercase; margin-bottom: 4px;">PAYMENT METHOD</div>
                <div style="font-size: 11px; font-weight: 600; color: #292929;">
                    {{ $order->payment_method ?: 'Nagad' }}
                </div>
            </td>
            <td style="width: 33.33%;">
                <div style="font-size: 8px; font-weight: bold; color: #888888; text-transform: uppercase; margin-bottom: 4px;">TRANSACTION ID</div>
                <div style="font-size: 11px; font-weight: 600; color: #292929;">
                    {{ rtrim($order->txnid ?: $order->transaction_number, '\\') }}
                </div>
            </td>
        </tr>
    </table>
</div>
