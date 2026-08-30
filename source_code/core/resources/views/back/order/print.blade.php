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
@endphp

<x-invoice.document :order="$order">
    <x-slot name="footer">
        <x-invoice.footer :setting="$setting" :order="$order" />
    </x-slot>

    <x-invoice.header :setting="$setting" :order="$order" />
    <x-invoice.meta :order="$order" />
    <x-invoice.parties :bill="$bill" :ship="$ship" :state="$state" />
    <x-invoice.items :cart="$cart" :setting="$setting" />
    <x-invoice.summary :cart="$cart" :order="$order" />
    
</x-invoice.document>
