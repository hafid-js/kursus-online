@extends('frontend.layouts.layout')

@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Courses</h1>
                            <ul>
                                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                                @if (Str::contains(request()->url(), '/create'))
                                    <li>Add Courses</li>
                                @elseif (Str::contains(request()->url(), '/edit'))
                                    <li>Edit Courses</li>
                                @else
                                    <li>Courses</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.instructor-dashboard.sidebar')

                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading relative">
                                @if (Str::contains(request()->url(), '/edit'))
                                    <h5>Edit Courses</h5>
                                @elseif (Str::contains(request()->url(), '/create'))
                                    <h5>Add Courses</h5>
                                @else
                                    <h5>Courses</h5>
                                @endif
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <div class="dashboard_add_courses">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation ">
                                    <a href="" class="nav-link course-tab {{ request('step') == 1 ? 'active' : '' }}"
                                        data-step="1">Basic Infos</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link course-tab {{ request('step') == 2 ? 'active' : '' }}"
                                        data-step="2">More Info</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link course-tab {{ request('step') == 3 ? 'active' : '' }}"
                                        data-step="3">Course Contents</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="" class="nav-link course-tab {{ request('step') == 4 ? 'active' : '' }}"
                                        data-step="4">Finish</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                @yield('course_content')
                            </div>
                             @if (request()->query('step') == 3)
                                    <div class="text-end mt-3">
                                        <a href="{{ url('/instructor/courses/' . $courseId . '/edit?step=4') }}"
                                            class="btn btn-primary">
                                            Finish
                                        </a>
                                    </div>
                                @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('header_scripts')
    @vite('resources/js/frontend/course.js')
@endpush
