<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ __('Invoice') }} - {{ $order->transaction_number }}</title>
    <style>
        @font-face {
            font-family: 'kalpurush';
            src: url('{{ storage_path("fonts/kalpurush.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'kalpurush';
            src: url('{{ storage_path("fonts/kalpurush.ttf") }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'kalpurush', 'DejaVu Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .invoice-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 24px 30px;
            background: #ffffff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        td, th {
            vertical-align: top;
            padding: 0;
        }
        .header-table {
            margin-bottom: 20px;
        }
        .meta-strip {
            margin-bottom: 24px;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            padding: 10px 14px;
        }
        .meta-col {
            width: 33.33%;
        }
        .address-table {
            margin-bottom: 24px;
        }
        .address-col {
            width: 50%;
            padding-right: 15px;
        }
        .red-bar {
            width: 32px;
            height: 2px;
            background-color: #a0261a;
            margin-top: 3px;
            margin-bottom: 6px;
        }
        .items-table {
            width: 100%;
            margin-bottom: 20px;
            page-break-inside: auto;
        }
        .items-table thead tr th {
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 6px;
            border-bottom: 1.5px solid #cbd5e1;
        }
        .items-table tbody tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        .items-table tbody tr td {
            padding: 9px 6px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 12px;
        }
        .summary-wrapper {
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .total-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 12px 18px;
            text-align: right;
            min-width: 220px;
            display: inline-block;
        }
        .footer-rule {
            border-top: 2px solid #a0261a;
            margin-top: 30px;
            padding-top: 10px;
        }
        .text-left { text-align: left; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        @media print {
            body {
                background: #ffffff;
                padding: 0;
            }
            .invoice-wrapper {
                max-width: 100%;
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body onload="window.print()">
    @php
        $setting = App\Models\Setting::first();
        if ($order->state) {
            $state = json_decode($order->state, true);
        } else {
            $state = [];
        }
        $bill = json_decode($order->billing_info, true) ?: [];
        $ship = json_decode($order->shipping_info, true) ?: $bill;
        $cart = json_decode($order->cart, true) ?: [];
        $total_qty = 0;
        foreach ($cart as $it) {
            $total_qty += ($it['qty'] ?? 1);
        }
        $isPaid = strtolower($order->payment_status) == 'paid';
    @endphp

    <div class="invoice-wrapper">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td style="width: 55%;">
                    <img src="{{ asset('assets/images/' . $setting->logo) }}" style="max-height: 48px; max-width: 220px;" alt="{{ $setting->title }}">
                    <div style="font-size: 11px; font-weight: 800; color: #a0261a; letter-spacing: 0.8px; margin-top: 5px; text-transform: uppercase;">
                        MEDICAL &amp; AESTHETIC SUPPLIES
                    </div>
                    <div style="font-size: 11px; color: #475569; line-height: 1.4; margin-top: 3px;">
                        Shop 59, 2nd Floor, Rajanigandha Super Market<br>
                        Kachukhet, Dhaka Cantonment, Dhaka-1206, Bangladesh<br>
                        {{ $setting->footer_phone ?? '+880 1312-699221' }} | ms-bd.com
                    </div>
                </td>
                <td style="width: 45%; text-align: right;">
                    <div style="font-size: 28px; font-weight: 800; color: #0f172a; line-height: 1; text-transform: uppercase; letter-spacing: 0.5px;">
                        INVOICE
                    </div>
                    <div style="font-size: 12px; font-weight: 700; color: #64748b; margin-top: 4px; text-transform: uppercase;">
                        ORDER #{{ $order->transaction_number }}
                    </div>
                    <div style="font-size: 11px; color: #64748b; margin-top: 2px;">
                        Issued {{ $order->created_at ? $order->created_at->format('d M Y') : date('d M Y') }}
                    </div>
                    <div style="margin-top: 7px;">
                        @if($isPaid)
                            <span style="display: inline-block; background-color: #15803d; color: #ffffff; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 3px 14px; border-radius: 12px;">
                                PAID
                            </span>
                        @else
                            <span style="display: inline-block; background-color: #dc2626; color: #ffffff; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 3px 14px; border-radius: 12px;">
                                UNPAID
                            </span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <!-- Order Meta Strip -->
        <table class="meta-strip">
            <tr>
                <td class="meta-col">
                    <span style="font-size: 9.5px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">ORDER DATE</span><br>
                    <strong style="font-size: 12.5px; color: #0f172a;">{{ $order->created_at ? $order->created_at->format('d M Y') : date('d M Y') }}</strong>
                </td>
                <td class="meta-col">
                    <span style="font-size: 9.5px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">PAYMENT METHOD</span><br>
                    <strong style="font-size: 12.5px; color: #0f172a;">{{ $order->payment_method ?: 'Nagad' }}</strong>
                </td>
                <td class="meta-col">
                    <span style="font-size: 9.5px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">TRANSACTION ID</span><br>
                    <strong style="font-size: 12.5px; color: #0f172a;">{{ $order->txnid ?: $order->transaction_number }}</strong>
                </td>
            </tr>
        </table>

        <!-- Billing & Shipping -->
        <table class="address-table">
            <tr>
                <td class="address-col">
                    <div style="font-size: 10.5px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">BILL TO</div>
                    <div class="red-bar"></div>
                    <div style="font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 2px;">
                        {{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}
                    </div>
                    <div style="font-size: 11px; color: #475569; line-height: 1.45;">
                        @if(isset($bill['bill_address1']) && $bill['bill_address1'])
                            {{ $bill['bill_address1'] }}<br>
                        @endif
                        @if(isset($bill['bill_address2']) && $bill['bill_address2'])
                            {{ $bill['bill_address2'] }}<br>
                        @endif
                        @if(isset($bill['bill_city']) && $bill['bill_city'])
                            {{ $bill['bill_city'] }}@if(isset($state['name'])), {{ $state['name'] }}@endif @if(isset($bill['bill_zip'])) - {{ $bill['bill_zip'] }}@endif<br>
                        @endif
                        @if(isset($bill['bill_country']) && $bill['bill_country'])
                            {{ $bill['bill_country'] }}<br>
                        @endif
                        @if(isset($bill['bill_email']) && $bill['bill_email'])
                            {{ $bill['bill_email'] }}<br>
                        @endif
                        @if(isset($bill['bill_phone']) && $bill['bill_phone'])
                            {{ $bill['bill_phone'] }}<br>
                        @endif
                        @if(isset($bill['bill_company']) && $bill['bill_company'])
                            Company: {{ $bill['bill_company'] }}
                        @endif
                    </div>
                </td>
                <td class="address-col">
                    <div style="font-size: 10.5px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px;">SHIP TO</div>
                    <div class="red-bar"></div>
                    <div style="font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 2px;">
                        {{ $ship['ship_first_name'] ?? ($bill['bill_first_name'] ?? '') }} {{ $ship['ship_last_name'] ?? ($bill['bill_last_name'] ?? '') }}
                    </div>
                    <div style="font-size: 11px; color: #475569; line-height: 1.45;">
                        @if(isset($ship['ship_address1']) && $ship['ship_address1'])
                            {{ $ship['ship_address1'] }}<br>
                        @elseif(isset($bill['bill_address1']))
                            {{ $bill['bill_address1'] }}<br>
                        @endif
                        @if(isset($ship['ship_address2']) && $ship['ship_address2'])
                            {{ $ship['ship_address2'] }}<br>
                        @endif
                        @if(isset($ship['ship_city']) && $ship['ship_city'])
                            {{ $ship['ship_city'] }}@if(isset($state['name'])), {{ $state['name'] }}@endif @if(isset($ship['ship_zip'])) - {{ $ship['ship_zip'] }}@endif<br>
                        @endif
                        @if(isset($ship['ship_country']) && $ship['ship_country'])
                            {{ $ship['ship_country'] }}<br>
                        @endif
                        @if(isset($ship['ship_email']) && $ship['ship_email'])
                            {{ $ship['ship_email'] }}<br>
                        @endif
                        @if(isset($ship['ship_phone']) && $ship['ship_phone'])
                            {{ $ship['ship_phone'] }}<br>
                        @endif
                        <div style="font-size: 11px; color: #475569; margin-top: 1px;">
                            Company: {{ $ship['ship_company'] ?? ($bill['bill_company'] ?? 'Mac Scientific') }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Itemized Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th class="text-left" style="width: 52%;">ITEM</th>
                    <th class="text-center" style="width: 10%;">QTY</th>
                    <th class="text-right" style="width: 18%;">UNIT PRICE</th>
                    <th class="text-right" style="width: 20%;">AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                @endphp
                @foreach ($cart as $index => $item)
                    @php
                        $itemPrice = ($item['main_price'] ?? 0) * $order->currency_value;
                        $itemQty = $item['qty'] ?? 1;
                        $itemTotal = $itemPrice * $itemQty;
                        $subtotal += $itemTotal;
                    @endphp
                    <tr>
                        <td class="text-left">
                            <div style="font-size: 12px; font-weight: 700; color: #0f172a;">
                                {{ sprintf('%02d', $loop->iteration) }} {{ $item['name'] ?? 'Product' }}
                            </div>
                            @if(isset($item['attribute']['option_name']) && $item['attribute']['option_name'])
                                <div style="font-size: 10.5px; color: #64748b; margin-top: 2px;">
                                    @foreach ($item['attribute']['option_name'] as $okey => $oname)
                                        {{ $oname }}@if(!$loop->last) | @endif
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="text-center" style="color: #334155;">
                            {{ $itemQty }}
                        </td>
                        <td class="text-right" style="color: #334155;">
                            {{ number_format($itemPrice, 2) }}
                        </td>
                        <td class="text-right" style="font-weight: 700; color: #0f172a;">
                            {{ number_format($itemTotal, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary & Totals -->
        <table class="summary-wrapper">
            <tr>
                <td style="width: 50%; vertical-align: top; padding-top: 5px;">
                    <div style="font-size: 11.5px; color: #475569; line-height: 1.6;">
                        <strong>{{ count($cart) }}</strong> line items | Total quantity: <strong>{{ $total_qty }}</strong><br>
                        Payment method: <strong>{{ $order->payment_method ?: 'Nagad' }}</strong>
                        @if($order->tax != 0)
                            <br>Tax: <strong>{{ number_format($order->tax * $order->currency_value, 2) }}</strong>
                        @endif
                        @if(json_decode($order->shipping, true))
                            @php $sh = json_decode($order->shipping, true); @endphp
                            <br>Shipping: <strong>{{ number_format($sh['price'] * $order->currency_value, 2) }}</strong>
                        @endif
                        @if(json_decode($order->discount, true))
                            @php $dc = json_decode($order->discount, true); @endphp
                            <br>Coupon Discount: <strong style="color: #dc2626;">-{{ number_format($dc['discount'] * $order->currency_value, 2) }}</strong>
                        @endif
                    </div>
                </td>
                <td style="width: 50%; text-align: right; vertical-align: top;">
                    <div class="total-box">
                        <div style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
                            TOTAL AMOUNT DUE
                        </div>
                        <div style="font-size: 22px; font-weight: 800; color: #a0261a; margin-top: 2px; letter-spacing: -0.5px;">
                            BDT {{ PriceHelper::OrderTotal($order) }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Thank you & Reference -->
        <div style="margin-top: 20px;">
            <div style="font-size: 12px; font-weight: 700; color: #0f172a;">
                Thank you for your business.
            </div>
            <div style="font-size: 10.5px; color: #64748b; margin-top: 2px;">
                Please reference Order #{{ $order->transaction_number }} when contacting us about this invoice.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-rule">
            <table>
                <tr>
                    <td class="text-left" style="width: 38%;">
                        <div style="font-size: 11px; font-weight: 800; color: #0f172a; text-transform: uppercase;">MAC SCIENTIFIC</div>
                        <div style="font-size: 10px; color: #64748b;">Medical, aesthetic and laboratory products</div>
                    </td>
                    <td class="text-center" style="width: 24%; vertical-align: middle;">
                        <div style="font-size: 10px; color: #64748b;">
                            Invoice {{ $order->transaction_number }} | 1 of 1
                        </div>
                    </td>
                    <td class="text-right" style="width: 38%;">
                        <div style="font-size: 11px; font-weight: 800; color: #0f172a;">ms-bd.com</div>
                        <div style="font-size: 10px; color: #64748b;">{{ $setting->footer_phone ?? '+880 1312-699221' }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
