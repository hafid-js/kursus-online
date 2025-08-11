@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="https://httpbin.org/post" method="post" class="card">
                            <div class="card-header">
                                <h4 class="card-title">Course Categories</h4>
                                <div class="card-actions">
                                    <a href="#"
                                        class="btn btn-primary add_course_category">
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
                                                                <th>Icon</th>
                                                                <th>Name</th>
                                                                <th>Trending</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($categories as $category)
                                                                <tr>
                                                                    <td><img src="{{ asset($category->image) }}"
                                                                            alt=""></td>
                                                                    <td>{{ $category->name }}</td>
                                                                    <td>
                                                                        @if ($category->show_at_trending == 1)
                                                                            <span
                                                                                class="badge bg-lime text-lime-fg">Yes</span>
                                                                        @else
                                                                            <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($category->status == 1)
                                                                            <span
                                                                                class="badge bg-lime text-lime-fg">Yes</span>
                                                                        @else
                                                                            <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('admin.course-sub-categories.index', $category->id) }}"
                                                                            class="btn-sm text-warning">
                                                                            <i class="ti ti-list"></i>
                                                                        </a>
                                                                        <a class="edit edit_course_category"
                                                                            data-category-id="{{ $category->id }}"
                                                                            href="javascript:;"><i class="ti ti-edit"
                                                                                aria-hidden="true"></i></a>
                                                                        {{-- <a href="{{ route('admin.course-categories.edit', $category->id) }}"
                                                                            class="btn-sm btn-primary">
                                                                            <i class="ti ti-edit"></i>
                                                                        </a> --}}
                                                                        <a href="{{ route('admin.course-categories.destroy', $category->id) }}"
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
                        </form>
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
    $(function () {
        const baseUrl = "{{ url('') }}";

        // Global AJAX CSRF token setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle open Create Modal
        $('.add_course_category').on('click', function () {
            $('#dynamic-modal').modal('show');
            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

            $.get(`${baseUrl}/admin/course-categories/create`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });

        // Handle open Edit Modal
        $('.edit_course_category').on('click', function () {
            const categoryId = $(this).data('category-id');
            $('#dynamic-modal').modal('show');
            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

            $.get(`${baseUrl}/admin/course-categories/${categoryId}/edit`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });

        // Handle Create form submission (event delegation)
        $(document).on('submit', '#courseCategoryForm', function (e) {
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
                success: function (response) {
                    $('#dynamic-modal').modal('hide');
                    window.location.href = response.redirect || location.href;
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.image) $('#error-image').text(errors.image[0]);
                        if (errors.background) $('#error-background').text(errors.background[0]);
                        if (errors.name) $('#error-name').text(errors.name[0]);
                    }
                }
            });
        });

        // Handle Update form submission (event delegation)
        $(document).on('submit', '#updateCourseCatForm', function (e) {
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
    });
</script>
@endpush
