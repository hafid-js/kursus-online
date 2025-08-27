@extends('frontend.layouts.layout')
@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Cart</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__cart_view mt_120 xs_mt_100 pb_120 xs_pb_100">
        @if (count($cart) > 0)
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="cart_list">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="pro_img">Product</th>

                                            <th class="pro_name"></th>

                                            <th class="pro_tk">Price</th>

                                            {{-- <th class="pro_select">Quantity</th>

                                        <th class="pro_tk">Subtotal</th> --}}

                                            <th class="pro_icon">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cart as $item)
                                            <tr>
                                                <td class="pro_img">
                                                    <img src="{{ asset($item->course->thumbnail) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </td>

                                                <td class="pro_name">
                                                    <a
                                                        href="{{ route('courses.show', $item->course->slug) }}">{{ $item->course->title }}</a>
                                                </td>
                                                <td class="pro_tk">
                                                    @if ($item->course->discount > 0)
                                                        <del>
                                                            <strong
                                                                class="text-primary">Rp.{{ $item->course->price }}</strong>
                                                        </del>
                                                        @php
                                                            $discount = $item->course->discount ?? 0;
                                                            $price = $item->course->price ?? 0;
                                                            $finalPrice =
                                                                $discount > 0
                                                                    ? $price - ($price * $discount) / 100
                                                                    : $price;
                                                        @endphp

                                                        <div class="d-flex align-items-center">
                                                            <span>Discount: {{ $discount }}%</span>
                                                            <span class="ms-2">
                                                                (Final Price:
                                                                <strong
                                                                    class="text-primary">Rp.{{ number_format($finalPrice, 2) }}</strong>)
                                                            </span>
                                                        </div>
                                                    @else
                                                        <strong class="text-primary">Rp.{{ $item->course->price }}</strong>
                                                    @endif
                                                </td>
                                                {{--
                                        <td class="pro_select">
                                            <div class="quentity_btn">
                                                <a href="#"><i class="fal fa-times" aria-hidden="true"></i></a>
                                            </div>
                                        </td>

                                        <td class="pro_tk">
                                            <h6>$99.00</h6>
                                        </td> --}}

                                                <td class="pro_icon">
                                                    <a href="{{ route('remove-from-cart', $item->id) }}"><i
                                                            class="fal fa-times" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <p>No Data Found</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-xxl-7 col-md-5 col-lg-6 wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="continue_shopping">
                            <a href="{{ route('courses.index') }}" class="common_btn"><i class="fa fa-plus"></i> Add More</a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-7 col-lg-6 wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="total_price">
                            <div class="subtotal_area">
                                <h5>Total :<span>Rp.{{ cartTotal() }}</span></h5>
                                <a href="{{ route('checkout.index') }}" class="common_btn">proceed checkout<i class="fa fa-arrow-right"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container text-center">
                <img style="width: 200px !important" src="{{ asset('default-files/empty-cart.png') }}" alt="">
                <h6 class="mt-2">Your cart is empty</h6>
            </div>
        @endif

    </section>
@endsection
