@foreach($datas as $data)
<tr id="order-bulk-delete">
  <td><input type="checkbox" class="bulk-item" value="{{$data->id}}"></td>

    <td>
        {{ $data->transaction_number}}
    </td>
    <td>
        {{ json_decode($data->billing_info,true)['bill_first_name']}}
    </td>

    <td>
      @if ($setting->currency_direction == 1)
      {{$data->currency_sign}}{{PriceHelper::OrderTotal($data)}}
      @else
      {{PriceHelper::OrderTotal($data)}}{{$data->currency_sign}}
      @endif
    </td>

    <td>
        <div class="dropdown">
            <button class="btn btn-{{ $data->payment_status == 'Paid' ?  'success': 'danger' }} btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $data->payment_status == 'Paid' ?  __('Paid') : __('Unpaid')  }}
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{ route('back.order.status',[$data->id,'payment_status','Paid']) }}">{{ __('Paid') }}</a>
              <a class="dropdown-item" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{ route('back.order.status',[$data->id,'payment_status','Unpaid']) }}">{{ __('Unpaid') }}</a>
            </div>
          </div>
    </td>
    <td>
        <div class="dropdown">
            <button class="btn {{ $data->order_status  }}  btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $data->order_status  }}
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{ route('back.order.status',[$data->id,'order_status','Pending']) }}">{{ __('Pending') }}</a>
              <a class="dropdown-item" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{ route('back.order.status',[$data->id,'order_status','In Progress']) }}">{{ __('In Progress') }}</a>
              <a class="dropdown-item" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{ route('back.order.status',[$data->id,'order_status','Delivered']) }}">{{ __('Delivered') }}</a>
              <a class="dropdown-item" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{ route('back.order.status',[$data->id,'order_status','Canceled']) }}">{{ __('Canceled') }}</a>
            </div>
          </div>
    </td>
    <td>
        @if(($setting->steadfast_api_key ?? false) && ($setting->steadfast_secret_key ?? false))
            @if(!$data->steadfast_consignment_id)
            <form action="{{ route('back.order.steadfast', $data->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">{{ __('Send') }}</button>
            </form>
            @else
            <span class="badge badge-info mb-1">{{ __('ID:') }} {{ $data->steadfast_consignment_id }}</span><br>
            <span class="badge badge-secondary mb-1">{{ $data->steadfast_status ?? 'Pending' }}</span><br>
            <a href="{{ route('back.order.steadfast.status', $data->id) }}" class="btn btn-warning btn-sm" title="{{ __('Update Status') }}"><i class="fas fa-sync"></i></a>
            @endif
        @else
            <span class="badge badge-danger">{{ __('Not Configured') }}</span>
        @endif
    </td>
    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm"
                href="{{ route('back.order.invoice',$data->id) }}">
                <i class="fas fa-eye"></i>
            </a>
            <a class="btn btn-success btn-sm"
                href="{{ route('back.order.pdf',$data->id) }}">
                <i class="fas fa-file-pdf"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="{{ route('back.order.delete',$data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
