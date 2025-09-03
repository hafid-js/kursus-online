@extends('frontend.layouts.layout')

@section('content')
    <!--===========================
            BREADCRUMB START
        ============================-->
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Reviews</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Reviews</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
            BREADCRUMB END
        ============================-->
    <!--===========================
            DASHBOARD OVERVIEW START
        ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading d-flex justify-content-between align-items-start">
                                <div>
                                    <h5>Reviews</h5>
                                    <p>Manage your courses and its update like live, draft and insight.</p>
                                </div>
                                <a class="btn btn-primary" href="{{ route('instructor.courses.index') }}">
                                    <i class="fa fa-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>

                        <form id="filter-form" class="wsus__dash_course_searchbox wsus__dash_reviews_searchbox">
                            <div class="selector">
                                <select id="rating" class="select_js">
                                    <option value="">All Ratings</option>
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                </select>
                            </div>
                            <div class="selector">
                                <select id="sort" class="select_js">
                                    <option value="">Sort By</option>
                                    <option value="rating_desc">Rating: High to Low</option>
                                    <option value="rating_asc">Rating: Low to High</option>
                                    <option value="date_desc">Date: Newest First</option>
                                    <option value="date_asc">Date: Oldest First</option>
                                </select>
                            </div>
                        </form>

                        <div class="wsus__dash_reviews">
                            <div id="reviews-container"></div>
                        </div>

                    </div>
                    <div class="wsus__pagination mt_50 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination" id="pagination-links"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const $container = $('#reviews-container');
            const $pagination = $('#pagination-links');
            const pageLength = 8;
            let currentPage = 1;

            function loadReviews(page = 1) {
                $container.html(`
                    <div style="display: flex; justify-content: center; align-items: center; height: 150px;">
                        <div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `);

                const rating = $('#rating').val();
                const sort = $('#sort').val();

                $.ajax({
                    url: '{{ route('instructor.review.index') }}',
                    data: {
                        draw: 1,
                        start: (page - 1) * pageLength,
                        length: pageLength,
                        rating: rating,
                        sort: sort,
                    },
                    success: function(res) {
                        $container.empty();

                        if (!res.data || res.data.length === 0) {
                            $container.html('<p>No reviews found.</p>');
                        } else {
                            res.data.forEach(function(item) {
                                $container.append(item.review);
                            });
                        }

                        updatePagination(page, res.recordsTotal);
                    },
                    error: function(xhr, status, error) {
                        console.error('Load reviews failed:', error);
                        $container.html('<p>Failed to load reviews. Please try again.</p>');
                    }
                });
            }


            function updatePagination(page, total) {
                const totalPages = Math.ceil(total / pageLength);
                $pagination.empty();

                if (totalPages === 0) return;

                let html = `
                <li class="page-item ${page === 1 ? 'disabled' : ''}">
                    <a class="page-link d-flex justify-content-center align-items-center"
                       href="#" data-page="${page - 1 > 0 ? page - 1 : 1}" aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="icon icon-1">
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                    </a>
                </li>
                `;

                for (let i = 1; i <= totalPages; i++) {
                    html += `
                    <li class="page-item ${i === page ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>
                    `;
                }

                html += `
                <li class="page-item ${page === totalPages ? 'disabled' : ''}">
                    <a class="page-link d-flex justify-content-center align-items-center" href="#" data-page="${page + 1 <= totalPages ? page + 1 : totalPages}" aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="icon icon-1">
                            <path d="M9 6l6 6l-6 6"></path>
                        </svg>
                    </a>
                </li>
                `;

                $pagination.html(html);
            }

            $pagination.on('click', 'a.page-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');

                if (page && page > 0 && page !== currentPage) {
                    currentPage = page;
                    loadReviews(currentPage);
                }
            });

            $('#rating, #sort').on('change', function() {
                currentPage = 1;
                loadReviews(currentPage);
            });
            loadReviews(currentPage);

            $(document).on('click', '.dash_review_reply', function(e) {
                e.preventDefault();
                const reviewId = $(this).data('id');
                const replyId = $(this).data('reply-id') || '';

                $('#replyModal input[name="review_id"]').val(reviewId);
                $('#replyModal input[name="reply_id"]').val(replyId);
                $('#replyModal textarea[name="reply"]').val($(this).data('reply-text') || '');
                $('#replyModal').modal('show');
            });

            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'bottom',
                },
                types: [{
                        type: 'error',
                        background: '#dc3545',
                        icon: {
                            className: 'fas fa-times',
                            tagName: 'i',
                            text: '',
                        }
                    },
                    {
                        type: 'success',
                        background: '#28a745',
                        icon: {
                            className: 'material-icons',
                            tagName: 'span',
                            text: 'check_circle'
                        }
                    }
                ]
            });

            $('#reply-form').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const reviewId = form.find('input[name="review_id"]').val();
                const replyId = form.find('input[name="reply_id"]').val();
                const replyText = form.find('textarea[name="reply"]').val().trim();

                const $submitBtn = form.find('button[type="submit"]');
                const defaultBtnText = `<i class="fas fa-paper-plane me-1"></i>Submit`;

                if (!replyText) {
                    notyf.error('Please write a reply.');
                    return;
                }

                const isEdit = !!replyId;

                $submitBtn.prop('disabled', true).html(`
        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
        Saving...
    `);

                $.ajax({
                    url: isEdit ? '{{ route('instructor.review.reply.update') }}' :
                        '{{ route('instructor.review.reply') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        review_id: reviewId,
                        reply_id: replyId,
                        reply: replyText,
                    },
                    success: function(res) {
                        $('#replyModal').modal('hide');
                        form[0].reset();
                        notyf.success(res.message || (isEdit ? 'Reply updated successfully!' :
                            'Reply sent successfully!'));
                        loadReviews(currentPage);
                    },
                    error: function(xhr) {
                        const message = xhr.responseJSON?.message ||
                            'Failed to save reply. Please try again.';
                        notyf.error(message);
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false).html(defaultBtnText);
                    }
                });
            });
        });
    </script>
@endpush

<!-- Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="reply-form" class="modal-content shadow-lg border-0 rounded">
            @csrf
            <input type="hidden" name="reply_id">
            <input type="hidden" name="review_id">
            <div class="modal-header text-white">
                <h6 class="modal-title" id="replyModalLabel">
                    <i class="fas fa-reply me-2"></i>Reply to Review
                </h6>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <textarea rows="10" name="reply" class="form-control" placeholder="Write your reply here..."></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btnPrimary">
                    <i class="fas fa-paper-plane me-1"></i>Submit
                </button>
            </div>
        </form>
    </div>
</div>
