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
                                                                        <span class="badge bg-lime text-lime-fg">Yes</span>
                                                                        @else
                                                                        <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a class="edit edit_footer_column_one"
                                                                            data-column-id="{{ $column->id }}"
                                                                            href="javascript:;"><i class="ti ti-edit"
                                                                                aria-hidden="true"></i></a>
                                                                        <a href="{{ route('admin.footer-column-one.destroy', $column->id) }}" class="text-red delete-item">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                                stroke="currentColor" stroke-width="2"
                                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash-x">
                                                                                <path stroke="none" d="M0 0h24v24H0z"
                                                                                    fill="none" />
                                                                                <path d="M4 7h16" />
                                                                                <path
                                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                                <path
                                                                                    d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                                <path d="M10 12l4 4m0 -4l-4 4" />
                                                                            </svg>
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
        $(document).on('submit', '#footerColumnForm', function (e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);

            // Clear previous errors
            $('#error-icon, #error-title, #error-line_one', '#error-line_two').text('');

            $.ajax({
                url: "{{ route('admin.contact.store') }}",
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
                        if (errors.icon) $('#error-icon').text(errors.icon[0]);
                         if (errors.title) $('#error-title').text(errors.title[0]);
                          if (errors.line_one) $('#error-line_one').text(errors.line_one[0]);
                           if (errors.line_two) $('#error-line_two').text(errors.line_two[0]);
                            if (errors.status) $('#error-status').text(errors.status[0]);
                    }
                }
            });
        });

        // Handle Update form submission (event delegation)
        $(document).on('submit', '#updateFooterColumnForm', function (e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            const actionUrl = $(form).attr('action');

            // Clear errors
                 $('#error-icon, #error-title, #error-line_one', '#error-line_two').text('');

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
                                 if (errors.icon) $('#error-update-icon').text(errors.icon[0]);
                         if (errors.title) $('#error-update-title').text(errors.title[0]);
                          if (errors.line_one) $('#error-update-line_one').text(errors.line_one[0]);
                           if (errors.line_two) $('#error-update-line_two').text(errors.line_two[0]);
                            if (errors.status) $('#error-update-status').text(errors.status[0]);
                    }
                }
            });
        });
    });
</script>
@endpush
