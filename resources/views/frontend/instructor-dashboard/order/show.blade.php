@extends('frontend.layouts.layout')

@section('content')
    <!--===========================
                                        BREADCRUMB START
                                    ============================-->
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Orders</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Invoices</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                                        BREADCRUMB END
                                    ============================-->


    <!--===========================
                                        DASHBOARD OVERVIEW START
                                    ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.instructor-dashboard.sidebar')

                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__invoice_top">
                            <div class="wsus__invoice_logo">
                                <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo"
                                    class="img-fluid w-100">
                            </div>
                            <div class="wsus__invoice_heading">
                                <h2>INVOICE</h2>
                            </div>
                        </div>
                        <div class="wsus__invoice_description">
                            <h4>Invoice to:</h4>
                            <div class="row justify-content-between">
                                <div class="col-xl-6 col-sm-6">
                                    <div class="wsus__invoice_address">
                                        <h5> {{ $order->customer->name }}</h5>
                                        <p> {{ $order->customer->email }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-5">
                                    <div class="wsus__invoice_date">
                                        <h5>Invoice#<span>{{ $order->invoice_id }}</span></h5>
                                        <h5 class="date">Date<span>{{ $order->created_at }}</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wsus__invoice_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="serial">
                                                        SL
                                                    </th>
                                                    <th class="description">
                                                        Item Description
                                                    </th>

                                                    <th class="price">
                                                    </th>
                                                     <th class="quantity">
                                                        Quantity
                                                    </th>
                                                     <th class="total">
                                                        Price
                                                    </th>
                                                </tr>
                                                @foreach ($order->orderItems as $item)
                                                    <tr>
                                                        <td class="serial">
                                                            <p>1</p>
                                                        </td>
                                                        <td class="description">
                                                            <p class="strong mb-1">{{ $item->course->title }}</p>
                                                            <div class="text-secondary">By
                                                                {{ $item->course->instructor->name }}</div>
                                                        </td>
                                                        <td class="price">

                                                        </td>
                                                        <td class="quantity">
                                                            <p>1</p>
                                                        </td>
                                                        <td class="total">
                                                            <p>${{ $item->price }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="wsus__invoice_final_total">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="wsus__invoice_final_total_left">
                                        {{-- <p>Thank you for your business</p> --}}
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__invoice_final_total_right">
                                        <h6>Subtotal:<span>${{ $order->total_amount }}</span></h6>
                                        <h5>Paid Amount: <span>${{ $order->paid_amount }}
                                                {{ $order->currency }}</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__invoice_bottom">
                            <p>{{ config('settings.location') }} <span> {{ config('settings.phone') }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                                        DASHBOARD OVERVIEW END
                                    ============================-->
@endsection
