@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card">
                                    <div class="page-wrapper">
                                        <!-- BEGIN PAGE HEADER -->
                                        <div class="card-header">
                                            <h2 class="page-title">Account Settings</h2>
                                        </div>
                                        <!-- END PAGE HEADER -->
                                        <!-- BEGIN PAGE BODY -->
                                        <div class="page-body">
                                            <div class="container-xl">
                                                <div class="card">
                                                    <div class="row g-0">
                                                        @include('admin.setting.sidebar')
                                                        @yield('setting-content')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END PAGE BODY -->
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
