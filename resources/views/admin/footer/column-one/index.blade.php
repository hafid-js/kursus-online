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
                                <h4 class="card-title">Footer Column One</h4>
                                <div class="card-actions">
                                   <a href="#" class="btn btn-primary add_footer_column_one">
                                        <i class="ti ti-plus"></i> Add new
                                    </a>
                                </div>
                            </div>
                            <div class="page-body">
                                <div class="container-xl">
                                    <div class="row row-cards">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="table-responsive">
                                                    <table class="table table-vcenter card-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Url</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($columnOne as $column)
                                                                <tr>
                                                                    <td>{{ $column->title }}</td>
                                                                    <td>{{ $column->url }}</td>
                                                                    <td>
                                                                        @if ($column->status == 1)
                                                                        <span
                                                                                class="badge bg-lime text-lime-fg">Active</span>
                                                                        @else
                                                                        <span class="badge bg-red text-red-fg">Inactive</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a class="edit edit_footer_column_one"
                                                                            data-column-id="{{ $column->id }}"
                                                                            href="javascript:;"><i class="ti ti-edit"
                                                                                aria-hidden="true"></i></a>
                                                                        <a href="{{ route('admin.footer-column-one.destroy', $column->id) }}" class="text-red delete-item">
                                                                             <i class="ti ti-trash"
                                                                                aria-hidden="true"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No Data Found!</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{ $columnOne->links() }}
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
    <div class="modal fade" id="dynamic-modal" tabindex="-1" aria-labelledby="updateBlogCatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content dynamic-modal-content  border-0 shadow-lg rounded-4">
                <!-- Content injected via AJAX -->
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    $(function () {
        const baseUrl = "{{ url('') }}";

        // Global AJAX CSRF token setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle open Create Modal
        $('.add_footer_column_one').on('click', function () {
            $('#dynamic-modal').modal('show');
            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

            $.get(`${baseUrl}/admin/footer-column-one/create`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });

        // Handle open Edit Modal
        $('.edit_footer_column_one').on('click', function () {
            const columnId = $(this).data('column-id');
            $('#dynamic-modal').modal('show');
            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

            $.get(`${baseUrl}/admin/footer-column-one/${columnId}/edit`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });

        // Handle Create form submission (event delegation)
        $(document).on('submit', '#addColumn', function (e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);

            // Clear previous errors
            $('#error-title, #error-url').text('');

            $.ajax({
                url: "{{ route('admin.footer-column-one.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#dynamic-modal').modal('hide');
                   location.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.url) $('#error-url').text(errors.url[0]);
                         if (errors.title) $('#error-title').text(errors.title[0]);
                    }
                }
            });
        });

        // Handle Update form submission (event delegation)
        $(document).on('submit', '#updateColumn', function (e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            const actionUrl = $(form).attr('action');

            // Clear errors
                 $('#error-title, #error-url').text('');

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#dynamic-modal').modal('hide');
                    location.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                                 if (errors.url) $('#error-update-url').text(errors.url[0]);
                         if (errors.title) $('#error-update-title').text(errors.title[0]);
                    }
                }
            });
        });
    });
</script>
@endpush
