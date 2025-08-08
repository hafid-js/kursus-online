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
                            <h1>Dashboard</h1>
                            <ul>
                                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                                <li>Dashboard</li>
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
                <div class="col-xl-9 col-md-8">
                    @if (auth()->user()->document_status === 'pending')
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                aria-label="Info:">
                                <use xlink:href="#info-fill" />
                            </svg>
                            <div>
                                Hi, {{ auth()->user()->name }} — your instructor request is currently
                                <strong>pending</strong>.
                                We'll notify you via email once it is approved.
                            </div>
                        </div>
                    @elseif (auth()->user()->document_status === 'rejected')
                        <div class="alert alert-danger d-flex align-items-center justify-content-between" role="alert">
                            <div class="d-flex align-items-center">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                    aria-label="Error:">
                                    <use xlink:href="#exclamation-triangle-fill" />
                                </svg>
                                <div>
                                    Hi, {{ auth()->user()->name }} — your instructor request was <strong>rejected</strong>.
                                    Please update your documents or contact support for assistance.
                                </div>
                            </div>

                            <!-- Tombol trigger modal -->
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#resubmitDocumentModal">
                                <i class="fas fa-paper-plane me-1"></i>Resubmit Document
                            </button>
                        </div>

                        <!-- Modal -->
                        <!-- Resubmit Document Modal -->
                        <!-- Modern Resubmit Document Modal -->
                        <div class="modal fade" id="resubmitDocumentModal" tabindex="-1"
                            aria-labelledby="resubmitDocumentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header border-0 pb-0">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-danger-subtle text-danger p-2 me-3">
                                                <i class="fas fa-file-upload fs-5"></i>
                                            </div>
                                            <h5 class="modal-title fw-semibold" id="resubmitDocumentModalLabel">
                                                Resubmit Rejected Document
                                            </h5>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('instructor.document.update', user()->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pt-0">
                                            <div class="mb-4">
                                                {{-- <label for="document" class="form-label fw-medium">Upload New
                                                    Document</label> --}}
                                                <x-input-file-block name="document" value="{{ auth()->user()->document }}"/>
                                                <small class="text-muted d-block mt-2">Accepted formats: PDF, JPG, PNG. Max
                                                    5MB.</small>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane me-1"></i> Submit Document
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (user()->role == 'student')
                        <div class="text-end">
                            <a href="{{ route('student.become-instructor') }}" class="btn btn-primary">Become a
                                Instructor</a>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>Pending Courses</h6>
                                <h3>{{ $pendingCourses }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>Approved Courses</h6>
                                <h3>{{ $approvedCourses }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>Rejected Courses</h6>
                                <h3>{{ $rejectedCourses }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading wow fadeInUp"
                                style="visibility: visible; animation-name: fadeInUp;">
                                <h5>Best Selling Courses</h5>
                            </div>
                        </div>

                        <div class="wsus__dash_course_table wow fadeInUp"
                            style="visibility: visible; animation-name: fadeInUp;">
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
                                                        SALES
                                                    </th>
                                                    <th class="amount">
                                                        AMOUNT
                                                    </th>
                                                </tr>
                                                @forelse ($bestSellingCourses as $data)
                                                    <tr>
                                                        <td class="image">
                                                            <div class="image_category">
                                                                <img src="{{ asset($data->course?->thumbnail) }}"
                                                                    alt="img" class="img-fluid w-100">
                                                            </div>
                                                        </td>
                                                        <td class="details">
                                                            <p class="rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $data->course?->reviews()->avg('rating'))
                                                                        <i class="fas fa-star"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                                <span>({{ number_format($data->course?->reviews()->avg('rating'), 1) ?? 0 }}
                                                                    Rating)</span>
                                                            </p>
                                                            <a class="title"
                                                                href="#">{{ $data->course?->title }}</a>

                                                        </td>
                                                        <td class="sale">
                                                            <p>{{ $data->total_buyers }}</p>
                                                        </td>
                                                        <td class="amount">
                                                            <p>${{ number_format($data->total_revenue, 2) }}</p>
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
    <!--===========================
                    DASHBOARD OVERVIEW END
                ============================-->
@endsection
