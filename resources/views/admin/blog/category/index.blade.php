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
                                <h4 class="card-title">Blog Categories</h4>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search..."
                                        style="width: 200px;">
                                    <a href="#" class="btn btn-primary add_blog_category">
                                        <i class="ti ti-plus"></i> Add new
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="categoryTableBody">
                                        @include('admin.blog.category.partials.table', [
                                            'categories' => $categories,
                                        ])
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
<script type="module">
    $(function () {
        const baseUrl = "{{ url('') }}";
        const modalElement = document.getElementById('dynamic-modal');
        const dynamicModal = new bootstrap.Modal(modalElement);

        // Setup CSRF Token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Create Modal - Show Form
        $('.add_blog_category').on('click', function (e) {
            e.preventDefault();
            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');
            dynamicModal.show();

            $.get(`${baseUrl}/admin/blog-categories/create`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });

        // Edit Modal - Show Form (using event delegation)
        $(document).on('click', '.edit_blog_category', function (e) {
            e.preventDefault();
            const categoryId = $(this).data('category-id');

            if (!categoryId) return alert("Category ID not found.");

            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');
            dynamicModal.show();

            $.get(`${baseUrl}/admin/blog-categories/${categoryId}/edit`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });

        // Submit Create Form
        $(document).on('submit', '#addCategoryForm', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const $submitBtn = $(form).find('button[type="submit"]');
            const originalText = $submitBtn.html();

            $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');
            $('#error-name').text('');

            $.ajax({
                url: "{{ route('admin.blog-categories.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                  modalElement.hide();
                    location.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.name) $('#error-name').text(errors.name[0]);
                    }
                },
                complete: function () {
                    $submitBtn.prop('disabled', false).html(originalText);
                }
            });
        });

        // Submit Update Form
        $(document).on('submit', '#editCategoryForm', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const actionUrl = $(form).attr('action');
            const $submitBtn = $(form).find('button[type="submit"]');
            const originalText = $submitBtn.html();

            $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');
            $('#error-update-name').text('');

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    dynamicModal.hide();
                    location.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.name) $('#error-update-name').text(errors.name[0]);
                    }
                },
                complete: function () {
                    $submitBtn.prop('disabled', false).html(originalText);
                }
            });
        });

        // Live Search
        initLiveSearch({
            inputSelector: '#searchInput',
            resultSelector: '#categoryTableBody',
            url: "{{ route('admin.blog-categories.index') }}"
        });
    });
</script>
@endpush

