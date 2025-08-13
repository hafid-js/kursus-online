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
                                <h4 class="card-title">Course Reviews</h4>
                            </div>
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Course</th>
                                                <th>User</th>
                                                <th>Rating</th>
                                                <th>Detail Review</th>
                                                <th>Status</th>
                                                <th colspan="2" class="text-center">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($reviews as $review)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $review->course->title }}</td>
                                                    <td>
                                                        <div class="d-flex py-1 align-items-center">
                                                            @if (!empty($review->user->image))
                                                                <span class="avatar avatar-2 me-2"
                                                                    style="background-image: url({{ asset($review->user->image) }})"></span>
                                                            @else
                                                                <span
                                                                    class="avatar avatar-2 me-2 bg-primary-lt text-primary fw-bold">
                                                                    {{ getUserInitials($review->user->name) }}
                                                                </span>
                                                            @endif
                                                            <div class="flex-fill">
                                                                <div class="font-weight-medium">
                                                                    {{ $review->user->name }}</div>
                                                                <div class="font-weight-medium">
                                                                    <div class="text-secondary"><a href="#"
                                                                            class="text-reset">{{ $review->user->email }}</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </td>
                                                    <td>{{ $review->rating }}</td>
                                                    <td>
                                                        <a class="show-review" data-review-id="{{ $review->id }}"><i
                                                                class="ti ti-eye"></i></a>
                                                    </td>
                                                    <td>
                                                        @if ($review->status == 1)
                                                            <span class="badge bg-lime text-lime-fg">Approved</span>
                                                        @else
                                                            <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.reviews.update', $review->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" id="" class="form-control"
                                                                onchange="this.form.submit()">
                                                                <option @selected($review->status == 0) value="0">Pending
                                                                </option>
                                                                <option @selected($review->status == 1) value="1">Approved
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.reviews.destroy', $review->id) }}"
                                                            class="text-red delete-item">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No Data Found!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{ $reviews->links() }}
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
            $(function() {
                const baseUrl = "{{ url('') }}";

                // Global AJAX CSRF token setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Handle open Edit Modal
                $('.show-review').on('click', function() {
                    const reviewId = $(this).data('review-id');
                    $('#dynamic-modal').modal('show');
                    $('.dynamic-modal-content').html('<div class="p-5 text-center">Loading...</div>');

                    $.get(`${baseUrl}/admin/reviews/${reviewId}`, function(html) {
                        $('.dynamic-modal-content').html(html);
                    }).fail(() => {
                        $('.dynamic-modal-content').html(
                            '<div class="p-5 text-danger">Error loading form</div>');
                    });
                });
            });
        </script>
    @endpush
