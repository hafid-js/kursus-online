@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">Course</h4>
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
                            <div class="page-body">
                                <div class="container-xl">
                                    <div class="row row-cards">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table class="table table-vcenter card-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Price</th>
                                                                <th>Instructor</th>
                                                                <th>Status</th>
                                                                <th>Approve</th>
                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($courses as $course)
                                                                <tr id="row-{{ $course->id }}">
                                                                    <td>{{ $course->title }}</td>
                                                                    <td>{{ $course->price }}</td>
                                                                    <td>{{ $course->instructor->name }}</td>
                                                                    <td>
                                                                        @if ($course->is_approved == 'pending')
                                                                            <span
                                                                                class="badge bg-yellow text-yellow-fg">Pending</span>
                                                                        @elseif ($course->is_approved == 'approved')
                                                                            <span
                                                                                class="badge bg-green text-green-fg">Approved</span>
                                                                        @elseif ($course->is_approved == 'rejected')
                                                                            <span
                                                                                class="badge bg-red text-red-fg">Rejected</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <select name=""
                                                                            class="form-control update-approval-status"
                                                                            data-id="{{ $course->id }}">
                                                                            <option @selected($course->is_approved == 'pending')
                                                                                value="pending">Pending</option>
                                                                            <option @selected($course->is_approved == 'approved')
                                                                                value="approved">Approved</option>
                                                                            <option @selected($course->is_approved == 'rejected')
                                                                                value="rejected">Rejected</option>
                                                                        </select>
                                                                    </td>

                                                                    <td>
                                                                        <a href="{{ route('admin.courses.edit', ['id' => $course->id, 'step' => 1]) }}"
                                                                            class="text-blue">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="24" height="24"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path
                                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                                <path
                                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                                <path d="M16 5l3 3" />
                                                                            </svg>
                                                                            </a>
                                                                         {{-- <a href="{{ route('admin.courses.destroy', $course->id) }}" class="text-red delete-item">
                                                                            <i class="ti ti-trash"></i>
                                                                        </a> --}}
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header_scripts')
    @vite('resources/js/admin/course.js')
@endpush
