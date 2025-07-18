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
                                @if (Str::contains(request()->url(), '/create'))
                                  <h4 class="card-title">Course Create</h4>
                                @elseif (Str::contains(request()->url(), '/edit'))
                                     <h4 class="card-title">Edit Create</h4>
                                @else
                                    <li>Courses</li>
                                @endif
                                <div class="card-actions">
                                    <a href="{{ route('admin.courses.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="dashboard_add_courses">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        @php
                                    $isEdit = Str::contains(request()->url(), '/edit');
                               @endphp
                                <li class="nav-item" role="presentation">
                                    <a href="{{ $isEdit
                                        ? url('/admin/courses/' . $course->id . '/edit?step=1')
                                        : url('/admin/courses/create?step=1') }}"
                                        class="nav-link {{ request('step') == 1 ? 'active' : '' }}">
                                        Basic Infos
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="{{ $isEdit
                                        ? url('/admin/courses/' . $course->id . '/edit?step=2')
                                        : url('/admin/courses/create?step=2') }}"
                                        class="nav-link {{ request('step') == 2 ? 'active' : '' }}">
                                        More Info
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="{{ $isEdit
                                        ? url('/admin/courses/' . $course->id . '/edit?step=3')
                                        : url('/admin/courses/create?step=3') }}"
                                        class="nav-link {{ request('step') == 3 ? 'active' : '' }}">
                                        Course Contents
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a href="{{ $isEdit
                                        ? url('/admin/courses/' . $course->id . '/edit?step=4')
                                        : url('/admin/courses/create?step=4') }}"
                                        class="nav-link {{ request('step') == 4 ? 'active' : '' }}">
                                        Finish
                                    </a>
                                </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        @yield('tab_content')
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $('#lfm').filemanager('file', {
            prefix: '/admin/laravel-filemanager'
        });
    </script>
@endpush

@push('header_scripts')
    @vite(['resources/js/admin/course.js'])
@endpush
