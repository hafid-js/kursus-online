@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none" aria-label="Page header">
            <div class="container-xl">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="page-title">Students</h2>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="input-icon w-100" style="max-width: 300px; margin-left: auto;">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search…"
                                aria-label="Search">
                            <span class="input-icon-addon">
                                <!-- Icon search -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="icon icon-1">
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                    <path d="M21 21l-6 -6"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- BEGIN PAGE BODY -->
        <div class="page-body">
              <div class="container-xl">
                <div class="row row-cards">
                    <div class="container-xl">
                        <div id="user-results">
                            {{-- AJAX content will be injected here --}}
                        </div>
                    </div>

                </div>
            </div>
            <!-- END PAGE BODY -->
            <!--  BEGIN FOOTER  -->
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="https://docs.tabler.io" target="_blank"
                                        class="link-secondary" rel="noopener">Documentation</a></li>
                                <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary"
                                        rel="noopener">Source code</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary"
                                        rel="noopener">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/heart -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon text-pink icon-inline icon-4">
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572">
                                            </path>
                                        </svg>
                                        Sponsor
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright © 2025
                                    <a href="." class="link-secondary">Tabler</a>. All rights reserved.
                                </li>
                                <li class="list-inline-item">
                                    <a href="./changelog.html" class="link-secondary" rel="noopener"> v1.4.0 </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
            <!--  END FOOTER  -->
        </div>
    @endsection

    @push('scripts')
        <script>
            function fetchStudents(page = 1, search = '') {
                $.ajax({
                    url: "{{ route('admin.students.index') }}",
                    type: 'GET',
                    data: {
                        page: page,
                        search: search
                    },
                    success: function(response) {
                        $('#user-results').html(response);
                    },
                    error: function() {
                        $('#user-results').html('<p class="text-danger">Failed to load data.</p>');
                    }
                });
            }

            $(document).ready(function() {
                // Initial load
                fetchStudents();

                // Live search
                $('#searchInput').on('keyup', function() {
                    let search = $(this).val();
                    fetchStudents(1, search);
                });

                // Handle pagination clicks
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    let search = $('#searchInput').val();
                    fetchStudents(page, search);
                });
            });
        </script>
    @endpush
