@extends('frontend.layouts.layout')

@section('content')
    <style>
        .wsus__dashboard_searchbox {
            gap: 10px;
        }
    </style>
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Students</h1>
                            <ul>
                                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                                <li>Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading">
                                <h5>Students</h5>
                                <p>Easily manage your students and view updates including course status, progress insights,
                                    and enrollment states.</p>
                            </div>
                        </div>

                        <div class="wsus__dash_student_table">
                            <div class="wsus__dash_course_searchbox">
                                <a class="common_btn" id="btnExportExcel">Export Report</a>
                                <div class="input">
                                    <input id="custom-search" type="text" placeholder="Search Student Name ...">
                                    <button><i class="far fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        {!! $dataTable->table(['id' => 'students-table', 'class' => 'table'], true) !!}
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
            let table = $('#students-table').DataTable();

            table.on('draw', function() {
                // add class for tr and td
                $('#students-table tbody tr').each(function() {
                    $(this).find('td').eq(0).addClass('name');
                });
                $('#students-table tbody tr').each(function() {
                    $(this).find('td').eq(1).addClass('date');
                });
                $('#students-table tbody tr').each(function() {
                    $(this).find('td').eq(2).addClass('location');
                });
                $('#students-table tbody tr').each(function() {
                    $(this).find('td').eq(3).addClass('progres');
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

            initTable('#students-table');


            $('#students-table').on('draw.dt', function() {
                $('#select-all').off('click').on('click', function() {
                    const checked = $(this).is(':checked');
                    $('.student-checkbox').prop('checked', checked);
                });

                $(document).off('click', '.student-checkbox').on('click', '.student-checkbox', function() {
                    const total = $('.student-checkbox').length;
                    const checked = $('.student-checkbox:checked').length;

                    $('#select-all').prop('checked', total === checked);
                });
            });

        });

        $(document).ready(function() {
            function exportSelectedOrAll(type) {
                let selectedIds = [];
                $('.student-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    let url = `export/students-pdf?type=${type}`;

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
                        window.location.href = "{{ route('instructor.export.students') }}";
                    } else if (type === 'pdf') {
                        window.location.href = "{{ route('instructor.export.students-pdf') }}";
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
    </script>
@endpush
