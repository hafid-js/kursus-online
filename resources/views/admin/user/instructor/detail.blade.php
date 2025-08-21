@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">

        <!-- END PAGE HEADER -->
        <!-- BEGIN PAGE BODY -->
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
                                <h3 class="card-title">User Informations</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <!-- SVG icon book -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon me-2 text-secondary icon-2">
                                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
                                        <path d="M3 6l0 13"></path>
                                        <path d="M12 6l0 13"></path>
                                        <path d="M21 6l0 13"></path>
                                    </svg>
                                    Went to: <strong>University of Ljubljana</strong>
                                </div>
                                <div class="mb-2">
                                    <!-- SVG icon briefcase -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon me-2 text-secondary icon-2">
                                        <path
                                            d="M3 7m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path>
                                        <path d="M12 12l0 .01"></path>
                                        <path d="M3 13a20 20 0 0 0 18 0"></path>
                                    </svg>
                                    Worked at: <strong>Devpulse</strong>
                                </div>
                                <div class="mb-2">
                                    <!-- SVG icon home -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon me-2 text-secondary icon-2">
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                    </svg>
                                    Lives in: <strong>Šentilj v Slov. Goricah, Slovenia</strong>
                                </div>
                                <div class="mb-2">
                                    <!-- SVG icon map-pin -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon me-2 text-secondary icon-2">
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                        <path
                                            d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z">
                                        </path>
                                    </svg>
                                    From: <strong><span class="flag flag-xs flag-country-si"></span> Slovenia</strong>
                                </div>
                                <div class="mb-2">
                                    <!-- SVG icon calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon me-2 text-secondary icon-2">
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                                        </path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                    Birth date: <strong>13/01/1985</strong>
                                </div>
                                <div>
                                    <!-- SVG icon clock -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon me-2 text-secondary icon-2">
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 7v5l3 3"></path>
                                    </svg>
                                    Time zone: <strong>Europe/Ljubljana</strong>
                                </div>
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
                                    <dt class="col-5">Account:</dt>
                                    <dd class="col-7">tabler</dd>
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
                                            <input id="custom-search" type="text" class="form-control form-control-sm"
                                                aria-label="Search invoice">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                {!! $dataTable->table(
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
                                <h4 class="card-title">Students Enrolled Course</h4>
                            </div>
                            <div class="card card-lg">
                                <div class="table-responsive">
                                    <div id="courseorders-table_wrapper" class="dt-container dt-bootstrap5">
                                        <table
                                            class="table table-selectable card-table table-vcenter text-nowrap datatable dataTable"
                                            id="courseorders-table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>
                                                        <div class="dt-column-header"><span
                                                                class="d-flex justify-content-start">Course</span>
                                                        </div>
                                                    </th>
                                                    <th title="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Student&lt;/span&gt;"
                                                        data-dt-column="3" rowspan="1" colspan="1"
                                                        class="dt-orderable-asc dt-orderable-desc">
                                                        <div class="dt-column-header"><span class="dt-column-title"><span
                                                                    class="d-flex justify-content-start">Student</span></span><span
                                                                class="dt-column-order" role="button"
                                                                aria-label="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Student&lt;/span&gt;: Activate to sort"
                                                                tabindex="0"></span></div>
                                                    </th>
                                                    <th title="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Total Amount&lt;/span&gt;"
                                                        data-dt-column="4" rowspan="1" colspan="1"
                                                        class="dt-orderable-asc dt-orderable-desc dt-type-numeric">
                                                        <div class="dt-column-header"><span class="dt-column-title"><span
                                                                    class="d-flex justify-content-start">Price</span></span><span
                                                                class="dt-column-order" role="button"
                                                                aria-label="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Total Amount&lt;/span&gt;: Activate to sort"
                                                                tabindex="0"></span></div>
                                                    </th>
                                                    <th title="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Total Amount&lt;/span&gt;"
                                                        data-dt-column="4" rowspan="1" colspan="1"
                                                        class="dt-orderable-asc dt-orderable-desc dt-type-numeric">
                                                        <div class="dt-column-header"><span class="dt-column-title"><span
                                                                    class="d-flex justify-content-start">Discount</span></span><span
                                                                class="dt-column-order" role="button"
                                                                aria-label="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Total Amount&lt;/span&gt;: Activate to sort"
                                                                tabindex="0"></span></div>
                                                    </th>
                                                    <th title="Currency" data-dt-column="6" rowspan="1"
                                                        colspan="1" class="dt-orderable-asc dt-orderable-desc">
                                                        <div class="dt-column-header"><span
                                                                class="dt-column-title">Currency</span><span
                                                                class="dt-column-order" role="button"
                                                                aria-label="Currency: Activate to sort"
                                                                tabindex="0"></span>
                                                        </div>
                                                    </th>
                                                    <th title="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Status&lt;/span&gt;"
                                                        data-dt-column="7" rowspan="1" colspan="1"
                                                        class="dt-orderable-asc dt-orderable-desc">
                                                        <div class="dt-column-header"><span class="dt-column-title"><span
                                                                    class="d-flex justify-content-start">Status</span></span><span
                                                                class="dt-column-order" role="button"
                                                                aria-label="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Status&lt;/span&gt;: Activate to sort"
                                                                tabindex="0"></span></div>
                                                    </th>
                                                    <th title="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Date&lt;/span&gt;"
                                                        data-dt-column="8" rowspan="1" colspan="1"
                                                        class="dt-orderable-asc dt-orderable-desc">
                                                        <div class="dt-column-header"><span class="dt-column-title"><span
                                                                    class="d-flex justify-content-start">Order
                                                                    Date</span></span><span class="dt-column-order"
                                                                role="button"
                                                                aria-label="&lt;span class=&quot;d-flex justify-content-start&quot;&gt;Date&lt;/span&gt;: Activate to sort"
                                                                tabindex="0"></span></div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderItems as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div class="d-flex py-1 align-items-center">
                                                                <span class="avatar avatar-2 me-2"
                                                                    style="background-image: url({{ $item->course->thumbnail }})"></span>
                                                                <div class="flex-fill">
                                                                    <span>{{ $item->course->title }}</span>
                                                                    <div
                                                                        class="font-weight-medium d-flex justify-content-between align-items-center">
                                                                        <a href="#"
                                                                            class="text-reset">{{ $item->course->instructor->name }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex py-1 align-items-center">
                                                                @if (!empty($item->order->customer->image))
                                                                    <span class="avatar avatar-2 me-2"
                                                                        style="background-image: url({{ $item->order->customer->image }})"></span>
                                                                @else
                                                                    <span
                                                                        class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">{{ getUserInitials($item->order->customer->name) }}</span>
                                                                @endif
                                                                <div class="flex-fill">
                                                                    <div class="font-weight-medium">
                                                                        {{ $item->order->customer->name }}</div>
                                                                    <div class="font-weight-medium">
                                                                        <div class="text-secondary">
                                                                            <a href="#"
                                                                                class="text-reset">{{ $item->order->customer->email }}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="dt-type-numeric">{{ $item->course->price }}</td>
                                                        <td>{{ $item->course->discount ?? 0 }}%</td>
                                                        <td>{{ $item->order->currency }}</td>
                                                        <td><span
                                                                class="badge bg-lime text-lime-fg">{{ $item->order->status }}</span>
                                                        </td>
                                                        <td>{{ format_to_date($item->order->created_at) }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                        <div class="dt-autosize" style="width: 100%; height: 0px;"></div>
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
                                    <li class="list-inline-item"><a href="./license.html"
                                            class="link-secondary">License</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary"
                                            rel="noopener">Source code</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://github.com/sponsors/codecalm" target="_blank"
                                            class="link-secondary" rel="noopener">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/heart -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('header_scripts')
    @vite('resources/js/admin/course.js')
@endpush

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {

            // Inisialisasi DataTable
            let table = $('#course-table').DataTable();

            $('#btnReload').on('click', function() {
                table.ajax.reload(null, false);
            });

            $('#btnReset').on('click', function() {
                table.search('').columns().search('').order([]).page('first').draw();
                $('#custom-search').val('');
                $('input[type="checkbox"]').prop('checked', false);
            });

            initTable('#course-table');
        });
    </script>
@endpush
