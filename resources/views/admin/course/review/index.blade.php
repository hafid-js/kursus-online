@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        {{-- <div class="page-body">
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
                                                <th>Student</th>
                                                <th>Rating</th>
                                                <th>Detail Review</th>
                                                <th>Status</th>
                                                <th>Created At</th>
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
                                                    <td>{{ format_to_date($review->created_at) }}</td>
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
        </div> --}}
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Course Reviews</h3>
                            </div>
                            <div class="card-body border-bottom py-3">
                                <div class="d-flex">
                                    <div class="text-secondary">
                                        Show
                                        <div class="mx-2 d-inline-block">
                                            <input id="custom-length" type="number" min="1"
                                                class="form-control form-control-sm" value="8" size="3"
                                                aria-label="Invoices count">
                                        </div>
                                        entries
                                    </div>
                                    <div class="ms-auto text-secondary">
                                        Search:
                                        <div class="ms-2 d-inline-block">
                                            <input id="custom-search" type="text" class="form-control form-control-sm"
                                                aria-label="Search invoice">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                {!! $dataTable->table(
                                    ['id' => 'reviews', 'class' => 'table table-selectable card-table table-vcenter text-nowrap datatable'],
                                    true,
                                ) !!}
                            </div>

                            <!-- Custom Footer -->
                            <div class="card-footer">
                                <div class="row g-2 justify-content-center justify-content-sm-between">
                                    <div class="col-auto d-flex align-items-center">
                                        <p class="m-0 text-secondary" id="table-info">
                                            Showing <strong>0 to 0</strong> of <strong>0 entries</strong>
                                        </p>
                                    </div>
                                    <div class="col-auto">
                                        <ul class="pagination m-0 ms-auto"></ul>
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
        {!! $dataTable->scripts() !!}
    @endpush

    @push('scripts')
        <script>
            $('#reviews thead tr').first().html(`
        <th>No.</th>
        <th>Course</th>
        <th>Student</th>
        <th>Rating</th>
        <th>Detail Review</th>
        <th>Status</th>
        <th>Created At</th>
        <th colspan="2" class="text-center">Action</th>
    `);
            $(document).ready(function() {
                initTable('#reviews');
            });
            $(function() {
                const baseUrl = "{{ url('') }}";

                // Global AJAX CSRF token setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Handle open Edit Modal
                $(document).on("click", '.show-review', function() {
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

