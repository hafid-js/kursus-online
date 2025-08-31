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
                            <h1>Profile</h1>
                            <ul>
                                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                                <li>Profile</li>
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
                @include('frontend.layouts.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Profile Details</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                            <div class="wsus__dashboard_contant_btn">
                                <a href="{{ route('instructor.profile.show') }}" class="common_btn">Edit Profile</a>
                            </div>
                        </div>
                        <div class="wsus__dashboard_profile">
                            <div class="text ms-0">
                                <h6>About Me</h6>
                                <p>{{ auth()->user()->bio ?? '-'}}.</p>
                            </div>
                        </div>
                        <ul class="wsus__dashboard_profile_info">
                            <li><span>Name :</span>{{ auth()->user()->name }}</li>
                            <li><span>Gender :</span>{{ auth()->user()->gender === 'female' ? 'Female' : (auth()->user()->gender === 'male' ? 'Male' : '-') }}</li>
                            {{-- <li><span>Contact :</span>+4425 545 955</li> --}}
                            {{-- <li><span>Birthday :</span>June 25, 1990</li> --}}
                            <li><span>Email :</span>{{ auth()->user()->email }}</li>
                            {{-- <li><span>Zip Code : </span>9946723</li>
                            <li><span>City :</span>dhaka</li>
                            <li><span>Country :</span>Bangladesh</li>
                            <li><span>Present Address : </span>uttora 07, dhaka-1230, DNCC, bangladesh.</li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                    DASHBOARD OVERVIEW END
                ============================-->
@endsection
