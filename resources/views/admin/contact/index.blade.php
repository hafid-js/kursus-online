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
                                <h4 class="card-title">Contact Cards</h4>
                                <div class="card-actions">
                                    <a href="#" class="btn btn-primary add_contact_card">
                                        <i class="ti ti-plus"></i>
                                        Add new
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th>Icon</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($contactCards as $contact)
                                                    <tr>
                                                        <td><img src="{{ asset($contact->icon) }}" alt=""
                                                                width="50"></td>
                                                        <td>{{ $contact->title }}</td>
                                                        <td>
                                                            @if ($contact->status == 1)
                                                                <span class="badge bg-lime text-lime-fg">Yes</span>
                                                            @else
                                                                <span class="badge bg-red text-red-fg">No</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="edit edit_contact_card"
                                                                data-contact-id="{{ $contact->id }}" href="javascript:;"><i
                                                                    class="ti ti-edit" aria-hidden="true"></i></a>
                                                            <a href="{{ route('admin.contact.destroy', $contact->id) }}"
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
            const modalElement = document.getElementById('dynamic-modal');
            const dynamicModal = new bootstrap.Modal(modalElement);

            // Global AJAX CSRF token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle open Create Modal
            $('.add_contact_card').on('click', function() {
                dynamicModal.show();
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/contact/create`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // Handle open Edit Modal
            $('.edit_contact_card').on('click', function() {
                const cardId = $(this).data('contact-id');
                dynamicModal.show();
                $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                $.get(`${baseUrl}/admin/contact/${cardId}/edit`, function(html) {
                    $('.dynamic-modal-content').html(html);
                }).fail(() => {
                    $('.dynamic-modal-content').html(
                        '<div class="p-5 text-danger">Error loading form</div>');
                });
            });

            // Handle Create form submission (event delegation)
            $(document).on('submit', '#contactForm', function(e) {
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
                    success: function(response) {
                        dynamicModal.hide();
                        location.reload();
                    },
                    error: function(xhr) {
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
            $(document).on('submit', '#updateContactForm', function(e) {
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
                    success: function(response) {
                        dynamicModal.hide();
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            if (errors.icon) $('#error-update-icon').text(errors.icon[0]);
                            if (errors.title) $('#error-update-title').text(errors.title[0]);
                            if (errors.line_one) $('#error-update-line_one').text(errors
                                .line_one[0]);
                            if (errors.line_two) $('#error-update-line_two').text(errors
                                .line_two[0]);
                            if (errors.status) $('#error-update-status').text(errors.status[0]);
                        }
                    }
                });
            });
        });
    </script>
@endpush
