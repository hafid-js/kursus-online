@extends('frontend.layouts.layout')

@section('content')
    <!--=========================== BREADCRUMB START ============================-->
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
    <!--=========================== BREADCRUMB END ============================-->

    <!--=========================== DASHBOARD OVERVIEW START ============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.sidebar')
                <div class="col-xl-9 col-md-8 wow fadeInRight">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top">
                            <div class="wsus__dashboard_heading">
                                <h5>Reviews</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>

                        <form class="wsus__dash_course_searchbox wsus__dash_reviews_searchbox">
                            <div class="selector_1">
                                <select class="select_js">
                                    <option value="">All Reviews</option>
                                    <!-- Add options dynamically if needed -->
                                </select>
                            </div>
                            <div class="selector">
                                <select class="select_js">
                                    <option value="">Rating</option>
                                    <!-- Add options dynamically if needed -->
                                </select>
                            </div>
                        </form>

                        <div id="reviews-wrapper" class="wsus__dash_reviews">
                            <!-- Reviews will be loaded here via AJAX -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================== DASHBOARD OVERVIEW END ============================-->
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $.ajax({
            url: "{{ route('instructor.review.index') }}",
            type: "GET",
            dataType: "json",
            success: function (res) {
                if (res.data.length === 0) {
                    $('#reviews-wrapper').html('<p class="text-center">No Reviews Found</p>');
                    return;
                }

                let html = '';
                res.data.forEach(function (item) {
                    html += item.html;
                });

                $('#reviews-wrapper').html(html);
            },
            error: function () {
                $('#reviews-wrapper').html('<p class="text-danger text-center">Failed to load reviews</p>');
            }
        });
    });
</script>
@endpush
