@extends('frontend.layouts.layout')

@section('content')
 <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Students</h1>
                            <ul>
                                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                                <li>Students</li>
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
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading">
                                <h5>Students</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <form action="#" class="wsus__dashboard_searchbox">
                            <input type="text" placeholder="Student Profile Name">
                            <button class="common_btn">Search</button>
                        </form>

                        <div class="wsus__dash_student_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="inlineCheckbox1" value="option1">
                                                            <label class="form-check-label" for="inlineCheckbox1">STUDENT
                                                                NAME</label>
                                                        </div>
                                                    </th>
                                                     <th class="date">
                                                        ENROLLED
                                                    </th>
                                                    <th class="date">
                                                        COURSE
                                                    </th>


                                                    <th class="progres">
                                                        PROGRESS
                                                    </th>

                                                </tr>
                                                @forelse ($students as $student)
                                                    <tr>
                                                        <td class="name">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox11" value="option1">
                                                        </div>
                                                        <div class="img">
                                                            <img src="{{ $student->order->customer->image ? asset($student->order->customer->image) : url('frontend/assets/images/image-profile.png') }}" alt="student" class="img-fluid w-100">
                                                        </div>
                                                        <a href="#">{{ $student->order->customer->name }}</a>
                                                    </td>
                                                     <td class="date">
                                                            <p> {{ $student->order->created_at }}</p>
                                                        </td>
                                                        <td class="date">
                                                            <p class="title">{{ $student->course->title }}</p>
                                                        </td>


                                                        <td class="progres">
                                                            <p>{{ $student->watchedCount }} of {{ $student->lessonCount }}
                                                                ({{ $student->progressPercent }}%)
                                                            </p>
                                                        </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="3">
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
                </div>
            </div>
        </div>
    </section>
@endsection
