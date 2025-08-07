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
                            <h1>Course Sales</h1>
                            <ul>
                                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                                <li>Course Sales</li>
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
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Course Sales</h5>
                            </div>
                        </div>
                        <div class="wsus__dash_course_table">

                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Course Name</th>
                                    <th>Purchase By</th>
                                    <th>Price</th>
                                    <th>Commision</th>
                                    <th>Earning</th>
                                </thead>
                                <tbody>
                                    @forelse ($orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $orderItem->course->title }}</td>
                                            <td>{{ $orderItem->order->customer->name }}</td>
                                            <td>{{ $orderItem->price }}</td>
                                            <td>{{ $orderItem->commission_rate ?? 0 }}%</td>
                                            <td>{{ calculateCommission($orderItem->price, $orderItem->commission_rate) }}
                                                {{ $orderItem->order->currency }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                No Data Found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    </div>
    </section>
    <!--===========================
                        DASHBOARD OVERVIEW END
                    ============================-->
@endsection
