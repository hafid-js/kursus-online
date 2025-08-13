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
                                <h4 class="card-title">Course Sub Categories of: ({{ $course_category->name }})</h4>
                                <div class="card-actions">
                                    <a href="{{ route('admin.course-categories.index', $course_category->id) }}"
                                        class="btn btn-dark">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                    <a href="{{ route('admin.course-sub-categories.create', $course_category->id) }}"
                                        data-category-id="{{ $course_category->id }}"
                                        class="btn btn-primary add_course_sub_category">
                                        <i class="ti ti-plus"></i>
                                        Add new
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
                                                                <th>No</th>
                                                                <th>Icon</th>
                                                                <th>Name</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($subCategories as $category)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td><img src="{{ asset($category->image) }}"
                                                                            alt=""></td>
                                                                    <td>{{ $category->name }}</td>
                                                                    <td>
                                                                        @if ($category->status == 1)
                                                                            <span
                                                                                class="badge bg-lime text-lime-fg">Active</span>
                                                                        @else
                                                                            <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a class="edit edit_course_sub_category"
                                                                            data-category-id="{{ $course_category->id }}"
                                                                            data-sub-category-id="{{ $category->id }}"
                                                                            href="javascript:;"><i class="ti ti-edit"
                                                                                aria-hidden="true"></i></a>

                                                                        <a href="{{ route('admin.course-sub-categories.destroy', [
                                                                            'course_category' => $course_category->id,
                                                                            'course_sub_category' => $category->id,
                                                                        ]) }}"
                                                                            class="text-red delete-item">
                                                                            <i class="ti ti-trash"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">No Data Found!
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- {{ $categories->links() }} --}}
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content dynamic-modal-content">
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
            $('.add_course_sub_category').on('click', function(e) {
                e.preventDefault();
                const categoryId = $(this).data('category-id');
                $('#dynamic-modal').modal('show');
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.ajax({
                    url: `${base_url}/admin/${categoryId}/course-sub-categories/create`,
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

            $('.edit_course_sub_category').on('click', function () {
            const categoryId = $(this).data('category-id');
            const subcategoryId = $(this).data('sub-category-id');
            $('#dynamic-modal').modal('show');
            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

            $.get(`${base_url}/admin/${categoryId}/sub-categories/${subcategoryId}/edit`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });
        });


            // Handle update form submission
    $(document).on('submit', '#addCourseSubCat', function (e) {
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
            success: function (response) {
                $('#dynamic-modal').modal('hide');
                location.reload();
            },

            error: function (xhr) {
                $('#error-name').text('');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        $('#error-name').text(errors.name[0]);
                         $('#error-image').text(errors.image[0]);
                    }
                }
            }
        });
    });

    $(document).on('submit', '#updateCourseSubCat', function (e) {
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
                success: function (response) {
                    $('#dynamic-modal').modal('hide');
                    location.reload();
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.name) $('#error-update-name').text(errors.name[0]);
                        if (errors.image) $('#error-update-image').text(errors.image[0]);
                        if (errors.background) $('#error-update-background').text(errors.background[0]);
                    }
                }
            });
        });


    </script>
@endpush
