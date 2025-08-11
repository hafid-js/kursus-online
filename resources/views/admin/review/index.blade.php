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
                                <div class="card-actions">
                                    <a href="{{ route('admin.payout-gateway.index') }}" class="btn btn-primary">
                                        <i class="ti ti-arrow-left"></i>
                                        Back
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Course</th>
                                                <th>User</th>
                                                <th>Rating</th>
                                                <th>Review</th>
                                                <th>Detail</th>
                                                <th>Status</th>
                                                <th colspan="2" class="text-center">Action</th>
                                                {{-- <th class="w-1"></th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($reviews as $review)
                                                <tr>
                                                    <td>{{ $review->course->title }}</td>
                                                    <td>{{ $review->user->name }}</td>
                                                    <td>{{ $review->rating }}</td>
                                                    <td>{{ $review->review }}</td>
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
