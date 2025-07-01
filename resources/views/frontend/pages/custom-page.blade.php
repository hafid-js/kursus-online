@extends('frontend.layouts.layout')
@push('header_scripts')
<style>
    p {
        margin-bottom: 15px;
    }
</style>
@endpush
@section('content')
    <section class="wsus__breadcrumb" style="background: url(frontend/images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Contact Us</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__contact_us mt_95 xs_mt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="wsus__contact_form_area mt_30 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                {!! $page->description !!}
            </div>
        </div>

    </section>
@endsection
