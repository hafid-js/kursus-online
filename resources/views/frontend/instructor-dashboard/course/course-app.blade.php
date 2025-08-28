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
                @include('frontend.layouts.sidebar')

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

                               @php
                                    $isEdit = Str::contains(request()->url(), '/edit');
                               @endphp
                                <li class="nav-item" role="presentation">
                                    <a href="{{ $isEdit
                                        ? url('/instructor/courses/' . $course->id . '/edit?step=1')
                                        : url('/instructor/courses/create?step=1') }}"
                                        class="nav-link {{ request('step') == 1 ? 'active' : '' }}">
                                        Basic Infos
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="{{ $isEdit
                                        ? url('/instructor/courses/' . $course->id . '/edit?step=2')
                                        : url('/instructor/courses/create?step=2') }}"
                                        class="nav-link {{ request('step') == 2 ? 'active' : '' }}">
                                        More Info
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="{{ $isEdit
                                        ? url('/instructor/courses/' . $course->id . '/edit?step=3')
                                        : url('/instructor/courses/create?step=3') }}"
                                        class="nav-link {{ request('step') == 3 ? 'active' : '' }}">
                                        Course Contents
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="{{ $isEdit
                                        ? url('/instructor/courses/' . $course->id . '/edit?step=4')
                                        : url('/instructor/courses/create?step=4') }}"
                                        class="nav-link {{ request('step') == 4 ? 'active' : '' }}">
                                        Finish
                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                @yield('course_content')
                            </div>
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
