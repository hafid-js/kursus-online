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
                            <div class="wsus__dashboard_heading">
                                <h5>Reviews</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <form action="#" class="wsus__dash_course_searchbox wsus__dash_reviews_searchbox">
                            <div class="selector_1">
                                <select class="select_js" style="display: none;">
                                    <option value="">All Reviews</option>
                                    <option value="">All Reviews 1</option>
                                    <option value="">All Reviews 2</option>
                                </select>
                                <div class="nice-select select_js" tabindex="0"><span class="current">All Reviews</span>
                                    <ul class="list">
                                        <li data-value="" class="option selected">All Reviews</li>
                                        <li data-value="" class="option">All Reviews 1</li>
                                        <li data-value="" class="option">All Reviews 2</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="selector">
                                <select class="select_js" style="display: none;">
                                    <option value="">Rating</option>
                                    <option value="">Rating 1</option>
                                    <option value="">Rating 2</option>
                                </select>
                                <div class="nice-select select_js" tabindex="0"><span class="current">Rating</span>
                                    <ul class="list">
                                        <li data-value="" class="option selected focus">Rating</li>
                                        <li data-value="" class="option">Rating 1</li>
                                        <li data-value="" class="option">Rating 2</li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <div class="wsus__dash_reviews">
                            <div id="reviews-container"></div>
                        </div>

                    </div>
                    <div class="wsus__pagination mt_50 wow fadeInUp"
                            style="visibility: visible; animation-name: fadeInUp;">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination" id="pagination-links">
                                </ul>
                            </nav>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                                    DASHBOARD OVERVIEW END
                                ============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const $container = $('#reviews-container');
            const $pagination = $('#pagination-links');
            const pageLength = 8;
            let currentPage = 1;

            function loadReviews(page = 1) {
                $.ajax({
                    url: '{{ route('instructor.review.index') }}',
                    data: {
                        draw: 1,
                        start: (page - 1) * pageLength,
                        length: pageLength,
                    },
                    success: function(res) {
                        $container.empty();

                        if (res.data.length === 0) {
                            $container.html('<p>No reviews found.</p>');
                        } else {
                            res.data.forEach(function(item) {
                                $container.append(item.review);
                            });
                        }

                        updatePagination(page, res.recordsTotal);
                    },
                    error: function() {
                        $container.html('<p>Failed to load reviews.</p>');
                    }
                });
            }

            function updatePagination(page, total) {
                const totalPages = Math.ceil(total / pageLength);
                $pagination.empty();

                let html = `
        <li class="page-item ${page === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${page - 1}" aria-label="Previous">
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
            <a class="page-link" href="#" data-page="${page + 1}" aria-label="Next">
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
                if (page && page !== currentPage) {
                    currentPage = page;
                    loadReviews(currentPage);
                }
            });

            loadReviews(currentPage);
        });
    </script>
@endpush
