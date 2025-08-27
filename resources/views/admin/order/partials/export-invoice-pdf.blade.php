<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 6px;
        }

        .totals {
            margin-top: 10px;
            width: 100%;
        }

        .totals td {
            border: none;
        }

        .footer {
            margin-top: 20px;
            font-size: 11px;
        }


    </style>
</head>

<body>

    @foreach ($groupedOrders as $orderId => $orders)
        <div class="invoice-box">
            <div class="title">Invoice</div>

            <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <div style="text-align: left;">
                    <strong>Company:</strong> {{ config('settings.site_name') }}<br>
                    <strong>Phone:</strong> {{ config('settings.phone') }}<br>
                    <strong>Address:</strong> {{ config('settings.location') }}
                </div>

                <div style="text-align: right;">
                    <strong>Client:</strong><br>
                    {{ $orders->first()->student ?? 'Unknown' }}<br>
                    {{ $orders->first()->email ?? 'No email' }}
                </div>
            </div>


            <br>

            <div>
                <div>
                    <strong>Invoice #:</strong> {{ strtoupper($orders->first()->invoice_id) ?? 'N/A' }}
                </div>
                <div>
                    <strong>Order Date:</strong> {{ strtoupper($orders->first()->created_at) ?? 'N/A' }}
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Instructor</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($orders as $order)
                        @php
                            $price = $order->course_price;
                            $discount = $order->course_discount ?? 0;
                            $final = $price - ($price * $discount) / 100;
                            $total += $final;
                        @endphp
                        <tr>
                            <td>{{ $order->course_title }}</td>
                            <td>{{ $order->instructor }}</td>
                            <td>1</td>
                            <td>Rp.{{ number_format($price, 2) }}</td>
                            <td>{{ $discount }}%</td>
                            <td>Rp.{{ number_format($final, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="totals" style="width: auto; margin-left: auto;">
                <tr>
                    <td style="text-align: right; padding-right: 5px;"><strong>Total:</strong></td>
                    <td style="text-align: left;">
                        Rp.{{ number_format($total, 2) }} {{ $orders->first()->currency ?? 'USD' }}
                    </td>
                </tr>
            </table>

            <div class="footer">
                Thank you for purchasing our course. We hope it brings you valuable knowledge and success in your
                learning journey.
            </div>
        </div>

        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach

</body>

</html>
