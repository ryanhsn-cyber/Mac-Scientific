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
                
                <div class="party-address" style="font-size: 9px; color: #6b7280; line-height: 1.5; white-space: normal; overflow-wrap: normal; word-break: normal;">
                    @php
                        $billParts = [];
                        if(!empty($bill['bill_address1'])) $billParts[] = $bill['bill_address1'];
                        if(!empty($bill['bill_address2'])) $billParts[] = $bill['bill_address2'];
                        $billCity = '';
                        if(!empty($bill['bill_city'])) {
                            $billCity .= $bill['bill_city'];
                            if(isset($state['name'])) $billCity .= ', ' . $state['name'];
                            if(!empty($bill['bill_zip'])) $billCity .= '-' . $bill['bill_zip'];
                        }
                        if(!empty($billCity)) $billParts[] = $billCity;
                        if(!empty($bill['bill_country'])) $billParts[] = $bill['bill_country'];
                    @endphp
                    {{ implode(', ', $billParts) }}
                    
                    @if(!empty($bill['bill_email']) || !empty($bill['bill_phone']))
                    <div style="margin-top: 4px;">
                        @php
                            $billContact = [];
                            if(!empty($bill['bill_email'])) $billContact[] = $bill['bill_email'];
                            if(!empty($bill['bill_phone'])) $billContact[] = $bill['bill_phone'];
                        @endphp
                        {{ implode(' | ', $billContact) }}
                    </div>
                    @endif
                    
                    @if(!empty($bill['bill_company']))
                        <div style="margin-top: 2px; font-weight: bold; color: #292929;">Company: {{ $bill['bill_company'] }}</div>
                    @endif
                </div>
            </td>

            <!-- SHIP TO -->
            <td style="width: 50%;">
                <div style="font-size: 8px; font-weight: bold; color: #888888; text-transform: uppercase; margin-bottom: 3px;">SHIP TO</div>
                <div style="width: 15px; height: 1.5px; background-color: #C92732; margin-bottom: 8px;"></div>
                
                <div style="font-size: 11px; font-weight: bold; color: #292929; margin-bottom: 4px;">
                    {{ $ship['ship_first_name'] ?? ($bill['bill_first_name'] ?? '') }} {{ $ship['ship_last_name'] ?? ($bill['bill_last_name'] ?? '') }}
                </div>
                
                <div class="party-address" style="font-size: 9px; color: #6b7280; line-height: 1.5; white-space: normal; overflow-wrap: normal; word-break: normal;">
                    @php
                        $shipParts = [];
                        
                        $shipAddr1 = $ship['ship_address1'] ?? ($bill['bill_address1'] ?? '');
                        if(!empty($shipAddr1)) $shipParts[] = $shipAddr1;
                        
                        if(!empty($ship['ship_address2'])) $shipParts[] = $ship['ship_address2'];
                        
                        $shipCity = '';
                        $rawCity = $ship['ship_city'] ?? ($bill['bill_city'] ?? '');
                        $rawZip = $ship['ship_zip'] ?? ($bill['bill_zip'] ?? '');
                        
                        if(!empty($rawCity)) {
                            $shipCity .= $rawCity;
                            if(isset($state['name'])) $shipCity .= ', ' . $state['name'];
                            if(!empty($rawZip)) $shipCity .= '-' . $rawZip;
                        }
                        if(!empty($shipCity)) $shipParts[] = $shipCity;
                        
                        $shipCountry = $ship['ship_country'] ?? ($bill['bill_country'] ?? '');
                        if(!empty($shipCountry)) $shipParts[] = $shipCountry;
                    @endphp
                    {{ implode(', ', $shipParts) }}
                    
                    @php
                        $shipEmail = $ship['ship_email'] ?? ($bill['bill_email'] ?? '');
                        $shipPhone = $ship['ship_phone'] ?? ($bill['bill_phone'] ?? '');
                        $shipContact = [];
                        if(!empty($shipEmail)) $shipContact[] = $shipEmail;
                        if(!empty($shipPhone)) $shipContact[] = $shipPhone;
                    @endphp
                    @if(!empty($shipContact))
                    <div style="margin-top: 4px;">
                        {{ implode(' | ', $shipContact) }}
                    </div>
                    @endif
                    
                    @php
                        $shipCompany = $ship['ship_company'] ?? ($bill['bill_company'] ?? '');
                    @endphp
                    @if(!empty($shipCompany))
                        <div style="margin-top: 2px; font-weight: bold; color: #292929;">Company: {{ $shipCompany }}</div>
                    @endif
                </div>
            </td>
        </tr>
    </table>
</div>
