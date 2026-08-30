@props(['order', 'isPreview' => false])

@if(!$isPreview)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ __('Invoice') }} - {{ $order->transaction_number ?? '' }}</title>
    <style>
        /* Typography */
        @font-face {
            font-family: 'kalpurush';
            src: url('{{ storage_path("fonts/kalpurush.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'kalpurush';
            src: url('{{ storage_path("fonts/kalpurush.ttf") }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @page {
            size: A4 portrait;
            margin: 0;
        }
        
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'kalpurush', 'DejaVu Sans', Helvetica, Arial, sans-serif;
            color: #292929;
            font-size: 11px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .invoice-page {
            width: 210mm;
            min-height: 297mm;
            margin: 0;
            position: relative;
            background: #ffffff;
        }

        .top-red-line {
            width: 100%;
            height: 2mm;
            background-color: #C92732;
            margin-bottom: 25px;
        }

        .content-wrapper {
            margin-left: 15mm;
            margin-right: 15mm;
            width: 180mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        td, th {
            vertical-align: top;
            padding: 0;
        }

        /* Generic classes */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-gray { color: #6b7280; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; }
        
        .footer-wrapper {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 35mm;
        }
    </style>
</head>
<body>
@else
    <style>
        .invoice-preview-container {
            background-color: #f3f4f6;
            padding: 2rem 1rem;
            display: flex;
            justify-content: center;
            overflow-x: auto;
        }
        
        .invoice-page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            position: relative;
            background: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            font-family: 'Inter', 'kalpurush', 'DejaVu Sans', Helvetica, Arial, sans-serif;
            color: #292929;
            font-size: 11px;
            line-height: 1.4;
            box-sizing: border-box;
            flex-shrink: 0;
        }

        .invoice-page * {
            box-sizing: border-box;
        }

        .invoice-page .top-red-line {
            width: 100%;
            height: 2mm;
            background-color: #C92732;
            margin-bottom: 25px;
        }

        .invoice-page .content-wrapper {
            margin-left: 15mm;
            margin-right: 15mm;
            width: 180mm;
        }

        .invoice-page table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .invoice-page td, .invoice-page th {
            vertical-align: top;
            padding: 0;
        }
        
        .invoice-page .footer-wrapper {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 35mm;
        }
        
        @media (max-width: 768px) {
            .invoice-preview-container {
                padding: 1rem 0;
                justify-content: flex-start;
            }
            .invoice-page {
                transform: scale(0.45);
                transform-origin: top left;
                margin-bottom: -150mm; /* adjust for scaled height */
            }
        }
        @media (max-width: 480px) {
            .invoice-page {
                transform: scale(0.35);
                margin-bottom: -190mm;
            }
        }
    </style>
    <div class="invoice-preview-container">
@endif

    <div class="invoice-page">
        <!-- Top red line -->
        <div class="top-red-line"></div>
        
        <div class="content-wrapper">
            {{ $slot }}
        </div>

        <div class="footer-wrapper">
            @if(isset($footer))
                {{ $footer }}
            @endif
        </div>
    </div>

@if(!$isPreview)
</body>
</html>
@else
    </div>
@endif
