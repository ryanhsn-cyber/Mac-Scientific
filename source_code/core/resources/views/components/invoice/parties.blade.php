@props(['bill', 'ship', 'state'])

<div style="margin-bottom: 25px;">
    <table>
        <tr>
            <!-- BILL TO -->
            <td style="width: 50%; padding-right: 20px;">
                <div style="font-size: 8px; font-weight: bold; color: #888888; text-transform: uppercase; margin-bottom: 3px;">BILL TO</div>
                <div style="width: 15px; height: 1.5px; background-color: #C92732; margin-bottom: 8px;"></div>
                
                <div style="font-size: 11px; font-weight: bold; color: #292929; margin-bottom: 4px;">
                    {{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}
                </div>
                
                <div style="font-size: 9px; color: #6b7280; line-height: 1.5;">
                    @if(!empty($bill['bill_address1'])) <div>{{ $bill['bill_address1'] }}</div> @endif
                    @if(!empty($bill['bill_address2'])) <div>{{ $bill['bill_address2'] }}</div> @endif
                    @if(!empty($bill['bill_city'])) 
                        <div>
                            {{ $bill['bill_city'] }}@if(isset($state['name'])), {{ $state['name'] }}@endif 
                            @if(!empty($bill['bill_zip'])) - {{ $bill['bill_zip'] }}@endif
                        </div>
                    @endif
                    @if(!empty($bill['bill_country'])) <div>{{ $bill['bill_country'] }}</div> @endif
                    
                    <div style="margin-top: 6px;">
                        @if(!empty($bill['bill_email'])) <div>{{ $bill['bill_email'] }}</div> @endif
                        @if(!empty($bill['bill_phone'])) <div>{{ $bill['bill_phone'] }}</div> @endif
                    </div>
                </div>
            </td>

            <!-- SHIP TO -->
            <td style="width: 50%;">
                <div style="font-size: 8px; font-weight: bold; color: #888888; text-transform: uppercase; margin-bottom: 3px;">SHIP TO</div>
                <div style="width: 15px; height: 1.5px; background-color: #C92732; margin-bottom: 8px;"></div>
                
                <div style="font-size: 11px; font-weight: bold; color: #292929; margin-bottom: 4px;">
                    {{ $ship['ship_first_name'] ?? ($bill['bill_first_name'] ?? '') }} {{ $ship['ship_last_name'] ?? ($bill['bill_last_name'] ?? '') }}
                </div>
                
                <div style="font-size: 9px; color: #6b7280; line-height: 1.5;">
                    @if(!empty($ship['ship_address1']))
                        <div>{{ $ship['ship_address1'] }}</div>
                    @elseif(!empty($bill['bill_address1']))
                        <div>{{ $bill['bill_address1'] }}</div>
                    @endif
                    
                    @if(!empty($ship['ship_address2'])) <div>{{ $ship['ship_address2'] }}</div> @endif
                    
                    @if(!empty($ship['ship_city'])) 
                        <div>
                            {{ $ship['ship_city'] }}@if(isset($state['name'])), {{ $state['name'] }}@endif 
                            @if(!empty($ship['ship_zip'])) - {{ $ship['ship_zip'] }}@elseif(!empty($bill['bill_zip'])) - {{ $bill['bill_zip'] }}@endif
                        </div>
                    @elseif(!empty($bill['bill_city']))
                        <div>
                            {{ $bill['bill_city'] }}@if(isset($state['name'])), {{ $state['name'] }}@endif 
                            @if(!empty($bill['bill_zip'])) - {{ $bill['bill_zip'] }}@endif
                        </div>
                    @endif
                    
                    <div style="margin-top: 6px;">
                        @if(!empty($ship['ship_email']))
                            <div>{{ $ship['ship_email'] }}</div>
                        @elseif(!empty($bill['bill_email']))
                            <div>{{ $bill['bill_email'] }}</div>
                        @endif
                        
                        @if(!empty($ship['ship_phone']))
                            <div>{{ $ship['ship_phone'] }}</div>
                        @elseif(!empty($bill['bill_phone']))
                            <div>{{ $bill['bill_phone'] }}</div>
                        @endif
                        
                        @if(!empty($ship['ship_company']))
                            <div style="margin-top: 4px; font-weight: bold; color: #292929;">Company: {{ $ship['ship_company'] }}</div>
                        @elseif(!empty($bill['bill_company']))
                            <div style="margin-top: 4px; font-weight: bold; color: #292929;">Company: {{ $bill['bill_company'] }}</div>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
