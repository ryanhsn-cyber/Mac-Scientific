@extends('master.front')
@section('title')
    {{__('Payment')}}
@endsection
@section('content')
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="{{route('front.index')}}">{{ __('Home') }}</a> </li>
          <li class="separator"></li>
          <li>{{ __('Review your order and pay') }}</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1 checkut-page">
    <div class="row">
      <!-- Payment Methode-->
      <div class="col-xl-9 col-lg-8">
        <div class="steps flex-sm-nowrap mb-5"> 
          <a class="step" href="{{route('front.checkout.billing')}}">
          <h4 class="step-title"><i class="icon-check-circle"></i>1. {{__('Invoice to')}}:</h4>
          </a> <a class="step" href="{{route('front.checkout.shipping')}}">
          <h4 class="step-title"><i class="icon-check-circle"></i>2. {{__('Ship to')}}:</h4>
          </a> <a class="step active" href="{{route('front.checkout.payment')}}">
          <h4 class="step-title">3. {{__('Review and pay')}}</h4>
          </a>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="pb-2">{{__('Complete your Payment via')}} {{$gateway->name}}</h6>
                <hr>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        @if($gateway->photo)
                        <img src="{{asset('assets/images/'.$gateway->photo)}}" alt="{{$gateway->name}}" title="{{$gateway->name}}" style="max-height: 100px; margin-bottom: 20px;">
                        @else
                        <h4>{{$gateway->name}}</h4>
                        @endif
                        
                        <div class="mt-3">
                            {!! $gateway->text !!}
                        </div>
                    </div>
                    
                    <div class="col-md-6 border-left">
                        <div class="p-3 bg-light rounded">
                            <h5 class="mb-3">{{ __('Amount to Pay') }}: <strong class="text-primary">{{PriceHelper::setCurrencyPrice($grand_total)}}</strong></h5>
                            
                            <form action="{{route('front.checkout.submit')}}" method="POST">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="txn_id" class="font-weight-bold">{{ __('Transaction ID (TrxID)') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="txn_id" id="txn_id" placeholder="{{__('Enter Your Transaction Number')}}" required />
                                    <small class="text-muted">{{ __('Please enter the transaction ID provided after a successful payment.') }}</small>
                                </div>
                                
                                <input type="hidden" name="payment_method" value="{{$gateway->name}}">
                                <input type="hidden" name="state_id" value="{{auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : ''}}" class="state_id_setup">
                                
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{route('front.checkout.payment')}}" class="btn btn-outline-secondary">{{ __('Back') }}</a>
                                    <button class="btn btn-primary" type="submit"><span>{{ __('Submit Payment') }}</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
      </div>
      @include('includes.checkout_sitebar',$cart)
    </div>
  </div>
@endsection
