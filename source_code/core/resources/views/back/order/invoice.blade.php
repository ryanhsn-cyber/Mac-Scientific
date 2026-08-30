@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0">{{ __('Order Invoice') }} </h3>
                <div>
                    <a class="btn btn-primary btn-sm" href="{{route('back.order.index')}}"><i class="fas fa-chevron-left"></i> {{ __('Back') }}</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('back.order.print',$order->id) }}" target="_blank"><i class="fas fa-print"></i> {{ __('print') }}</a>
                    <a class="btn btn-success btn-sm" href="{{ route('back.order.pdf',$order->id) }}"><i class="fas fa-file-pdf"></i> {{ __('PDF') }}</a>
                </div>
                </div>
        </div>
    </div>
    
    @if(($setting->steadfast_api_key ?? false) && ($setting->steadfast_secret_key ?? false))
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h5 class="mb-0"><b>{{ __('Steadfast Courier Integration') }}</b></h5>
                <div>
                    @if(!$order->steadfast_consignment_id)
                    <form action="{{ route('back.order.steadfast', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">{{ __('Send to Steadfast Courier') }}</button>
                    </form>
                    @else
                    <span class="badge badge-info">{{ __('Consignment ID:') }} {{ $order->steadfast_consignment_id }}</span>
                    <span class="badge badge-primary">{{ __('Tracking Code:') }} {{ $order->steadfast_tracking_code }}</span>
                    <span class="badge badge-secondary">{{ __('Status:') }} {{ $order->steadfast_status ?? 'Pending' }}</span>
                    <a href="{{ route('back.order.steadfast.status', $order->id) }}" class="btn btn-warning btn-sm ml-2">{{ __('Update Status') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
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
            </div>
        </div>

</div>

@endsection
