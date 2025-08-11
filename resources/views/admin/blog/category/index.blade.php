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
                                <h4 class="card-title">Blog Categories</h4>
                                <div class="card-actions">
                                    <a href="#"
                                        class="btn btn-primary add_blog_category">
                                        <i class="ti ti-plus"></i> Add new
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>
                                                    @if ($category->status == 1)
                                                        <span class="badge bg-lime text-lime-fg">Yes</span>
                                                    @else
                                                        <span class="badge bg-red text-red-fg">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="edit edit_blog_category"
                                                        data-category-id="{{ $category->id }}" href="javascript:;"><i
                                                            class="ti ti-edit" aria-hidden="true"></i></a>
                                                    <a href="{{ route('admin.blog-categories.destroy', $category->id) }}"
                                                        class="text-red delete-item">
                                                        <i class="ti ti-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No Data Found!</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $categories->links() }}
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
        $(function() {
            const baseUrl = "{{ url('') }}";

            // Global AJAX CSRF token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle open Create Modal
            $('.add_blog_category').on('click', function() {
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/blog-categories/create`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // Handle open Edit Modal
            $('.edit_blog_category').on('click', function() {
                const categoryId = $(this).data('category-id');
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/blog-categories/${categoryId}/edit`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // Handle Create form submission (event delegation)
            $(document).on('submit', '#addCategoryForm', function(e) {
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
                    url: "{{ route('admin.blog-categories.store') }}",
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
            $(document).on('submit', '#editCategoryForm', function(e) {
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
