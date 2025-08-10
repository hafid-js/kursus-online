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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#addBlogCatModal"
                                        class="btn btn-primary">
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

    <!-- Modal -->
    <div class="modal fade" id="addBlogCatModal" tabindex="-1" aria-labelledby="addBlogCatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form id="createCategoryForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <x-input-block name="name" placeholder="Enter name" />
                            <div class="text-danger mt-1" id="error-name"></div>
                        </div>
                        <div class="mb-3">
                            <x-input-toggle-block name="status" label="Status" />
                            <div class="text-danger mt-1" id="error-status"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ms-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-2">
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Create
                        </button>
                    </div>
                </form>
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
        $(document).ready(function() {
            const base_url = "{{ url('') }}";

            // Handle edit button click
            $('.edit_blog_category').on('click', function() {
                const categoryId = $(this).data('category-id');
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.ajax({
                    url: `${base_url}/admin/blog-categories/${categoryId}/edit`,
                    method: 'GET',
                    success: function(html) {
                        $('.dynamic-modal-content').html(html);
                    },
                    error: function(xhr) {
                        $('.dynamic-modal-content').html(
                            '<div class="p-5 text-danger">Error loading form</div>');
                    }
                });
            });

            // Handle update form submission
            $(document).on('submit', '#updateCategoryForm', function(e) {
                e.preventDefault();
                const form = $(this);
                const actionUrl = form.attr('action');
                const formData = new FormData(this);

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
                        $('#error-update-name').text('');
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#error-update-name').text(errors.name[0]);
                            }
                        }
                    }
                });
            });
        });


        $(document).ready(function() {
            console.log('Document ready, script running...');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#createCategoryForm').on('submit', function(e) {
                e.preventDefault();
                console.log('Form intercepted, submitting via AJAX...');

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.blog-categories.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Success response:', response);

                        // Bootstrap 5 modal hide
                        var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                            'addBlogCatModal'));
                        modal.hide();

                        window.location.href = response.redirect;
                    },
                    error: function(xhr) {
                        console.log('Validation error:', xhr);
                        $('#error-name').text('');

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#error-name').text(errors.name[0]);
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush
