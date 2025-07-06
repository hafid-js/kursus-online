
@php
    $topbar = \App\Models\TopBar::first();
@endphp
    <!--===========================
        HEADER START
    ============================-->
    <header class="header_3">
        <div class="row">
            <div class="col-xxl-4 col-lg-7 col-md-8 d-none d-md-block">
                <ul class="wsus__header_left d-flex flex-wrap">
                    <li><a href="mailto:{{ $topbar?->email }}"><i class="fas fa-envelope"></i> {{ $topbar?->email }}</a></li>
                    <li><a href="callto:{{ $topbar?->phone }}"><i class="fas fa-phone-alt"></i> {{ $topbar?->phone }}</a></li>
                </ul>
            </div>
            <div class="col-xxl-5 col-lg-7 d-none d-xxl-block">
                <div class="wsus__header_center">
                    <p> <span>{{ $topbar?->offer_name }}</span> {{ $topbar?->offer_short_description }} <a
                            href="{{ $topbar?->offer_button_url }}">{{ $topbar?->offer_button_text }}</a></p>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-5 col-md-4">

            </div>
        </div>
    </header>
    <!--===========================
        HEADER END
    ============================-->
