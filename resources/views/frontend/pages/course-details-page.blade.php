@extends('frontend.layouts.layout')

@push('meta')
    <meta property="og:title" content="{{ $course->title }}">
    <meta property="og:description" content="{{ $course->seo_description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($course->thumbnail) }}">
    <meta property="og:type" content="Course">
@endpush
@section('content')
    <section class="wsus__breadcrumb course_details_breadcrumb"
        style="background: url({{ asset('frontend/assets/images/breadcrumb_bg.jpg') }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <p class="rating">
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <span>(4 Reviews)</span>
                            </p>
                            <h1>{{ $course->title }}</h1>
                            <ul class="list">
                                <li>
                                    <span><img src="{{ asset($course->instructor->image) }}" alt="user"
                                            class="img-fluid"></span>
                                    By {{ $course->instructor->name }}
                                </li>
                                <li>
                                    <span><img src="{{ asset('frontend/assets/images/globe_icon_blue.png') }}"
                                            alt="Globe" class="img-fluid"></span>
                                    {{ $course->category->name }}
                                </li>
                                <li>
                                    <span><img src="{{ asset('frontend/assets/images/calendar_blue.png') }}" alt="Calendar"
                                            class="img-fluid"></span>
                                    Last updated {{ date('d/M/Y', strtotime($course->updated_at)) }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__courses_details pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="wsus__courses_details_area mt_40">

                        <ul class="nav nav-pills mb_40" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false" tabindex="-1">Curriculum</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false" tabindex="-1">Instructor</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-disabled" type="button" role="tab"
                                    aria-controls="pills-disabled" aria-selected="false" tabindex="-1">FAQs</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-disabled-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-disabled2" type="button" role="tab"
                                    aria-controls="pills-disabled2" aria-selected="false" tabindex="-1">Review</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="wsus__courses_overview box_area">
                                    <h3>Course Description</h3>
                                    <p>{{ $course->description }}
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="wsus__courses_curriculum box_area">
                                    <h3>Course Curriculum</h3>
                                    <div class="accordion" id="accordionExample">
                                        @foreach ($course->chapters as $chapter)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $chapter->id }}" aria-expanded="true"
                                                    aria-controls="collapse-{{ $chapter->id }}">
                                                    {{ $chapter->title }}
                                                </button>
                                            </h2>
                                            <div id="collapse-{{ $chapter->id }}" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <ul>
                                                        @foreach ($chapter->lessons as $lesson)
                                                        <li class="{{ $lesson->is_preview == 1 ? 'active' : '' }}">
                                                            <p>{{ $lesson->title }}</p>
                                                            @if($lesson->is_preview == 1)
                                                            <a href="{{ $lesson->file_path }}" class="right_text venobox vbox-item">Preview</a>
                                                            @else
                                                              <span class="right_text">{{ convertMinutesToHours($lesson->duration) }}</span>
                                                            @endif
                                                        </li>
                                                         @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <div class="wsus__courses_instructor box_area">
                                    <h3>Instructor Details</h3>
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="wsus__courses_instructor_img">
                                                <img src="{{ asset('frontend/assets/images/course_instructor_img.jpg') }}" alt="Instructor"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-6">
                                            <div class="wsus__courses_instructor_text">
                                                <h4>Ravi O'Leigh</h4>
                                                <p class="designation">IT Technician at IBM</p>
                                                <ul class="list">
                                                    <li><i class="fas fa-star" aria-hidden="true"></i> <b>74,537
                                                            Reviews</b></li>
                                                    <li><strong>4.7 Rating</strong></li>
                                                    <li>
                                                        <span><img src="{{ asset('frontend/assets/images/book_icon.png') }}" alt="book"
                                                                class="img-fluid"></span>
                                                        8 Courses
                                                    </li>
                                                    <li>
                                                        <span><img src="{{ asset('frontend/assets/images/user_icon_gray.png') }}" alt="user"
                                                                class="img-fluid"></span>
                                                        32 Students
                                                    </li>
                                                </ul>
                                                <ul class="badge d-flex flex-wrap">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Exclusive Author">
                                                        <img src="{{ asset('frontend/assets/images/badge_1.png') }}" alt="Badge" class="img-fluid">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Top Earning"><img src="{{ asset('frontend/assets/images/badge_2.png') }}"
                                                            alt="Badge" class="img-fluid"></li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Trending"><img src="{{ asset('frontend/assets/images/badge_3.png') }}"
                                                            alt="Badge" class="img-fluid"></li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="2 Years of Membership"><img
                                                            src="{{ asset('frontend/assets/images/badge_4.png') }}" alt="Badge" class="img-fluid">
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Collector Lavel 1">
                                                        <img src="{{ asset('frontend/assets/images/badge_5.png') }}" alt="Badge" class="img-fluid">
                                                    </li>
                                                </ul>
                                                <p class="description">
                                                    Sed mi leo placerat nulla Donec pharetra rutrum ullamcorpe Ut eget
                                                    convallis mi. Sed cursus aliquam Nula sed allium lectus fermentum
                                                    enim Nam maximus pretium consectetu lacinia finibus.
                                                </p>
                                                <ul class="link d-flex flex-wrap">
                                                    <li><a href="#"><i class="fab fa-twitter"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-facebook-f"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"
                                                                aria-hidden="true"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-pinterest-p"
                                                                aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-disabled" role="tabpanel"
                                aria-labelledby="pills-disabled-tab" tabindex="0">
                                <div class="wsus__course_faq box_area">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapse-{{ $chapter->id }}" aria-expanded="false"
                                                    aria-controls="flush-collapse-{{ $chapter->id }}">
                                                    How long it take to create a video course?
                                                </button>
                                            </h2>
                                            <div id="flush-collapse-{{ $chapter->id }}" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec
                                                    pharetra rutrum
                                                    ullamcorpe Ut eget convallis mi. Sed cursus aliquam eitu Nula sed
                                                    allium lectus
                                                    fermentum enim Nam maximus pretium consectetu lacinia finibus ipsum,
                                                    eget
                                                    fermentum nulla Pellentesque id facilisis magna dictum.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    What kind of support does EduCore provide?
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec
                                                    pharetra rutrum
                                                    ullamcorpe Ut eget convallis mi. Sed cursus aliquam eitu Nula sed
                                                    allium lectus
                                                    fermentum enim Nam maximus pretium consectetu lacinia finibus ipsum,
                                                    eget
                                                    fermentum nulla Pellentesque id facilisis magna dictum.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                    aria-expanded="false" aria-controls="flush-collapseThree">
                                                    How long do I get support &amp; updates?
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">Placeholder content for this accordion,
                                                    Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec
                                                    pharetra rutrum
                                                    ullamcorpe Ut eget convallis mi. Sed cursus aliquam eitu Nula sed
                                                    allium lectus
                                                    fermentum enim Nam maximus pretium consectetu lacinia finibus ipsum,
                                                    eget
                                                    fermentum nulla Pellentesque id facilisis magna dictum.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree3"
                                                    aria-expanded="false" aria-controls="flush-collapseThree">
                                                    How can I contact a school directly?
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree3" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec
                                                    pharetra rutrum
                                                    ullamcorpe Ut eget convallis mi. Sed cursus aliquam eitu Nula sed
                                                    allium lectus
                                                    fermentum enim Nam maximus pretium consectetu lacinia finibus ipsum,
                                                    eget
                                                    fermentum nulla Pellentesque id facilisis magna dictum.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-disabled2" role="tabpanel"
                                aria-labelledby="pills-disabled-tab2" tabindex="0">
                                <div class="wsus__courses_review box_area">
                                    <h3>Customer Reviews</h3>
                                    <div class="row align-items-center mb_50">
                                        <div class="col-xl-4 col-md-6">
                                            <div class="total_review">
                                                <h2>4.7</h2>
                                                <p>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                </p>
                                                <h4>3 Ratings</h4>
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-md-6">
                                            <div class="review_bar">
                                                <div class="review_bar_single">
                                                    <p>5 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar1" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">85%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="85"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">87</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>4 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar2" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">70%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="70"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">69</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>3 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar3" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">50%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="50"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">44</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>2 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar4" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">30%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="30"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">29</span>
                                                </div>
                                                <div class="review_bar_single">
                                                    <p>1 <i class="fas fa-star" aria-hidden="true"></i></p>
                                                    <div id="bar5" class="barfiller">
                                                        <div class="tipWrap" style="display: inline;">
                                                            <span class="tip"
                                                                style="left: 8px; transition: left 1s ease-in-out;">10%</span>
                                                        </div>
                                                        <span class="fill" data-percentage="10"
                                                            style="background: rgb(22, 181, 151); width: 0px; transition: width 1s ease-in-out;"></span>
                                                    </div>
                                                    <span class="qnty">12</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <h3>Reviews</h3>
                                    <div class="wsus__course_single_reviews">
                                        <div class="wsus__single_review_img">
                                            <img src="{{ asset('frontend/assets/images/testimonial_user_1.png') }}" alt="user" class="img-fluid">
                                        </div>
                                        <div class="wsus__single_review_text">
                                            <h4>Dominic L. Ement</h4>
                                            <h6> March 23,2024 at 8:37 pm
                                                <span>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                </span>
                                            </h6>
                                            <p>Donec vel mauris at lectus iaculis elementum vel vel
                                                lacus. Sed finibus velit vitae risus imperdiet placerat. Ut posuere eros
                                                ut molestie rhoncus. Duis eget ex elementum, ultricies dolor sed,
                                                hendrerit diam. Donec ut blandit nunc, et tempus lorem.</p>
                                        </div>
                                    </div>
                                    <div class="wsus__course_single_reviews">
                                        <div class="wsus__single_review_img">
                                            <img src="{{ asset('frontend/assets/images/testimonial_user_2.png') }}" alt="user" class="img-fluid">
                                        </div>
                                        <div class="wsus__single_review_text">
                                            <h4>Smith jhon</h4>
                                            <h6> March 23,2024 at 8:37 pm
                                                <span>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                    <i class="fas fa-star" aria-hidden="true"></i>
                                                </span>
                                            </h6>
                                            <p>Donec vel mauris at lectus iaculis elementum vel vel
                                                lacus. Sed finibus velit vitae risus imperdiet placerat. Ut posuere eros
                                                ut molestie rhoncus. Duis eget ex elementum, ultricies dolor sed,
                                                hendrerit diam. Donec ut blandit nunc, et tempus lorem.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="wsus__courses_review_input box_area mt_40">
                                    <h3>Write a Review</h3>
                                    <p class="short_text">Your email address will not be published. Required fields are
                                        marked *</p>
                                    <div class="select_rating d-flex flex-wrap">Your Rating:
                                        <ul id="starRating" data-stars="5" class="starrating-init">
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                            <li class="star"><i class="fa fa-star" aria-hidden="true"></i></li>
                                        </ul>
                                    </div>
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <input type="text" placeholder="Name">
                                            </div>
                                            <div class="col-xl-6">
                                                <input type="email" placeholder="Email">
                                            </div>
                                            <div class="col-xl-12">
                                                <textarea rows="7" placeholder="Comments"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Save my name, email, and website in this browser for the next
                                                        time I comment.
                                                    </label>
                                                </div>
                                                <a href="#" class="common_btn">Post Comment</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__courses_sidebar">
                        <div class="wsus__courses_sidebar_video">
                            <img src="{{ asset($course->thumbnail) }}" alt="Video" class="img-fluid">
                            <a class="play_btn venobox vbox-item" data-autoplay="true" data-vbtype="video"
                                href="{{ $course->demo_video_source }}">
                                <img src="{{ asset('frontend/assets/images/play_icon_white.png') }}" alt="Play"
                                    class="img-fluid">
                            </a>
                        </div>
                        <h3 class="wsus__courses_sidebar_price">
                            @if($course->discount > 0)
                            Price: <del>${{ config('settings.currency_icon') }}{{ $course->price }}</del>${{ $course->discount }}
                            @elseif($course->price <= 0)
                                FREE
                            @else
                               Price: ${{ config('settings.currency_icon') }}{{ $course->price }}
                            @endif
                        </h3>
                        <div class="wsus__courses_sidebar_list_info">
                            <ul>
                                <li>
                                    <p>
                                        <span><img src="{{ asset('frontend/assets/images/clock_icon_black.png') }}" alt="clock"
                                                class="img-fluid"></span>
                                        Course Duration
                                    </p>
                                    {{ convertMinutesToHours($course->duration) }}
                                </li>
                                <li>
                                    <p>
                                        <span><img src="{{ asset('frontend/assets/images/network_icon_black.png') }}" alt="network"
                                                class="img-fluid"></span>
                                        Skill Level
                                    </p>
                                    {{ $course->level->name }}
                                </li>
                                <li>
                                    <p>
                                        <span><img src="{{ asset('frontend/assets/images/user_icon_black_2.png') }}" alt="User"
                                                class="img-fluid"></span>
                                        Student Enrolled
                                    </p>
                                    47
                                </li>
                                <li>
                                    <p>
                                        <span><img src="{{ asset('frontend/assets/images/language_icon_black.png') }}" alt="Language"
                                                class="img-fluid"></span>
                                        Language
                                    </p>
                                    {{ $course->language->name }}
                                </li>
                            </ul>
                            <a class="common_btn" href="#">Enroll The Course <i class="far fa-arrow-right"
                                    aria-hidden="true"></i></a>
                        </div>
                        <div class="wsus__courses_sidebar_share_btn d-flex flex-wrap justify-content-between">
                            <a href="#" class="common_btn"><i class="far fa-heart" aria-hidden="true"></i> Add to
                                Wishlist</a>
                        </div>
                        <div class="wsus__courses_sidebar_share_area">
                            <span>Share:</span>
                            <ul>
                                <li class="ez-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="ez-linkedin"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li class="ez-x"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="ez-reddit"><a href="#"><i class="fab fa-reddit"></i></a></li>
                            </ul>
                        </div>
                        <div class="wsus__courses_sidebar_info">
                            <h3>This Course Includes</h3>
                            <ul>
                                <li>
                                    <span><img src="{{ asset('frontend/assets/images/video_icon_black.png') }}" alt="video" class="img-fluid"></span>
                                    {{ convertMinutesToHours($course->duration) }} Video Lectures
                                </li>
                                @if($course->certificate)
                                <li>
                                    <span><img src="{{ asset('frontend/assets/images/certificate_icon_black.png') }}" alt="Certificate"
                                            class="img-fluid"></span>
                                    Certificate of Completion
                                </li>
                                @endif
                                <li>
                                    <span><img src="{{ asset('frontend/assets/images/life_time_icon.png') }}" alt="Certificate"
                                            class="img-fluid"></span>
                                    Course Lifetime Access
                                </li>
                            </ul>

                        </div>
                        <div class="wsus__courses_sidebar_instructor">
                            <div class="image_area d-flex flex-wrap align-items-center">
                                <div class="img">
                                    <img src="{{ asset($course->instructor->image) }}" alt="Instructor" class="img-fluid">
                                </div>
                                <div class="text">
                                    <h3>{{ $course->instructor->name }}</h3>
                                    <p><span>Instructor</span> Level 2</p>
                                </div>
                            </div>
                            <ul class="d-flex flex-wrap">
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Exclusive Author">
                                    <img src="{{ asset('frontend/assets/images/badge_1.png') }}" alt="Badge" class="img-fluid">
                                </li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Top Earning"><img
                                        src="{{ asset('frontend/assets/images/badge_2.png') }}" alt="Badge" class="img-fluid"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Trending"><img
                                        src="{{ asset('frontend/assets/images/badge_3.png') }}" alt="Badge" class="img-fluid"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="2 Years of Membership"><img src="{{ asset('frontend/assets/images/badge_4.png') }}" alt="Badge"
                                        class="img-fluid"></li>
                                <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Collector Lavel 1">
                                    <img src="{{ asset('frontend/assets/images/badge_5.png') }}" alt="Badge" class="img-fluid">
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!DOCTYPE html>
<html>
<head>
    <title>Test ezShare</title>
    <script src="https://cdn.jsdelivr.net/gh/shakilahmed0369/ez-share/dist/ez-share.min.js"></script>
</head>
<body>

    <h1>Share this page</h1>

    <button class="ez-facebook" data-url="{{ url()->current() }}">Share on Facebook</button>
    <button class="ez-x" data-url="{{ url()->current() }}" data-text="Lihat ini!" data-hashtags="Laravel,PHP">Share on Twitter</button>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (typeof ezShare !== 'undefined') {
                ezShare.execute(); // atau ezShare.init();
            } else {
                console.error("ezShare is not defined");
            }
        });
    </script>

</body>
</html>

                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/shakilahmed0369/ez-share/dist/ez-share.min.js"></script>
@endpush
