<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header, .client-info, .invoice-info {
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table, th, td {
            border: 1px solid #444;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .totals {
            float: right;
            width: 40%;
            margin-top: 20px;
        }

        .totals td {
            border: none;
            padding: 4px 8px;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">Invoice</div>
        <div>
            Company: Hafid Tech Course<br>
            Phone: +1 (228) 498-7767<br>
            Address: Sint nostrud laboru
        </div>
    </div>

    <div class="client-info">
        <strong>Client:</strong><br>
        {{ $orders->first()->student ?? 'Unknown' }}<br>
        {{ $orders->first()->email ?? '' }}
    </div>

    <div class="invoice-info">
        <strong>Invoice #</strong>{{ $orders->first()->invoice_id ?? 'N/A' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Instructor</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->course_title }}</td>
                    <td>{{ $order->instructor }}</td>
                    <td>1</td>
                    <td>${{ number_format($order->paid_amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td><strong>Subtotal</strong></td>
            <td>${{ number_format($orders->sum('paid_amount'), 2) }}</td>
        </tr>
        <tr>
            <td><strong>Paid Amount</strong></td>
            <td>${{ number_format($orders->sum('paid_amount'), 2) }} {{ $orders->first()->currency ?? 'USD' }}</td>
        </tr>
    </table>

    <div class="footer">
        Thank you for purchasing our course. We hope it brings you valuable knowledge and success in your learning journey.
    </div>

</body>
</html>
