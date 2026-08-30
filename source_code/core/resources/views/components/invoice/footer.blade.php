@props(['setting', 'order'])

<div style="border-top: 2px solid #C92732; background-color: #FAFAFA; padding: 20px 15mm;">
    <table style="width: 100%;">
        <tr>
            <!-- Left Info -->
            <td style="width: 33.33%; text-align: left; vertical-align: top;">
                <div style="font-size: 9px; font-weight: bold; color: #292929; text-transform: uppercase; margin-bottom: 3px;">
                    {{ $setting->title ?? 'MAC SCIENTIFIC' }}
                </div>
                <div style="font-size: 8px; color: #888888;">
                    Medical, aesthetic and laboratory products
                </div>
            </td>

            <!-- Center Info -->
            <td style="width: 33.33%; text-align: center; vertical-align: bottom; padding-top: 15px;">
                <div style="font-size: 7px; color: #a1a1aa;">
                    Invoice {{ $order->transaction_number }} | 1 of 1
                </div>
            </td>

            <!-- Right Info -->
            <td style="width: 33.33%; text-align: right; vertical-align: top;">
                <div style="font-size: 9px; font-weight: bold; color: #292929; margin-bottom: 3px;">
                    ms-bd.com
                </div>
                <div style="font-size: 8px; color: #888888;">
                    {{ $setting->footer_phone ?? '+880 1312-699221' }}
                </div>
            </td>
        </tr>
    </table>
</div>
