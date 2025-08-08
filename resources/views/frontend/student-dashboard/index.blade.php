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
                            <h1>Student Dashboard</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Student Dashboard</li>
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
                @include('frontend.student-dashboard.sidebar')
                <div class="col-xl-9 col-md-8">
                    @if (auth()->user()->document_status === 'pending')
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </symbol>
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                            </symbol>
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </symbol>
                        </svg>

                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                aria-label="Info:">
                                <use xlink:href="#info-fill" />
                            </svg>
                            <div>
                                Hi, {{ auth()->user()->name }} your instructor request is curretly pending. We will send a
                                mail on your email when it will be approved.
                            </div>
                        </div>
                    @elseif(auth()->user()->document_status === 'rejected')
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

                            <div class="text-end">
                                <button data-bs-toggle="modal" data-bs-target="#resubmitDocumentModal"
                                    class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i> Resubmit
                                    Document</button>
                            </div>
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

                                    <form action="{{ route('student.become-instructor.update', user()->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pt-0">
                                            <div class="mb-4">
                                                {{-- <label for="document" class="form-label fw-medium">Upload New
                                                    Document</label> --}}
                                                <x-input-file-block name="document"
                                                    value="{{ auth()->user()->document }}" />
                                                <small class="text-muted d-block mt-2">Accepted formats: PDF, JPG, PNG. Max
                                                    5MB.</small>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane me-1"></i> Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-end">
                            <button data-bs-toggle="modal" data-bs-target="#submitDocumentModal"
                                class="btn btn-primary">Become a Instructor</button>
                        </div>
                        <div class="modal fade" id="submitDocumentModal" tabindex="-1"
                            aria-labelledby="submitDocumentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header border-0 pb-0">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-danger-subtle text-danger p-2 me-3">
                                                <i class="fas fa-file-upload fs-5"></i>
                                            </div>
                                            <h5 class="modal-title fw-semibold" id="submitDocumentModalLabel">
                                                Upload Document
                                            </h5>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="{{ route('student.become-instructor.update', user()->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body pt-0">
                                            <div class="mb-4">
                                                {{-- <label for="document" class="form-label fw-medium">Upload New
                                                    Document</label> --}}
                                                <x-input-file-block name="document" />
                                                <small class="text-muted d-block mt-2">Accepted formats: PDF, JPG, PNG. Max
                                                    5MB.</small>
                                            </div>
                                        </div>

                                        <div class="modal-footer border-0 pt-0">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-paper-plane me-1"></i> Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>Enrolled Courses</h6>
                                <h3>{{ $userCourses }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>Total Reviews</h6>
                                <h3>{{ $reviewCount }}</h3>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 wow fadeInUp">
                            <div class="wsus__dash_earning">
                                <h6>Order</h6>
                                <h3>{{ $orderCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="wsus__dash_course_table">

                            <table class="table">
                                <thead>
                                    <th>No.</th>
                                    <th>Invoice</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @forelse ($orderItems as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order->invoice_id }}</td>
                                            <td>{{ $order->total_amount }} {{ $order->currency }}</td>
                                            <td><span class="badge bg-success text-green-fg">{{ $order->status }}</span>
                                            </td>
                                            <td><a href="{{ route('student.orders.show', $order->id) }}">View</a></td>
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
    </section>
    <!--===========================
            DASHBOARD OVERVIEW END
        ============================-->
@endsection
