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
                            <h1>Courses</h1>
                            <ul>
                                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                                @if (Str::contains(request()->url(), '/create'))
                                    <li>Add Courses</li>
                                @elseif (Str::contains(request()->url(), '/edit'))
                                    <li>Edit Courses</li>
                                @else
                                    <li>Courses</li>
                                @endif
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
                @include('frontend.layouts.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading relative">
                                <h5>Courses</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                                <a class="common_btn" href="{{ route('instructor.courses.create') }}">+ add course</a>
                            </div>
                        </div>

                        <form action="#" class="wsus__dash_course_searchbox">
                            <div class="input">
                                <input id="custom-search" type="text" placeholder="Search our Courses">
                                <button><i class="far fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div class="selector">
                                <div class="nice-select add_course_basic_info_imput" tabindex="0" id="sortCourse">
                                    <span class="current">Sort by</span>
                                    <ul class="list">
                                        <li data-value="created_at_desc" class="option selected">Newest</li>
                                        <li data-value="created_at_asc" class="option">Oldest</li>
                                        <li data-value="price_asc" class="option">Price: Low to High</li>
                                        <li data-value="price_desc" class="option">Price: High to Low</li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <div class="wsus__dash_course_table">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        {!! $dataTable->table(['id' => 'course-table', 'class' => 'table'], true) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wsus__pagination mt_50 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <i class="far fa-arrow-left" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    {!! $dataTable->scripts() !!}

    <script>
        window.initTable = function(tableSelector) {
            let table = $(tableSelector).DataTable();

            table.on("draw", function() {
                updateTableInfo();
                renderPagination(table.page.info().page + 1, table.page.info().pages);
            });

            // Manual pagination click handler
            $(document)
                .off("click.customPagination")
                .on("click.customPagination", ".page-link", function(e) {
                    e.preventDefault();
                    const page = $(this).data("page");
                    if (page && page >= 1 && page <= table.page.info().pages) {
                        table.page(page - 1).draw(false);
                    }
                });

            // Search manual input
            $("#custom-search")
                .off("keyup.customSearch")
                .on("keyup.customSearch", function() {
                    table.search(this.value).draw();
                });

            $(".custom-length-input")
                .off("change.customLength")
                .on("change.customLength", function() {
                    const tableId = $(this).data("table-id");
                    const newLength = parseInt($(this).val());

                    if (!isNaN(newLength) && newLength > 0) {
                        const table = $("#" + tableId).DataTable();
                        table.page.len(newLength).draw();
                    }
                });

            $("#custom-length").val(table.page.len());

            function updateTableInfo() {
                const info = table.page.info();
                $("#table-info").html(
                    `Showing <strong>${info.start + 1} to ${
                info.end
            }</strong> of <strong>${info.recordsTotal} entries</strong>`
                );
            }

            function renderPagination(currentPage, totalPages) {
                const $pagination = $(".pagination");
                $pagination.empty();

                // Prev button
                const prevDisabled = currentPage === 1 ? "disabled" : "";
                $pagination.append(`
            <li class="page-item ${prevDisabled}">
                <a class="page-link" href="#" data-page="${
                    currentPage - 1
                }" aria-label="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-1">
                        <path d="M15 6l-6 6l6 6"></path>
                    </svg>
                </a>
            </li>
        `);

                // Numbered pages
                for (let i = 1; i <= totalPages; i++) {
                    const active = i === currentPage ? "active" : "";
                    $pagination.append(`
                <li class="page-item ${active}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `);
                }

                // Next button
                const nextDisabled = currentPage === totalPages ? "disabled" : "";
                $pagination.append(`
            <li class="page-item ${nextDisabled}">
                <a class="page-link" href="#" data-page="${
                    currentPage + 1
                }" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-1">
                        <path d="M9 6l6 6l-6 6"></path>
                    </svg>
                </a>
            </li>
        `);
            }

            // Initial info and pagination render
            updateTableInfo();
            const info = table.page.info();
            renderPagination(info.page + 1, info.pages);

            return table;
        };
    </script>

    <script>
        $(document).ready(function() {

            // Inisialisasi DataTable
            let table = $('#course-table').DataTable();

            // $('#btnReload').on('click', function() {
            //     table.ajax.reload(null, false);
            // });

            // $('#btnReset').on('click', function() {
            //     table.search('').columns().search('').order([]).page('first').draw();
            //     $('#custom-search').val('');
            //     $('input[type="checkbox"]').prop('checked', false);
            // });

            table.on('draw', function() {

                // add class for tr and th
                $('#course-table tbody tr').each(function() {
                    $(this).find('th').eq(0).addClass('image');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('th').eq(1).addClass('details');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('th').eq(2).addClass('sale');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('th').eq(3).addClass('status');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('th').eq(4).addClass('status');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('th').eq(5).addClass('action');
                });

                // add class for tr and td
                $('#course-table tbody tr').each(function() {
                    $(this).find('td').eq(0).addClass('image');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('td').eq(1).addClass('details');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('td').eq(2).addClass('sale');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('td').eq(3).addClass('status');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('td').eq(4).addClass('status');
                });
                $('#course-table tbody tr').each(function() {
                    $(this).find('td').eq(5).addClass('action');
                });
            });
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
