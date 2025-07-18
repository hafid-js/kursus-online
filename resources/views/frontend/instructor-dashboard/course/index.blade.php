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
                                <h5>Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                                <a class="common_btn" href="{{ route('instructor.courses.create') }}">+ add course</a>
                            </div>
                        </div>

                        <form action="#" class="wsus__dash_course_searchbox">
                            <div class="input">
                                <input type="text" placeholder="Search our Courses">
                                <button><i class="far fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div class="selector">
                                <select class="add_course_basic_info_imput" style="display: none;">
                                    <option value="">Choose</option>
                                    <option value="">Choose 1</option>
                                    <option value="">Choose 2</option>
                                </select>
                                <div class="nice-select add_course_basic_info_imput" tabindex="0"><span
                                        class="current">Choose</span>
                                    <ul class="list">
                                        <li data-value="" class="option selected">Choose</li>
                                        <li data-value="" class="option">Choose 1</li>
                                        <li data-value="" class="option">Choose 2</li>
                                    </ul>
                                </div>
                            </div>
                        </form>

                        <div class="wsus__dash_course_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="image">
                                                        COURSES
                                                    </th>
                                                    <th class="details">

                                                    </th>
                                                    <th class="sale">
                                                        STUDENT
                                                    </th>
                                                    <th class="status">
                                                        STATUS
                                                    </th>
                                                    <th class="action">
                                                        ACTION
                                                    </th>
                                                </tr>
                                                @forelse ($courses as $course)
                                                    <tr>
                                                        <td class="image">
                                                            <div class="image_category">
                                                                <img src="{{ asset($course->thumbnail) }}" alt="img"
                                                                    class="img-fluid w-100">
                                                            </div>
                                                        </td>
                                                        <td class="details">
                                                            <p class="rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $course->reviews()->avg('rating'))
                                                                        <i class="fas fa-star"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                                <span>({{ number_format($course->reviews()->avg('rating'), 2) ?? 0 }}
                                                                    Rating)</span>
                                                            </p>
                                                            <a class="title" href="#">{{ $course->title }}</a>

                                                        </td>
                                                        <td class="sale">
                                                            <p>{{ $course->enrollments()->count() }}</p>
                                                        </td>
                                                        <td class="status">
                                                            <p
                                                                class="{{ $course->status === 'active' ? 'active' : 'delete' }}">
                                                                {{ $course->status === 'active' ? 'Active' : 'Inactive' }}
                                                            </p>
                                                        </td>
                                                        <td class="action">
                                                            <a class="edit"
                                                                href="{{ route('instructor.courses.edit', ['id' => $course->id, 'step' => 1]) }}"><i
                                                                    class="far fa-edit" aria-hidden="true"></i></a>

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="4">
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
