@props(['cart', 'setting'])

<table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
    <thead>
        <tr>
            <th style="width: 110mm; text-align: left; background-color: #F6F7F9; padding: 10px 15px; font-size: 8px; color: #888888; text-transform: uppercase; border-top-left-radius: 4px; border-bottom-left-radius: 4px;">ITEM</th>
            <th style="width: 12mm; text-align: center; background-color: #F6F7F9; padding: 10px 5px; font-size: 8px; color: #888888; text-transform: uppercase;">QTY</th>
            <th style="width: 28mm; text-align: right; background-color: #F6F7F9; padding: 10px 5px; font-size: 8px; color: #888888; text-transform: uppercase;">UNIT PRICE</th>
            <th style="width: 30mm; text-align: right; background-color: #F6F7F9; padding: 10px 15px; font-size: 8px; color: #888888; text-transform: uppercase; border-top-right-radius: 4px; border-bottom-right-radius: 4px;">AMOUNT</th>
        </tr>
    </thead>
    <tbody>
        @php
            $itemCount = 1;
        @endphp
        @foreach($cart as $item)
            @php
                $price = $item['price'];
                $qty = $item['qty'] ?? 1;
                $amount = $price * $qty;
                $formattedPrice = number_format($price, 2);
                $formattedAmount = number_format($amount, 2);
                $indexPadded = str_pad($itemCount++, 2, '0', STR_PAD_LEFT);
            @endphp
            <tr style="page-break-inside: avoid;">
                <td style="padding: 12px 15px; border-bottom: 1px solid #F6F7F9; vertical-align: top;">
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style="width: 20px; font-size: 9px; color: #a1a1aa; vertical-align: top; padding-top: 2px;">{{ $indexPadded }}</td>
                            <td style="vertical-align: top;">
                                <div style="font-size: 10px; font-weight: bold; color: #292929; margin-bottom: 2px;">{{ $item['name'] }}</div>
                                @if(!empty($item['attribute_body']) || !empty($item['attribute_color']))
                                    <div style="font-size: 8px; color: #888888; margin-top: 3px;">
                                        @if(!empty($item['attribute_color'])) 
                                            Color: {{ $item['attribute_color'] }} 
                                        @endif
                                        @if(!empty($item['attribute_body'])) 
                                            @foreach($item['attribute_body'] as $key => $val)
                                                {{ $key }}: {{ $val }}@if(!$loop->last), @endif
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                                @if(!empty($item['item_type']) && $item['item_type'] != 'normal')
                                    <div style="font-size: 8px; color: #888888;">Type: {{ $item['item_type'] }}</div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="padding: 12px 5px; border-bottom: 1px solid #F6F7F9; text-align: center; vertical-align: top; font-size: 9px; color: #6b7280; padding-top: 14px;">
                    {{ $qty }}
                </td>
                <td style="padding: 12px 5px; border-bottom: 1px solid #F6F7F9; text-align: right; vertical-align: top; font-size: 9px; color: #6b7280; padding-top: 14px;">
                    {{ $formattedPrice }}
                </td>
                <td style="padding: 12px 15px; border-bottom: 1px solid #F6F7F9; text-align: right; vertical-align: top; font-size: 9px; font-weight: bold; color: #292929; padding-top: 14px;">
                    {{ $formattedAmount }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
