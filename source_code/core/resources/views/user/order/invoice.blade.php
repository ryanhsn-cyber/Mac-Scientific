@extends('master.front')
@section('title')
    {{__('Invoice')}}
@endsection
@section('content')

<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('user.order.index')}}">{{__('Orders')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('Order Invoice')}}</li>
                  </ul>
            </div>
        </div>
    </div>
  </div>
        <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1 print_invoice">
    <div class="card card-body p-5">
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

<x-invoice.document :order="$order" :is-preview="true">
    <x-slot name="footer">
        <x-invoice.footer :setting="$setting" :order="$order" />
    </x-slot>

    <x-invoice.header :setting="$setting" :order="$order" />
    <x-invoice.meta :order="$order" />
    <x-invoice.parties :bill="$bill" :ship="$ship" :state="$state" />
    <x-invoice.items :cart="$cart" :setting="$setting" />
    <x-invoice.summary :cart="$cart" :order="$order" />
</x-invoice.document>

    </div>
</div>
@endsection
