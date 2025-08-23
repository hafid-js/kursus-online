@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none mb-3" aria-label="Page header">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <h2 class="page-title">Instructor Details</h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('admin.instructors.index') }}" class="btn btn-primary">
                                <i class="ti ti-arrow-left"></i>
                                Back
                            </a>
                        </div>
                        <!-- BEGIN MODAL -->
                        <!-- END MODAL -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xl">
            <div class="row row-cards align-items-stretch">
                <div class="col-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">Information Details</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-5">Full Name:</dt>
                                <dd class="col-7">{{ $instructor->name }}</dd>
                                <dt class="col-5">Headline:</dt>
                                <dd class="col-7">{{ $instructor->headline ?? '-' }}</dd>
                                <dt class="col-5">Email:</dt>
                                <dd class="col-7">{{ $instructor->email }}</dd>
                                <dt class="col-5">Gender:</dt>
                                <dd class="col-7">{{ $instructor->gender ?? '-' }}</dd>
                                <dt class="col-5">Bio:</dt>
                                @php
                                    $fullBio = $instructor->bio ?? '-';
                                    $maxWords = 20;
                                    $words = str_word_count(strip_tags($fullBio), 1); // Pisah kata
                                    $shortBio = implode(' ', array_slice($words, 0, $maxWords));
                                    $needsToggle = count($words) > $maxWords;
                                @endphp

                                <dd class="col-7">
                                    @if ($needsToggle)
                                        <span class="short-bio">{{ $shortBio }}...</span>
                                        <span class="full-bio d-none">{{ $fullBio }}</span>
                                        <a href="javascript:void(0)" class="text-primary toggle-bio">Read More</a>
                                    @else
                                        {{ $fullBio }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>



                <div class="col-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h3 class="card-title">Session Details</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-5">Date:</dt>
                                <dd class="col-7">2020-01-05 16:42:29 UTC</dd>
                                {{-- <dt class="col-5">Account:</dt>
                                <dd class="col-7">tabler</dd> --}}
                                <dt class="col-5">Location:</dt>
                                <dd class="col-7"><span class="flag flag-1 flag-country-pl"></span> Poland</dd>
                                <dt class="col-5">IP Address:</dt>
                                <dd class="col-7">46.113.11.3</dd>
                                <dt class="col-5">Operating system:</dt>
                                <dd class="col-7">OS X 10.15.2 64-bit</dd>
                                <dt class="col-5">Browser:</dt>
                                <dd class="col-7">Chrome</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Courses</h4>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input id="custom-length" type="number" min="1"
                                            class="form-control form-control-sm" value="8" size="3"
                                            aria-label="Invoices count">
                                    </div>
                                    entries
                                </div>
                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input id="course-search" type="text" class="form-control form-control-sm"
                                            aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            {!! $courseDataTable->table(
                                ['id' => 'course-table', 'class' => 'table table-selectable card-table table-vcenter text-nowrap datatable'],
                                true,
                            ) !!}
                        </div>
                        <div class="card-footer">
                            <div class="row g-2 justify-content-center justify-content-sm-between">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="m-0 text-secondary" id="table-info">
                                        Showing <strong>0 to 0</strong> of <strong>0 entries</strong>
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <ul class="pagination m-0 ms-auto"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Student Course Enrolled</h4>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input id="custom-length" type="number" min="1"
                                            class="form-control form-control-sm" value="8" size="3"
                                            aria-label="Invoices count">
                                    </div>
                                    entries
                                </div>
                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input id="studentcourseenrolled-search" type="text"
                                            class="form-control form-control-sm" aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="d-flex gap-2">
                                    <a href="#" id="btnExportExcel" class="btn btn-sm btn-success">
                                        <i class="ti ti-file-export"></i> Excel
                                    </a>
                                    <a href="#" id="btnExportPdf" class="btn btn-sm btn-danger">
                                        <i class="ti ti-file"></i> PDF
                                    </a>
                                    <button id="btnPrint" class="btn btn-sm btn-primary">
                                        <i class="ti ti-printer"></i> Print
                                    </button>
                                    <button id="btnReset" class="btn btn-sm btn-warning">
                                        <i class="fa fa-refresh"></i> Reset
                                    </button>
                                    <button id="btnReload" class="btn btn-sm btn-secondary">
                                        <i class="ti ti-reload"></i> Reload
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            {!! $studentCourseEnrolledDataTable->table(
                                [
                                    'id' => 'studentcourseenrolled-table',
                                    'class' => 'table table-selectable card-table table-vcenter text-nowrap datatable',
                                ],
                                true,
                            ) !!}
                        </div>
                        <div class="card-footer">
                            <div class="row g-2 justify-content-center justify-content-sm-between">
                                <div class="col-auto d-flex align-items-center">
                                    <p class="m-0 text-secondary" id="table-info">
                                        Showing <strong>0 to 0</strong> of <strong>0 entries</strong>
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <ul class="pagination m-0 ms-auto"></ul>
                                </div>
                            </div>
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
    </div>


    <!-- Dynamic Modal -->
    <div class="modal fade" id="dynamic-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content dynamic-modal-content">
                <!-- Content injected via AJAX -->
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('header_scripts')
    @vite('resources/js/admin/course.js')
@endpush

@push('scripts')
    {!! $courseDataTable->scripts() !!}
    {!! $studentCourseEnrolledDataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            let courseDataTable = $('#course-table').DataTable();
            let studentCourseEnrolledDataTable = $('#studentcourseenrolled-table').DataTable();

            initTable('#course-table');
            initTable('#studentcourseenrolled-table');

            $('#course-search').on('keyup', function() {
                courseDataTable.search(this.value).draw();
            });

            $('#studentcourseenrolled-search').on('keyup', function() {
                studentCourseEnrolledDataTable.search(this.value).draw();
            });

            $('#btnReload').on('click', function() {
                table.ajax.reload(null, false);
            });

            $('#btnReset').on('click', function() {
                table.search('').columns().search('').order([]).page('first').draw();
                $('#custom-search').val('');
                $('input[type="checkbox"]').prop('checked', false);
            });

            $('#courseorders-table').on('draw.dt', function() {
                $('#select-all').off('click').on('click', function() {
                    const checked = $(this).is(':checked');
                    $('.order-checkbox').prop('checked', checked);
                });

                $(document).off('click', '.order-checkbox').on('click', '.order-checkbox', function() {
                    const total = $('.order-checkbox').length;
                    const checked = $('.order-checkbox:checked').length;

                    $('#select-all').prop('checked', total === checked);
                });
            });

            initTable('#courseorders-table');
        });

        $(function() {
            const baseUrl = "{{ url('') }}";
            const modalElement = document.getElementById('dynamic-modal');
            const dynamicModal = new bootstrap.Modal(modalElement);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // tombol untuk modal A
            $(document).on("click", ".show-order-courses", function(e) {
                const orderId = $(this).data('order-id');
                dynamicModal.show();
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/orders/${orderId}?modal=courses`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // tombol untuk modal B
            $(document).on("click", ".show-order-invoice", function(e) {
                const orderId = $(this).data('order-id');
                dynamicModal.show();
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/orders/${orderId}?modal=invoice`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });
        });



        $(document).ready(function() {
            function exportSelectedOrAll(type) {
                let selectedIds = [];
                $('.order-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    let url = `export/course-orders-pdf?type=${type}`;

                    let csrfToken = $('meta[name="csrf-token"]').attr('content');

                    let form = $('<form method="POST" action="' + url + '"></form>');

                    form.append('<input type="hidden" name="_token" value="' + csrfToken + '">');

                    selectedIds.forEach(id => {
                        form.append('<input type="hidden" name="ids[]" value="' + id + '">');
                    });

                    $('body').append(form);
                    form.submit();
                } else {
                    if (type === 'excel') {
                        window.location.href = "{{ route('admin.export.course-orders') }}";
                    } else if (type === 'pdf') {
                        window.location.href = "{{ route('admin.export.course-orders-pdf') }}";
                    }
                }
            }
            $('#btnExportExcel').click(function(e) {
                e.preventDefault();
                exportSelectedOrAll('excel');
            });

            $('#btnExportPdf').click(function(e) {
                e.preventDefault();
                exportSelectedOrAll('pdf');
            });
            $('#btnPrint').click(function() {
                window.print();
            });
        });

        // show full bio
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-bio').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const parent = this.closest('dd');
                    const shortBio = parent.querySelector('.short-bio');
                    const fullBio = parent.querySelector('.full-bio');

                    if (shortBio.classList.contains('d-none')) {
                        shortBio.classList.remove('d-none');
                        fullBio.classList.add('d-none');
                        this.textContent = 'Read More';
                    } else {
                        shortBio.classList.add('d-none');
                        fullBio.classList.remove('d-none');
                        this.textContent = 'Close';
                    }
                });
            });
        });
    </script>
@endpush
