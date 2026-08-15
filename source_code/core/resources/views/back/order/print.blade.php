<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{__('Invoice')}} - {{ $order->transaction_number }}</title>
    <style>
        @font-face {
            font-family: 'kalpurush';
            src: url('{{ storage_path("fonts/kalpurush.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'kalpurush', 'DejaVu Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background: #fff;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 8px;
            vertical-align: top;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 35px;
            line-height: 35px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #f8f8f8;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            color: #333;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
            font-weight: bold;
        }
        .badge-success { background: #28a745; }
        .badge-danger { background: #dc3545; }
        
        .header-table { width: 100%; margin-bottom: 20px; }
        .header-table td { vertical-align: middle; }
        
        .address-table { width: 100%; margin-bottom: 30px; }
        .address-table td { width: 50%; vertical-align: top; }
        
        .summary-table { width: 100%; }
        .summary-table td { padding: 5px 0; }
        
        @media print {
            .invoice-box {
                box-shadow: none;
                border: none;
                padding: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    @php
        if($order->state){
            $state = json_decode($order->state,true);
        }else{
            $state = [];
        }
        $bill = json_decode($order->billing_info,true);
        $ship = json_decode($order->shipping_info,true);
    @endphp

    <div class="invoice-box">
        <table class="header-table">
            <tr>
                <td class="title">
                    <img src="{{asset('assets/images/'.$setting->logo)}}" style="max-height: 60px; max-width: 250px;" alt="Logo">
                </td>
                <td class="text-right">
                    <h2 style="margin:0; color:#444;">{{__('INVOICE')}}</h2>
                    <strong>{{__('Order ID')}}:</strong> {{$order->transaction_number}}<br>
                    <strong>{{__('Transaction ID')}}:</strong> {{$order->txnid}}<br>
                    <strong>{{__('Order Date')}}:</strong> {{$order->created_at->format('M d, Y')}}<br>
                    <strong>{{__('Payment Method')}}:</strong> {{$order->payment_method}}<br>
                    <strong>{{__('Status')}}:</strong> 
                    @if($order->payment_status == 'Paid')
                        <span class="badge badge-success">{{__('Paid')}}</span>
                    @else
                        <span class="badge badge-danger">{{__('Unpaid')}}</span>
                    @endif
                </td>
            </tr>
        </table>

        <table class="address-table">
            <tr>
                <td>
                    <h4 style="margin:0 0 10px 0; color:#333; border-bottom:2px solid #eee; padding-bottom:5px;">{{__('Billing Address')}}</h4>
                    <strong>{{$bill['bill_first_name']}} {{$bill['bill_last_name']}}</strong><br>
                    @if (isset($bill['bill_address1']))
                        {{$bill['bill_address1']}}
                        @if(isset($bill['bill_address2'])) <br>{{$bill['bill_address2']}} @endif
                        <br>
                    @endif
                    @if (isset($bill['bill_city'])) {{$bill['bill_city']}} @endif
                    @if (isset($state['name'])) , {{$state['name']}} @endif
                    @if (isset($bill['bill_zip'])) - {{$bill['bill_zip']}} @endif <br>
                    @if (isset($bill['bill_country'])) {{$bill['bill_country']}} <br> @endif
                    <br>
                    <strong>{{__('Email')}}:</strong> {{$bill['bill_email']}}<br>
                    <strong>{{__('Phone')}}:</strong> {{$bill['bill_phone']}}<br>
                    @if (isset($bill['bill_company']) && $bill['bill_company'])
                    <strong>{{__('Company')}}:</strong> {{$bill['bill_company']}}<br>
                    @endif
                </td>
                
                <td>
                    <h4 style="margin:0 0 10px 0; color:#333; border-bottom:2px solid #eee; padding-bottom:5px;">{{__('Shipping Address')}}</h4>
                    <strong>{{$ship['ship_first_name']}} {{$ship['ship_last_name']}}</strong><br>
                    @if (isset($ship['ship_address1']))
                        {{$ship['ship_address1']}}
                        @if(isset($ship['ship_address2'])) <br>{{$ship['ship_address2']}} @endif
                        <br>
                    @endif
                    @if (isset($ship['ship_city'])) {{$ship['ship_city']}} @endif
                    @if (isset($state['name'])) , {{$state['name']}} @endif
                    @if (isset($ship['ship_zip'])) - {{$ship['ship_zip']}} @endif <br>
                    @if (isset($ship['ship_country'])) {{$ship['ship_country']}} <br> @endif
                    <br>
                    <strong>{{__('Email')}}:</strong> {{$ship['ship_email']}}<br>
                    <strong>{{__('Phone')}}:</strong> {{$ship['ship_phone']}}<br>
                    @if (isset($ship['ship_company']) && $ship['ship_company'])
                    <strong>{{__('Company')}}:</strong> {{$ship['ship_company']}}<br>
                    @endif
                </td>
            </tr>
        </table>

        <table>
            <tr class="heading">
                <td width="45%">{{__('Product')}}</td>
                <td width="25%">{{__('Attribute')}}</td>
                <td width="10%" class="text-center">{{__('Qty')}}</td>
                <td width="20%" class="text-right">{{__('Price')}}</td>
            </tr>
            
            @php
                $option_price = 0;
                $total = 0;
            @endphp
            @foreach (json_decode($order->cart,true) as $item)
            @php
                $total += $item['main_price'] * $item['qty'];
                $option_price += $item['attribute_price'];
                $grandSubtotal = $total + $option_price;
            @endphp
            <tr class="item">
                <td>{{$item['name']}}</td>
                <td>
                    @if($item['attribute']['option_name'])
                        @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                            <div style="font-size: 12px;">
                                <strong>{{$option_name}}</strong>: 
                                @if ($setting->currency_direction == 1)
                                    {{$order->currency_sign}}{{round($item['attribute']['option_price'][$optionkey]*$order->currency_value,2)}}
                                @else
                                    {{round($item['attribute']['option_price'][$optionkey]*$order->currency_value,2)}}{{$order->currency_sign}}
                                @endif
                            </div>
                        @endforeach
                    @else
                        --
                    @endif
                </td>
                <td class="text-center">{{$item['qty']}}</td>
                <td class="text-right">
                    @if ($setting->currency_direction == 1)
                        {{$order->currency_sign}}{{round($item['main_price']*$order->currency_value,2)}}
                    @else
                        {{round($item['main_price']*$order->currency_value,2)}}{{$order->currency_sign}}
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        
        <br>
        <table style="width: 100%;">
            <tr>
                <td width="55%"></td>
                <td width="45%">
                    <table class="summary-table">
                        @if($order->tax!=0)
                        <tr>
                            <td><strong>{{__('Tax')}}</strong></td>
                            <td class="text-right">
                                @if ($setting->currency_direction == 1)
                                    {{$order->currency_sign}}{{round($order->tax*$order->currency_value,2)}}
                                @else
                                    {{round($order->tax*$order->currency_value,2)}}{{$order->currency_sign}}
                                @endif
                            </td>
                        </tr>
                        @endif
                        
                        @if(json_decode($order->discount,true))
                        @php
                            $discount = json_decode($order->discount,true);
                        @endphp
                        <tr>
                            <td><strong>{{__('Coupon')}} ({{$discount['code']['code_name']}})</strong></td>
                            <td class="text-right" style="color: red;">
                                @if ($setting->currency_direction == 1)
                                    -{{$order->currency_sign}}{{round($discount['discount'] * $order->currency_value,2)}}
                                @else
                                    -{{round($discount['discount'] * $order->currency_value,2)}}{{$order->currency_sign}}
                                @endif
                            </td>
                        </tr>
                        @endif
                        
                        @if(json_decode($order->shipping,true))
                        @php
                            $shipping = json_decode($order->shipping,true);
                        @endphp
                        <tr>
                            <td><strong>{{__('Shipping')}}</strong></td>
                            <td class="text-right">
                                @if ($setting->currency_direction == 1)
                                    {{$order->currency_sign}}{{round($shipping['price']*$order->currency_value,2)}}
                                @else
                                    {{round($shipping['price']*$order->currency_value,2)}}{{$order->currency_sign}}
                                @endif
                            </td>
                        </tr>
                        @endif
                        
                        @if(json_decode($order->state_price,true))
                        <tr>
                            <td>
                                <strong>{{__('State Tax')}}</strong>
                                @if(isset($state['type']) && $state['type'] == 'percentage')
                                    <small>({{$state['price']}}%)</small>
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($setting->currency_direction == 1)
                                    {{$order->currency_sign}}{{round($order['state_price']*$order->currency_value,2)}}
                                @else
                                    {{round($order['state_price']*$order->currency_value,2)}}{{$order->currency_sign}}
                                @endif
                            </td>
                        </tr>
                        @endif
                        
                        <tr class="total">
                            <td style="padding-top: 10px; font-size: 16px;">
                                @if ($order->payment_method == 'Cash On Delivery')
                                    <strong>{{__('Total Amount')}}</strong>
                                @else
                                    <strong>{{__('Total Amount Due')}}</strong>
                                @endif
                            </td>
                            <td class="text-right" style="padding-top: 10px; font-size: 18px; font-weight: bold; color: #007bff;">
                                @if ($setting->currency_direction == 1)
                                    {{$order->currency_sign}}{{PriceHelper::OrderTotal($order)}}
                                @else
                                    {{PriceHelper::OrderTotal($order)}}{{$order->currency_sign}}
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <div style="margin-top: 50px; text-align: center; color: #777; font-size: 12px; border-top: 1px solid #eee; padding-top: 20px;">
            <p>{{__('Thank you for your business!')}}</p>
            <p>{{ $setting->title }} | {{__('Transaction ID')}}: {{$order->txnid}} | {{__('Date')}}: {{date('M d, Y')}}</p>
        </div>
    </div>
</body>
</html>

