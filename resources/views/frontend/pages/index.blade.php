@extends('frontend.layouts.layout')

@include('frontend.pages.home.sections.menu')

@include('frontend.pages.home.sections.banner');

@include('frontend.pages.home.sections.category');

@include('frontend.pages.home.sections.about');

@section('content')
    <!--===========================
                        COUESES 3 START
                    ============================-->
    @php
        $categoryOne = \App\Models\CourseCategory::where('id', $latestCourses->category_one)->first();
        $categoryTwo = \App\Models\CourseCategory::where('id', $latestCourses->category_two)->first();
        $categoryThree = \App\Models\CourseCategory::where('id', $latestCourses->category_three)->first();
        $categoryFour = \App\Models\CourseCategory::where('id', $latestCourses->category_four)->first();
        $categoryFive = \App\Models\CourseCategory::where('id', $latestCourses->category_five)->first();
    @endphp
    <section class="wsus__courses_3 pt_120 xs_pt_100 mt_120 xs_mt_90 pb_120 xs_pb_100">
        <div class="container">

            <div class="row">
                <div class="col-xl-6 m-auto wow fadeInUp">
                    <div class="wsus__section_heading mb_45">
                        <h5>Featured Courses</h5>
                        <h2>Latest Bundle Courses.</h2>
                    </div>
                </div>
            </div>

            <div class="row wow fadeInUp">
                <div class="col-xxl-6 col-xl-8 m-auto">
                    <div class="wsus__filter_area mb_15">
                        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                            @if ($categoryOne)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-{{ $categoryOne->id }}-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-{{ $categoryOne->id }}" type="button"
                                        role="tab" aria-controls="pills-home"
                                        aria-selected="true">{{ $categoryOne->name }}</button>
                                </li>
                            @endif
                            @if ($categoryTwo)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-{{ $categoryTwo->id }}-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-{{ $categoryTwo->id }}" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">{{ $categoryTwo->name }}</button>
                                </li>
                            @endif
                            @if ($categoryThree)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-{{ $categoryThree->id }}-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-{{ $categoryThree->id }}" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">{{ $categoryThree->name }}</button>
                                </li>
                            @endif
                            @if ($categoryFour)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-{{ $categoryFour->id }}-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-{{ $categoryFour->id }}" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">{{ $categoryFour->name }}</button>
                                </li>
                            @endif
                            @if ($categoryFive)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-{{ $categoryFive->id }}-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-{{ $categoryFive->id }}" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">{{ $categoryFive->name }}</button>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                @if ($categoryOne)
                    <div class="tab-pane fade show" id="pills-{{ $categoryOne->id }}" role="tabpanel"
                        aria-labelledby="pills-{{ $categoryOne->id }}-tab" tabindex="0">
                        <div class="row">
                            @foreach ($categoryOne->courses()->latest()->take(8)->get() as $course)
                                <div class="col-xl-3 col-md-6 col-lg-4">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}"
                                                alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                            alt="Love" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                            alt="Compare" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                            alt="Cart" class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <!-- <a href="#" class="category">Design</a> -->
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D
                                                Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                                        alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt_60 wow fadeInUp">
                            <div class="col-12 text-center">
                                <a class="common_btn" href="#">Browse More Courses <i
                                        class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($categoryTwo)
                    <div class="tab-pane fade show" id="pills-{{ $categoryTwo->id }}" role="tabpanel"
                        aria-labelledby="pills-{{ $categoryTwo->id }}-tab" tabindex="0">
                        <div class="row">
                            @foreach ($categoryTwo->courses()->latest()->take(8)->get() as $course)
                                <div class="col-xl-3 col-md-6 col-lg-4">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}"
                                                alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                            alt="Love" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                            alt="Compare" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                            alt="Cart" class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <!-- <a href="#" class="category">Design</a> -->
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D
                                                Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                                        alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt_60 wow fadeInUp">
                            <div class="col-12 text-center">
                                <a class="common_btn" href="#">Browse More Courses <i
                                        class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($categoryThree)
                    <div class="tab-pane fade show" id="pills-{{ $categoryThree->id }}" role="tabpanel"
                        aria-labelledby="pills-{{ $categoryThree->id }}-tab" tabindex="0">
                        <div class="row">
                            @foreach ($categoryThree->courses()->latest()->take(8)->get() as $course)
                                <div class="col-xl-3 col-md-6 col-lg-4">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}"
                                                alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                            alt="Love" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                            alt="Compare" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                            alt="Cart" class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <!-- <a href="#" class="category">Design</a> -->
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D
                                                Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                                        alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt_60 wow fadeInUp">
                            <div class="col-12 text-center">
                                <a class="common_btn" href="#">Browse More Courses <i
                                        class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($categoryFour)
                    <div class="tab-pane fade show" id="pills-{{ $categoryFour->id }}" role="tabpanel"
                        aria-labelledby="pills-{{ $categoryFour->id }}-tab" tabindex="0">
                        <div class="row">
                            @foreach ($categoryFour->courses()->latest()->take(8)->get() as $course)
                                <div class="col-xl-3 col-md-6 col-lg-4">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}"
                                                alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                            alt="Love" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                            alt="Compare" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                            alt="Cart" class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <!-- <a href="#" class="category">Design</a> -->
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D
                                                Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                                        alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt_60 wow fadeInUp">
                            <div class="col-12 text-center">
                                <a class="common_btn" href="#">Browse More Courses <i
                                        class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($categoryFive)
                    <div class="tab-pane fade show" id="pills-{{ $categoryFive->id }}" role="tabpanel"
                        aria-labelledby="pills-{{ $categoryFive->id }}-tab" tabindex="0">
                        <div class="row">
                            @foreach ($categoryFive->courses()->latest()->take(8)->get() as $course)
                                <div class="col-xl-3 col-md-6 col-lg-4">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}"
                                                alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}"
                                                            alt="Love" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}"
                                                            alt="Compare" class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}"
                                                            alt="Cart" class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <!-- <a href="#" class="category">Design</a> -->
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D
                                                Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}"
                                                        alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i
                                                    class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt_60 wow fadeInUp">
                            <div class="col-12 text-center">
                                <a class="common_btn" href="#">Browse More Courses <i
                                        class="far fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--===========================
                        COUESES 3 END
                    ============================-->



    <!--===========================
                        OFFER START
                    ============================-->
    <section class="wsus__offer" style="background: url('frontend/assets/images/offer_bg.jpg');">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-4 col-md-6 wow fadeInLeft">
                    <div class="wsus__offer_img">
                        <img src="{{ asset('frontend/assets/images/offer_img_1.png') }}" alt="Offer"
                            class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 wow fadeInRight">
                    <div class="wsus__offer_text">
                        <h2>Eager to Receive Special Offers & Updates on Courses?</h2>
                        <form action="#" class="newsletter" method="POST">
                            @csrf
                            <input type="text" name="email" placeholder="Your email address...">
                            <button type="submit" class="common_btn newsletter-btn">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                        OFFER END
                    ============================-->


    <!--===========================
                        BECOME INSTRUCTOR START
                    ============================-->
    <section class="wsus__become_instructor mt_120 xs_mt_100">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-xl-6 col-md-6 wow fadeInLeft">
                    <div class="wsus__become_instructor_text">
                        <div class="wsus__section_heading heading_left mb_20">
                            <h5>Become An Instructor</h5>
                            <h2>{{ $becomeInstructorBanner->title }}</h2>
                        </div>
                        <p>{{ $becomeInstructorBanner->subtitle }}</p>
                        <a class="common_btn"
                            href="{{ $becomeInstructorBanner->button_url }}">{{ $becomeInstructorBanner->button_text }}
                            <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6 wow fadeInRight">
                    <div class="wsus__become_instructor_img">
                        <img src="{{ asset($becomeInstructorBanner->image) }}" alt="Instructor" class="img-fluid w-100">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                        BECOME INSTRUCTOR END
                    ============================-->


    <!--===========================
                        VIDEO START
                    ============================-->
    <section class="wsus__video mt_120 xs_mt_100">
        <img src="{{ asset($video->background) }}" alt="Video" class="img-fluid w-100">
        <a class="play_btn venobox" data-autoplay="true" data-vbtype="video" href="{{ $video->video_url }}">
            <img src="{{ asset('frontend/assets/images/play_icon_white.png') }}" alt="Play" class="img-fluid">
        </a>
        <div class="text wow fadeInLeft">
            <p>{{ $video->description }}</p>
            <a href="{{ $video->button_url }}">{{ $video->button_text }} <i class="far fa-arrow-right"></i></a>
        </div>
    </section>
    <!--===========================
                        VIDEO END
                    ============================-->


    <!--===========================
                        BRAND START
                    ============================-->
    <section class="wsus__brand mt_45 pt_120 xs_pt_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__brand_slider_area wow fadeInUp">
                        <h6>Trusted by Over 24,758 Outstanding Teams</h6>
                        <div class="marquee_animi">
                            <ul class="d-flex flex-wrap">
                                @foreach ($brands as $brand)
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset($brand->image) }}"
                                                alt="brand" class="img-fluid w-100">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                        BRAND END
                    ============================-->


    <!--===========================
                        QUALITY COURSES START
                    ============================-->
    <section class="wsus__quality_courses mt_120 xs_mt_100">
        <div class="row quality_course_slider">
            <div class="quality_course_slider_item"
                style="background: url('frontend/assets/images/quality_courses_bg.jpg');">
                <div class="col-12">
                    <div class="row align-items-center">
                        <div class="col-xxl-5 col-xl-4 col-md-6 col-lg-7 wow fadeInLeft">
                            <div class="wsus__quality_courses_text">
                                <div class="wsus__section_heading heading_left mb_30">
                                    <h5>100% QUALITY COURSES</h5>
                                    <h2>{{ $featuredInstructor->title }}</h2>
                                </div>
                                <p>{{ $featuredInstructor->subtitle }}</p>
                                <a class="common_btn" href="{{ $featuredInstructor->url }}">{{ $featuredInstructor->button_text }} <i
                                        class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 d-none d-xl-block wow fadeInUp">
                            <div class="wsus__quality_courses_img">
                                <img src="{{ asset($featuredInstructor->instructor_image) }}"
                                    alt="Quality Courses" class="img-fluid w-100">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-md-6 col-lg-5 wow fadeInUp">
                            <div class="row quality_course_card_slider">
                                @foreach ($featuredInstructorCourses as $course)
                                   <div class="col-xl-4 col-md-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__single_courses_3">
                            <div class="wsus__single_courses_3_img">
                                <img src="{{ asset($course->thumbnail) }}" alt="Courses" class="img-fluid">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare" class="img-fluid">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                        </a>
                                    </li>
                                </ul>
                                <span class="time"><i class="far fa-clock" aria-hidden="true"></i> 15 Hours</span>
                            </div>
                            <div class="wsus__single_courses_text_3">
                                <div class="rating_area">
                                    <!-- <a href="#" class="category">Design</a> -->
                                    <p class="rating">
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <i class="fas fa-star" aria-hidden="true"></i>
                                        <span>(4.8 Rating)</span>
                                    </p>
                                </div>

                                <a class="title" href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                <ul>
                                    <li>24 Lessons</li>
                                    <li>38 Student</li>
                                </ul>
                                <a class="author" href="#">
                                    <div class="img">
                                        <img src="{{ asset($course->instructor->image) }}" alt="Author" class="img-fluid">
                                    </div>
                                    <h4>{{ $course->instructor->name }}</h4>
                                </a>
                            </div>
                            <div class="wsus__single_courses_3_footer">
                                <a class="common_btn add_to_cart" href="#" data-course-id="{{ $course->id }}">Add to Cart <i class="far fa-arrow-right" aria-hidden="true"></i></a>
                                <p>
                                    @if($course->discount > 0)
                                    <del>${{ $course->price }}</del>${{ $course->discount }}
                                @else
                            ${{ $course->price }}
                                @endif
                        </p>

                            </div>
                        </div>
                    </div>
                                                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                        QUALITY COURSES END
                    ============================-->


    <!--===========================
                        TESTIMONIAL START
                    ============================-->
    <section class="wsus__testimonial pt_120 xs_pt_80">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 m-auto wow fadeInUp">
                    <div class="wsus__section_heading mb_40">
                        <h5>Testimonial</h5>
                        <h2>See what your students say</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row testimonial_slider">
            <div class="col-xl-4 wow fadeInUp">
                @foreach ($testimonials as $testimonial)
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        @for($i = 1; $i <= $testimonial->rating; $i++)
                        <i class="fas fa-star"></i>
                        @endfor
                    </p>
                    <p class="description">{{ $testimonial->review }}</p>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="{{ asset($testimonial->user_image) }}" alt="user"
                                class="img-fluid">
                        </div>
                        <h3>
                            {{ $testimonial->user_name }}
                            <span>{{ $testimonial->user_title }}</span>
                        </h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--===========================
                        TESTIMONIAL END
                    ============================-->


    <!--===========================
                        BLOG 4 START
                    ============================-->
    <section class="blog_4 mt_110 xs_mt_90 pt_120 xs_pt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 wow fadeInLeft">
                    <div class="wsus__section_heading heading_left mb_50">
                        <h5>Latest blogs</h5>
                        <h2>Our Latest News Feed.</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row blog_4_slider">
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="#" class="wsus__single_blog_4_img">
                        <img src="{{ asset('frontend/assets/images/blog_4_img_1.jpg') }}" alt="Blog"
                            class="img-fluid">
                        <span class="date">March 23, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/user_icon_black.png') }}"
                                        alt="User" class="img-fluid"></span>
                                By Richard Tea
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}"
                                        alt="Comment" class="img-fluid"></span>
                                3 Comments
                            </li>
                        </ul>
                        <a href="#" class="title">Exploring Learning Landscapes in Academic.</a>
                        <p>Suspends dictum sed sem allium convallis Proin dictum ipsum.</p>
                        <a href="#" class="common_btn">Read More <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="#" class="wsus__single_blog_4_img">
                        <img src="{{ asset('frontend/assets/images/blog_4_img_2.jpg') }}" alt="Blog"
                            class="img-fluid">
                        <span class="date">April 28, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/user_icon_black.png') }}"
                                        alt="User" class="img-fluid"></span>
                                By Doug Lyphe
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}"
                                        alt="Comment" class="img-fluid"></span>
                                21 Comments
                            </li>
                        </ul>
                        <a href="#" class="title">Uncovering Learning Opportunities in Academia.</a>
                        <p>Suspends dictum sed sem allium convallis Proin dictum ipsum.</p>
                        <a href="#" class="common_btn">Read More <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="#" class="wsus__single_blog_4_img">
                        <img src="{{ asset('frontend/assets/images/blog_4_img_3.jpg') }}" alt="Blog"
                            class="img-fluid">
                        <span class="date">Jan 12, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/user_icon_black.png') }}"
                                        alt="User" class="img-fluid"></span>
                                By Eleanor Fant
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}"
                                        alt="Comment" class="img-fluid"></span>
                                48 Comments
                            </li>
                        </ul>
                        <a href="#" class="title">Internationally Distinguished Skillful Educators.</a>
                        <p>Suspends dictum sed sem allium convallis Proin dictum ipsum.</p>
                        <a href="#" class="common_btn">Read More <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_blog_4">
                    <a href="#" class="wsus__single_blog_4_img">
                        <img src="{{ asset('frontend/assets/images/blog_4_img_4.jpg') }}" alt="Blog"
                            class="img-fluid">
                        <span class="date">April 28, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/user_icon_black.png') }}"
                                        alt="User" class="img-fluid"></span>
                                By Doug Lyphe
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}"
                                        alt="Comment" class="img-fluid"></span>
                                21 Comments
                            </li>
                        </ul>
                        <a href="#" class="title">Uncovering Learning Opportunities in Academia.</a>
                        <p>Suspends dictum sed sem allium convallis Proin dictum ipsum.</p>
                        <a href="#" class="common_btn">Read More <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
                        BLOG 4 END
                    ============================-->
@endsection
