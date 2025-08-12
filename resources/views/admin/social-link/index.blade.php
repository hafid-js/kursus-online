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
                                <h4 class="card-title">Social Links</h4>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-primary add_social_link">
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
                                                                <th>Icon</th>
                                                                <th>Url</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                                {{-- <th class="w-1"></th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($socialLinks as $socialLink)
                                                                <tr>

                                                                    <td>{{ $socialLink->icon }}</td>
                                                                    <td>{{ $socialLink->url }}</td>
                                                                    <td>
                                                                        @if ($socialLink->status == 1)
                                                                        <span class="badge bg-lime text-lime-fg">Yes</span>
                                                                        @else
                                                                        <span class="badge bg-red text-red-fg">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a href="#"
                                                                            class="btn-sm btn-primary edit_social_link"
                                                                            data-link-id="{{ $socialLink->id }}">
                                                                            <i class="ti ti-edit"></i>
                                                                        </a>
                                                                        <a href="{{ route('admin.social-links.destroy', $socialLink->id) }}" class="text-red delete-item">
                                                                            <i class="ti ti-trash"></i>
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
        $('.add_social_link').on('click', function () {
            $('#dynamic-modal').modal('show');
            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

            $.get(`${baseUrl}/admin/social-links/create`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });

        // Handle open Edit Modal
        $('.edit_social_link').on('click', function () {
            const linkId = $(this).data('link-id');
            $('#dynamic-modal').modal('show');
            $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

            $.get(`${baseUrl}/admin/social-links/${linkId}/edit`, function (html) {
                $('.dynamic-modal-content').html(html);
            }).fail(() => {
                $('.dynamic-modal-content').html('<div class="p-5 text-danger">Error loading form</div>');
            });
        });

        // Handle Create form submission (event delegation)
        $(document).on('submit', '#addLink', function (e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);

            // Clear previous errors
            $('#error-icon, #error-url').text('');

            $.ajax({
                url: "{{ route('admin.social-links.store') }}",
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
                         if (errors.url) $('#error-url').text(errors.url[0]);
                    }
                }
            });
        });

        // Handle Update form submission (event delegation)
        $(document).on('submit', '#updateLink', function (e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            const actionUrl = $(form).attr('action');

            // Clear errors
                 $('#error-icon, #error-url').text('');

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
                         if (errors.url) $('#error-update-url').text(errors.url[0]);
                    }
                }
            });
        });
    });
</script>
@endpush
