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
                                <h4 class="card-title">Course Languages</h4>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-primary add_course_language">
                                        <i class="ti ti-plus"></i> Add new
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Action</th>
                                                {{-- <th class="w-1"></th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($languages as $language)
                                                <tr>
                                                    <td>{{ $language->name }}</td>
                                                    <td>{{ $language->slug }}</td>
                                                    <td>
                                                        <a class="edit edit_course_language"
                                                            data-language-id="{{ $language->id }}" href="javascript:;"><i
                                                                class="ti ti-edit" aria-hidden="true"></i></a>
                                                        <a href="{{ route('admin.course-languages.destroy', $language->id) }}"
                                                            class="text-red delete-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-trash-x">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M4 7h16" />
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                <path d="M10 12l4 4m0 -4l-4 4" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No Data Found!
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{ $languages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Modal -->
    <div class="modal fade" id="dynamic-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content dynamic-modal-content">
                <!-- Content injected via AJAX -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            const baseUrl = "{{ url('') }}";

            // Global AJAX CSRF token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle open Create Modal
            $('.add_course_language').on('click', function() {
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/course-languages/create`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // Handle open Edit Modal
            $('.edit_course_language').on('click', function() {
                const languageId = $(this).data('language-id');
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/course-languages/${languageId}/edit`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // Handle Create form submission (event delegation)
            $(document).on('submit', '#addCourseLang', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);
                const $submitBtn = $(form).find('button[type="submit"]');

                // Disable button & show loading
                const originalText = $submitBtn.html();
                $submitBtn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
                );

                // Clear previous errors
                $('#error-name').text('');

                $.ajax({
                    url: "{{ route('admin.course-languages.store') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#dynamic-modal').modal('hide');
                        form.reset();
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.name) $('#error-name').text(errors.name[0]);
                        }
                    },
                    complete: function() {
                        // Re-enable button
                        $submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });


            // Handle Update form submission (event delegation)
            $(document).on('submit', '#updateCourseLang', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);
                const actionUrl = $(form).attr('action');
                const $submitBtn = $(form).find('button[type="submit"]');

                const originalText = $submitBtn.html();
                $submitBtn.prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
                );
                // Clear errors
                $('#error-update-name').text('');

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
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            });

        });
    </script>
@endpush
