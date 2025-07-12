@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">Orders</h4>
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
                                                    <h1>Invoice #{{ $order->invoice_id }}</h1>
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
                                                            <td class="text-end">${{ $item->price }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="3" class="strong text-end">Subtotal</td>
                                                        <td class="text-end">${{ $order->total_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="strong text-end">Paid Amount</td>
                                                        <td class="text-end">${{ $order->paid_amount }}
                                                            {{ $order->currency }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="text-secondary text-center mt-5">Thank you very much for doing
                                                business with us. We look forward to working with you again!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
