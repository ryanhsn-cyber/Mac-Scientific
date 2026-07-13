@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class=" mb-0 bc-title"> <b>{{ __('SMS Setting') }}</b> </h3>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-12">
							<div class="p-5">
								<form class="admin-form" action="{{ route('back.sms.update') }}" method="POST"
									enctype="multipart/form-data">

                                    @csrf

									@include('alerts.alerts')

                                    <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
                                        <div id="tabs">
                                          <ul class="nav nav-pills nav-secondary nav-justified mb-3" role="tablist">
                                            <li class="nav-item">
                                              <a class="nav-link active" data-toggle="pill" href="#conf">{{ __('Configuration') }}</a>
                                            </li>
                                            <li class="nav-item">
                                              <a class="nav-link" data-toggle="pill" href="#template">{{ __('SMS Section') }}</a>
                                            </li>

                                          </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                          <div id="conf" class="container tab-pane active"><br>


                                            <div class="row justify-content-center">

                                                <div class="col-lg-8">

                                                    <form action="{{ route('back.setting.update') }}" method="POST" enctype="multipart/form-data">

                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="switch-primary">
                                                          <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_twilio" value="1" {{ $setting->is_twilio == 1 ? 'checked' : '' }}>
                                                          <span class="switch-body"></span>
                                                          <span class="switch-text">{{ __('SMS Service') }}</span>
                                                        </label>
                                                    </div>



                                                    {{-- <div class="form-check  mb-4">
                                                        <input type="checkbox" data-toggle="toggle" data-onstyle="primary" data-style="btn-round" name="is_twilio" class="form-check-input radio-check" value="1" id="is_twilio" {{ $setting->is_twilio == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_twilio">{{ __('SMS Service') }}</label>
                                                    </div> --}}

                                                    <div class="radio-show {{ $setting->is_twilio == 0 ? 'd-none' : '' }}">

                                                        <div class="form-group ">
                                                            <label for="sms_url">{{ __('Universal SMS API URL') }}</label>
                                                            <input type="text" class="form-control" id="sms_url" name="sms_url" placeholder="{{ __('e.g., http://api.sms.com/send?to={number}&msg={message}') }}" value="{{ $setting->sms_url ?? '' }}">
                                                            <small class="form-text text-muted">{{ __('Use {number} for the recipient phone number and {message} for the SMS content.') }}</small>
                                                        </div>

                                                    </div>

                                                        <div>

                                                            <div class="form-group d-flex justify-content-center">
                                                                <button type="submit" class="btn btn-secondary btn-block w-100">{{ __('Submit') }}</button>
                                                            </div>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                          </div>

                                          <div id="template" class="container tab-pane"><br>

                                            <div class="row justify-content-center">

                                                <div class="col-lg-8">

                                                    <form action="{{ route('back.setting.update') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @php
                                                        $sms_section = json_decode($setting->twilio_section,true);
                                                    @endphp
                                                        <p>Available Tags:</p>
                                                        <ul>
                                                            <li><code>{order_number}</code> - Order Number</li>
                                                            <li><code>{order_amount}</code> - Total Order Price</li>
                                                            <li><code>{order_date}</code> - Order Date</li>
                                                            <li><code>{payment_method}</code> - Payment Method used (e.g. Stripe, Cash On Delivery)</li>
                                                            <li><code>{customer_name}</code>, <code>{customer_phone}</code>, <code>{customer_address}</code> - Customer Info (Merchant SMS)</li>
                                                            <li><code>{order_items}</code> - List of items (Merchant SMS)</li>
                                                        </ul>
                                                        
                                                        <div class="form-group ">
                                                            <label for="order_purchase">{{ __('Customer Order Confirmation') }}</label>
                                                            <textarea name="twilio_section['purchase']" class="form-control" id="order_purchase" placeholder="{{__('Enter Message')}}">{{$sms_section["'purchase'"]}}</textarea>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for="order_status">{{ __('Customer Order Status Update') }}</label>
                                                            <textarea name="twilio_section['order_status']" class="form-control" id="order_status" placeholder="{{__('Enter Message')}}">{{$sms_section["'order_status'"]}}</textarea>
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for="merchant_purchase">{{ __('Merchant Notification (New Order)') }}</label>
                                                            <textarea name="twilio_section['merchant_purchase']" class="form-control" id="merchant_purchase" placeholder="{{__('Enter Message')}}">{{$sms_section["'merchant_purchase'"] ?? ''}}</textarea>
                                                        </div>

                                                        <div class="form-group d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-secondary btn-block w-100">{{ __('Submit') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>

                                      </div>
									<div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>

@endsection
