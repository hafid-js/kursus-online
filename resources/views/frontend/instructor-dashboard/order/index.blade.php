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
                                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                                <li>Orders</li>
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
                {{-- <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading">
                                <h5>Orders</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <div class="wsus__dash_order_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="details">
                                                        COURSES
                                                    </th>
                                                    <th class="sale">
                                                        SALES
                                                    </th>
                                                    <th class="invoice">
                                                        INVOICE
                                                    </th>
                                                    <th class="date">
                                                        DATE
                                                    </th>
                                                    <th class="method">
                                                        METHOD
                                                    </th>
                                                    <th class="icon">

                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td class="details">
                                                        <p class="rating">
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                            <i class="far fa-star" aria-hidden="true"></i>
                                                            <span>(5.0)</span>
                                                        </p>
                                                        <a class="title" href="#">Complete Blender Creator Learn
                                                            3D Modelling.</a>

                                                    </td>
                                                    <td class="sale">
                                                        <p>20</p>
                                                    </td>
                                                    <td class="invoice">
                                                        <p>#11029</p>
                                                    </td>
                                                    <td class="date">
                                                        <p>10-05-20 </p>
                                                    </td>
                                                    <td class="method">
                                                        <p>Visa</p>
                                                    </td>
                                                    <td class="icon">
                                                        <a href="dashboard_invoice.html">
                                                            <img src="images/eye.png" alt="eye" class="img-fluid w-100">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="details">
                                                        <p class="rating">
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                            <i class="far fa-star" aria-hidden="true"></i>
                                                            <span>(5.0)</span>
                                                        </p>
                                                        <a class="title" href="#">Learn and Understand AngularJS to
                                                            Professional Developer</a>

                                                    </td>
                                                    <td class="sale">
                                                        <p>44</p>
                                                    </td>
                                                    <td class="invoice">
                                                        <p>#12026</p>
                                                    </td>
                                                    <td class="date">
                                                        <p>10-05-20 </p>
                                                    </td>
                                                    <td class="method">
                                                        <p>Mastercard</p>
                                                    </td>
                                                    <td class="icon">
                                                        <a href="dashboard_invoice.html">
                                                            <img src="images/eye.png" alt="eye" class="img-fluid w-100">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="details">
                                                        <p class="rating">
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                            <i class="far fa-star" aria-hidden="true"></i>
                                                            <span>(5.0)</span>
                                                        </p>
                                                        <a class="title" href="#">Complete Blender Creator Learn
                                                            3D Modelling.</a>

                                                    </td>
                                                    <td class="sale">
                                                        <p>56</p>
                                                    </td>
                                                    <td class="invoice">
                                                        <p>#10324</p>
                                                    </td>
                                                    <td class="date">
                                                        <p>18-08-20 </p>
                                                    </td>
                                                    <td class="method">
                                                        <p>Visa</p>
                                                    </td>
                                                    <td class="icon">
                                                        <a href="dashboard_invoice.html">
                                                            <img src="images/eye.png" alt="eye" class="img-fluid w-100">
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="details">
                                                        <p class="rating">
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                            <i class="fas fa-star-half-alt" aria-hidden="true"></i>
                                                            <i class="far fa-star" aria-hidden="true"></i>
                                                            <span>(5.0)</span>
                                                        </p>
                                                        <a class="title" href="#">Responsive Web Design Essentials HTML5
                                                            CSS3 and Bootstrap</a>

                                                    </td>
                                                    <td class="sale">
                                                        <p>67</p>
                                                    </td>
                                                    <td class="invoice">
                                                        <p>#12026</p>
                                                    </td>
                                                    <td class="date">
                                                        <p>10-05-20 </p>
                                                    </td>
                                                    <td class="method">
                                                        <p>Mastercard</p>
                                                    </td>
                                                    <td class="icon">
                                                        <a href="dashboard_invoice.html">
                                                            <img src="images/eye.png" alt="eye" class="img-fluid w-100">
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <table class="table">
                            <thead>
                                <th>Course Name</th>
                                <th>Purchase By</th>
                                <th>Price</th>
                                <th>Commission</th>
                                <th>Earning</th>
                            </thead>
                            <tbody>
                                @forelse ($orderItems as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->course->title }}</td>
                                        <td>{{ $orderItem->order->customer->name }}</td>
                                        <td>{{ $orderItem->price }}</td>
                                        <td>{{ $orderItem->commission_rate ?? 0  }}%</td>
                                        <td>{{ calculateCommission($orderItem->price, $orderItem->commission_rate) }} {{ $orderItem->order->currency }}</td>
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
    </section>
    <!--===========================
                    DASHBOARD OVERVIEW END
                ============================-->
@endsection
