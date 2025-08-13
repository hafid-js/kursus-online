@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Courses</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 5l0 14"></path>
                                            <path d="M5 12l14 0"></path>
                                        </svg>
                                        Add new
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Instructor</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Approve</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($courses as $course)
                                                <tr id="row-{{ $course->id }}">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $course->title }}</td>
                                                    <td>{{ config('settings.currency_icon') }}{{ $course->price }}</td>
                                                    <td>
                                                        <div class="d-flex py-1 align-items-center">
                                                            @if (!empty($course->instructor->image))
                                                                <span class="avatar avatar-2 me-2"
                                                                    style="background-image: url({{ asset($course->instructor->image) }})"></span>
                                                            @else
                                                                <span
                                                                    class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">
                                                                    {{ getUserInitials($course->instructor->name) }}
                                                                </span>
                                                            @endif
                                                            <div class="flex-fill">
                                                                <div class="font-weight-medium">
                                                                    {{ $course->instructor->name }}</div>
                                                                <div class="text-secondary"><a href="#"
                                                                        class="text-reset">{{ $course->instructor->email }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ format_to_date($course->created_at) }}</td>
                                                    <td>
                                                        @if ($course->is_approved == 'pending')
                                                            <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                                        @elseif ($course->is_approved == 'approved')
                                                            <span class="badge bg-green text-green-fg">Approved</span>
                                                        @elseif ($course->is_approved == 'rejected')
                                                            <span class="badge bg-red text-red-fg">Rejected</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <select name="" class="form-control update-approval-status"
                                                            data-id="{{ $course->id }}">
                                                            <option @selected($course->is_approved == 'pending') value="pending">Pending
                                                            </option>
                                                            <option @selected($course->is_approved == 'approved') value="approved">Approved
                                                            </option>
                                                            <option @selected($course->is_approved == 'rejected') value="rejected">Rejected
                                                            </option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.courses.edit', ['id' => $course->id, 'step' => 1]) }}"
                                                            class="text-blue">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No Data Found!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header_scripts')
    @vite('resources/js/admin/course.js')
@endpush
