

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
                                <h4 class="card-title">Course Create</h4>
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
                                        <li class="nav-item" role="presentation ">
                                            <a href="" class="nav-link course-tab {{ request('step') == 1 ? 'active' : '' }}" data-step="1">Basic Infos</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="" class="nav-link course-tab {{ request('step') == 2 ? 'active' : '' }}" data-step="2">More Info</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="" class="nav-link course-tab {{ request('step') == 3 ? 'active' : '' }}" data-step="3">Course Contents</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="" class="nav-link course-tab {{ request('step') == 4 ? 'active' : '' }}" data-step="4" >Finish</a>
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
        $('#lfm').filemanager('file', {prefix: '/admin/laravel-filemanager'});
    </script>

@endpush

@push('header_scripts')
@vite(['resources/js/admin/course.js'])
@endpush

