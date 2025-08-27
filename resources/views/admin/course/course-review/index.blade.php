@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Course Reviews</h3>
                            </div>
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-secondary">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <input type="number" min="1"
                                                class="form-control form-control-sm custom-length-input"
                                                data-table-id="reviews" value="10" size="3"
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
                                    ['id' => 'reviews', 'class' => 'table table-selectable card-table table-vcenter text-nowrap datatable'],
                                    true,
                                ) !!}
                            </div>

                            <!-- Custom Footer -->
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


        <!-- Dynamic Modal -->
        <div class="modal fade" id="dynamic-modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content dynamic-modal-content">
                    <!-- Content injected via AJAX -->
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        {!! $dataTable->scripts() !!}
    @endpush

    @push('scripts')
        <script>
            $('#reviews thead tr').first().html(`
        <th>No.</th>
        <th>Course</th>
        <th>Student</th>
        <th>Rating</th>
        <th>Detail Review</th>
        <th>Status</th>
        <th>Created At</th>
        <th colspan="2" class="text-center">Action</th>
    `);
            $(document).ready(function() {
                initTable('#reviews');
            });
            $(function() {
                const baseUrl = "{{ url('') }}";
                const modalElement = document.getElementById('dynamic-modal');
                const dynamicModal = new bootstrap.Modal(modalElement);

                // Global AJAX CSRF token setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Handle open Edit Modal
                $(document).on("click", '.show-review', function() {
                    const reviewId = $(this).data('review-id');
                    dynamicModal.show();
                    $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                    $.get(`${baseUrl}/admin/reviews/${reviewId}`, function(html) {
                        $('.dynamic-modal-content').html(html);
                    }).fail(() => {
                        $('.dynamic-modal-content').html(
                            '<div class="p-5 text-danger">Error loading form</div>');
                    });
                });
            });
        </script>
    @endpush
