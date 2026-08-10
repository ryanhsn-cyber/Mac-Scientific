@foreach($datas as $data)
<tr>
    <td>
        {{ $data->first_name }} {{ $data->last_name }}
    </td>
    <td>
        {{ $data->email }}
    </td>
    <td>
        {{ $data->phone }}
    </td>
    <td>
        @php
            $first_order = $data->orders->sortBy('created_at')->first();
        @endphp
        {{ $first_order ? $first_order->created_at->format('Y-m-d') : __('N/A') }}
    </td>
    <td>
        {{ $data->orders->count() }}
    </td>
    <td>
        @php
            $total_spent = 0;
            foreach($data->orders as $order) {
                if ($order->currency_value) {
                    $total_spent += \App\Helpers\PriceHelper::OrderTotal($order, true) / $order->currency_value;
                }
            }
        @endphp
        {{ \App\Helpers\PriceHelper::adminCurrencyPrice($total_spent) }}
    </td>

    <td>
        <div class="action-list">
            <a class="btn btn-secondary btn-sm "
                href="{{ route('back.user.show',$data->id) }}">
                <i class="fas fa-eye"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="{{ route('back.user.destroy',$data->id) }}">
                <i class="fas fa-trash-alt"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
