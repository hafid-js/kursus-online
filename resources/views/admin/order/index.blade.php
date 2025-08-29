
@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Orders</h4>
                            </div>
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-secondary">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <input type="number" min="1"
                                                class="form-control form-control-sm custom-length-input"
                                                data-table-id="courseorders-table" value="8" size="3"
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
                                {!! $dataTable->table(
                                    ['id' => 'courseorders-table', 'class' => 'table table-selectable card-table table-vcenter text-nowrap datatable'],
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
            </div>
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

@push('scripts')
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {

            // Inisialisasi DataTable
            let table = $('#courseorders-table').DataTable();

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
    </script>
@endpush
