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
                                <h3 class="card-title">Course Categories</h3>
                            </div>
                            {{-- Custom Search & Entries --}}
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-secondary">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <input id="custom-length" type="number" min="1"
                                                class="form-control form-control-sm" value="8" size="3"
                                                aria-label="Entries count">
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
                                    ['id' => 'course_categories', 'class' => 'table table-vcenter card-table datatable'],
                                    true,
                                ) !!}
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
    <script>
        $(document).ready(function() {
    let table = $('#course_categories').DataTable();

    // Search manual input
    $('#custom-search').on('keyup', function() {
        table.search(this.value).draw();
    });

    // change total entries
    $('#custom-length').on('change', function() {
        table.page.len(this.value).draw();
    });
});
        $(function() {
            const baseUrl = "{{ url('') }}";

            // Global AJAX CSRF token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle open Create Modal
            $('.add_course_category').on('click', function() {
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/course-categories/create`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // Handle open Edit Modal
            $('.edit_course_category').on('click', function() {
                const categoryId = $(this).data('category-id');
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/course-categories/${categoryId}/edit`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // Handle Create form submission (event delegation)
            $(document).on('submit', '#courseCategoryForm', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);

                // Clear previous errors
                $('#error-image, #error-background, #error-name').text('');

                $.ajax({
                    url: "{{ route('admin.course-categories.store') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#dynamic-modal').modal('hide');
                        window.location.href = response.redirect || location.href;
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.image) $('#error-image').text(errors.image[0]);
                            if (errors.background) $('#error-background').text(errors
                                .background[0]);
                            if (errors.name) $('#error-name').text(errors.name[0]);
                        }
                    }
                });
            });

            // Handle Update form submission (event delegation)
            $(document).on('submit', '#updateCourseCatForm', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);
                const actionUrl = $(form).attr('action');

                // Clear errors
                $('#error-update-name, #error-update-image, #error-update-background').text('');

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#dynamic-modal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.name) $('#error-update-name').text(errors.name[0]);
                            if (errors.image) $('#error-update-image').text(errors.image[0]);
                            if (errors.background) $('#error-update-background').text(errors
                                .background[0]);
                        }
                    }
                });
            });
        });

        // document.addEventListener('DOMContentLoaded', function() {
        //     initLiveSearch({
        //         inputSelector: '#searchInput',
        //         resultSelector: '#categoryTableBody',
        //         url: "{{ route('admin.course-categories.index') }}"
        //     });
        // });

    </script>
@endpush
