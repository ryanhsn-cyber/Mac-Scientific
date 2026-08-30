@props(['setting', 'order'])

<table style="margin-top: 15px; margin-bottom: 25px;">
    <tr>
        <!-- Left Side: Logo & Company Info -->
        <td style="width: 50%; vertical-align: top;">
            @if($setting->logo)
                <img src="{{ asset('assets/images/'.$setting->logo) }}" alt="Logo" style="width: 38mm; max-width: 40mm; height: auto; display: block; margin-bottom: 2mm;">
            @else
                <div style="font-size: 20px; font-weight: bold; color: #C92732; display: block; margin-bottom: 2mm;">{{ $setting->title }}</div>
            @endif
            
            <!-- Company Description (Hardcoded or from settings if available, using text from reference) -->
            <div style="font-size: 8px; font-weight: bold; color: #b58024; text-transform: uppercase; margin-bottom: 3px;">
                MEDICAL & AESTHETIC SUPPLIES
            </div>
            <div style="font-size: 8px; color: #888888; line-height: 1.4;">
                Shop No. 59, 2nd Floor, Rajanigandha Super Market<br>
                Kachukhet, Dhaka Cantonment, Dhaka-1206, Bangladesh<br>
                {{ $setting->footer_phone ?? '+880 1312-699221' }} | ms-bd.com
            </div>
        </td>

        <!-- Right Side: INVOICE and Order Details -->
        <td style="width: 50%; text-align: right; vertical-align: top;">
            <div style="font-size: 24px; font-weight: 700; color: #292929; letter-spacing: 1px; margin-bottom: 5px;">
                INVOICE
            </div>
            <div style="font-size: 9px; color: #6b7280; font-weight: bold; margin-bottom: 2px;">
                ORDER #{{ $order->transaction_number }}
            </div>
            <div style="font-size: 9px; color: #6b7280; margin-bottom: 12px;">
                Issued {{ $order->created_at ? $order->created_at->format('d M Y') : date('d M Y') }}
            </div>
            
            @php
                $statusColor = '#C92732'; // Default red for unpaid
                $statusText = strtoupper($order->payment_status ?? 'UNPAID');
                if ($statusText === 'PAID') {
                    $statusColor = '#22c55e'; // Green
                } elseif ($statusText === 'PARTIAL') {
                    $statusColor = '#f59e0b'; // Orange
                } elseif ($statusText === 'CANCELLED') {
                    $statusColor = '#6b7280'; // Gray
                }
            @endphp
            
            <div style="display: inline-block; background-color: {{ $statusColor }}; color: #ffffff; font-size: 8px; font-weight: bold; padding: 4px 12px; border-radius: 12px;">
                {{ $statusText }}
            </div>
        </td>
    </tr>
</table>
