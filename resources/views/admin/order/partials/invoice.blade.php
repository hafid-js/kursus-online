<div class="modal-header">
    <h5 class="modal-title">Invoice</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="card card-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p class="h3">Company</p>
                        <address>
                            {{ config('settings.site_name') }}<br>
                            {{ config('settings.phone') }}<br>
                            {{ config('settings.location') }}<br>

                        </address>
                    </div>
                    <div class="col-6 text-end">
                        <p class="h3">Client</p>
                        <address>
                            {{ $order->customer->name }} <br>
                            {{ $order->customer->email }}
                        </address>
                    </div>
                    <div class="col-12 my-5">
                        <h1>Invoice #{{ strtoupper($order->invoice_id) }}</h1>
                    </div>
                </div>
                <table class="table table-transparent table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 1%"></th>
                            <th>Product</th>
                            <th class="text-center" style="width: 1%">Qnt</th>
                            <th class="text-end" style="width: 4%">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <p class="strong mb-1">{{ $item->course->title }}</p>
                                    <div class="text-secondary">By
                                        {{ $item->course->instructor->name }}</div>
                                </td>
                                <td class="text-center">
                                    1
                                </td>
                                <td class="text-end">Rp.{{ $item->price }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="strong text-end">Subtotal</td>
                            <td class="text-end">Rp.{{ $order->total_amount }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="strong text-end">Paid Amount</td>
                            <td class="text-end">Rp.{{ $order->paid_amount }}
                                {{ $order->currency }}</td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-secondary text-center mt-5">Thank you for purchasing our course. We hope it
                    brings you valuable knowledge and success in your learning journey.</p>
            </div>
        </div>
    </div>
</div>
