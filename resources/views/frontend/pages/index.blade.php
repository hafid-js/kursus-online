@extends('frontend.layouts.layout')

@include('frontend.pages.home.sections.menu')

@include('frontend.pages.home.sections.banner');

@include('frontend.pages.home.sections.category');

@include('frontend.pages.home.sections.about');

@section('content')


    <!--===========================
        COUESES 3 START
    ============================-->
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
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">All Courses</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-profile" type="button" role="tab"
                                    aria-controls="pills-profile" aria-selected="false">Design</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-contact" type="button" role="tab"
                                    aria-controls="pills-contact" aria-selected="false">Technology</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-disabled" type="button" role="tab"
                                    aria-controls="pills-disabled" aria-selected="false">Finance</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-disabled-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-disabled2" type="button" role="tab"
                                    aria-controls="pills-disabled2" aria-selected="false">Development</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_2.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_3.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_4.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_9.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_6.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_7.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_8.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="#">Browse More Courses <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_2.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_3.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_4.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_9.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_6.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_7.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_8.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="#">Browse More Courses <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                    tabindex="0">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_2.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_3.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_4.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_9.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_6.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_7.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_8.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="#">Browse More Courses <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab"
                    tabindex="0">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_2.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_3.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_4.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_9.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_6.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_7.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_8.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="#">Browse More Courses <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-disabled2" role="tabpanel" aria-labelledby="pills-disabled-tab2"
                    tabindex="0">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_2.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_3.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_4.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_9.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_6.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Business</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.9 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">50 Tips For Designing an Exceptional
                                        Online Learning Progress.</a>
                                    <ul>
                                        <li>32 Lessons</li>
                                        <li>48 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hugh Millie-Yate</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$239.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_7.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
                                            </a>
                                        </li>
                                    </ul>
                                    <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                </div>
                                <div class="wsus__single_courses_text_3">
                                    <div class="rating_area">
                                        <!-- <a href="#" class="category">Marketing</a> -->
                                        <p class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <span>(4.8 Rating)</span>
                                        </p>
                                    </div>

                                    <a class="title" href="#">Holistic Internet-Based Instruction
                                        Mastery Program.</a>
                                    <ul>
                                        <li>37 Lessons</li>
                                        <li>56 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Dominic L. Ement</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p>$199.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-lg-4">
                            <div class="wsus__single_courses_3">
                                <div class="wsus__single_courses_3_img">
                                    <img src="{{ asset('frontend/assets/images/courses_3_img_8.jpg') }}" alt="Courses" class="img-fluid">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love" class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                    class="img-fluid">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart" class="img-fluid">
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

                                    <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                    <ul>
                                        <li>24 Lessons</li>
                                        <li>38 Student</li>
                                    </ul>
                                    <a class="author" href="#">
                                        <div class="img">
                                            <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                        </div>
                                        <h4>Hermann P. Schnitzel</h4>
                                    </a>
                                </div>
                                <div class="wsus__single_courses_3_footer">
                                    <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                    <p><del>$254</del> $156.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt_60 wow fadeInUp">
                        <div class="col-12 text-center">
                            <a class="common_btn" href="#">Browse More Courses <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
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
                        <img src="{{ asset('frontend/assets/images/offer_img_1.png') }}" alt="Offer" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 wow fadeInRight">
                    <div class="wsus__offer_text">
                        <h2>Eager to Receive Special Offers & Updates on Courses?</h2>
                        <form action="#">
                            <input type="text" placeholder="Your email address...">
                            <button type="submit" class="common_btn">Subscribe</button>
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
                            <h2>Be a Member & Share Your Knowledge.</h2>
                        </div>
                        <p>LMS allows administrators and instructors to create, organize, and deliver courses. This
                            includes uploading course content, managing materials, and setting assessments.</p>
                        <a class="common_btn" href="#">Become An Instructor <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-5 col-md-6 wow fadeInRight">
                    <div class="wsus__become_instructor_img">
                        <img src="{{ asset('frontend/assets/images/become_instructor_img.png') }}" alt="Instructor" class="img-fluid w-100">
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
        <img src="{{ asset('frontend/assets/images/video_bg.jpg') }}" alt="Video" class="img-fluid w-100">
        <a class="play_btn venobox" data-autoplay="true" data-vbtype="video"
            href="https://youtu.be/sVPYIRF9RCQ?si=labNkx-xlyOWtptr">
            <img src="{{ asset('frontend/assets/images/play_icon_white.png') }}" alt="Play" class="img-fluid">
        </a>
        <div class="text wow fadeInLeft">
            <p>LMS allows administrators and instructors to create, organize, and deliver courses. This includes
                uploading course content, managing materials, and setting assessments.Cras quis ligula ac felis Donec
                cursus augue quis maximus morbi senectus.</p>
            <a href="#">Free Online Courses <i class="far fa-arrow-right"></i></a>
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
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/images/brand_icon_1.png') }}" alt="brand" class="img-fluid w-100">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/images/brand_icon_2.png') }}" alt="brand" class="img-fluid w-100">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/images/brand_icon_3.png') }}" alt="brand" class="img-fluid w-100">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/images/brand_icon_4.png') }}" alt="brand" class="img-fluid w-100">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/images/brand_icon_5.png') }}" alt="brand" class="img-fluid w-100">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/images/brand_icon_6.png') }}" alt="brand" class="img-fluid w-100">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/images/brand_icon_7.png') }}" alt="brand" class="img-fluid w-100">
                                    </a>
                                </li>
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
            <div class="quality_course_slider_item" style="background: url('frontend/assets/images/quality_courses_bg.jpg');">
                <div class="col-12">
                    <div class="row align-items-center">
                        <div class="col-xxl-5 col-xl-4 col-md-6 col-lg-7 wow fadeInLeft">
                            <div class="wsus__quality_courses_text">
                                <div class="wsus__section_heading heading_left mb_30">
                                    <h5>100% QUALITY COURSES</h5>
                                    <h2>Find Your Match From The Spotlighted Collection</h2>
                                </div>
                                <p>Quisque vitae dignissim nunc, a molestie nisi. Orci varius natoque penatibus
                                    parturient
                                    nascetu
                                    mus.</p>
                                <a class="common_btn" href="#">all Featured Courses <i
                                        class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 d-none d-xl-block wow fadeInUp">
                            <div class="wsus__quality_courses_img">
                                <img src="{{ asset('frontend/assets/images/quality_courses_img.png') }}" alt="Quality Courses" class="img-fluid w-100">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-md-6 col-lg-5 wow fadeInUp">
                            <div class="row quality_course_card_slider">
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}" alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_2.jpg') }}" alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">

                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.9 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">50 Tips For Designing an Exceptional
                                                Online Learning Progress.</a>
                                            <ul>
                                                <li>32 Lessons</li>
                                                <li>48 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hugh Millie-Yate</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                            <p>$239.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_3.jpg') }}" alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <!-- <a href="#" class="category">Marketing</a> -->
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Holistic Internet-Based Instruction
                                                Mastery Program.</a>
                                            <ul>
                                                <li>37 Lessons</li>
                                                <li>56 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Dominic L. Ement</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                            <p>$199.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="quality_course_slider_item" style="background: url(frontend/assets/images/quality_courses_bg.jpg);">
                <div class="col-12">
                    <div class="row align-items-center">
                        <div class="col-xxl-5 col-xl-4 col-md-6 col-lg-7 wow fadeInLeft">
                            <div class="wsus__quality_courses_text">
                                <div class="wsus__section_heading heading_left mb_30">
                                    <h5>100% QUALITY COURSES</h5>
                                    <h2>Find Your Match From The Spotlighted Collection</h2>
                                </div>
                                <p>Quisque vitae dignissim nunc, a molestie nisi. Orci varius natoque penatibus
                                    parturient
                                    nascetu
                                    mus.</p>
                                <a class="common_btn" href="#">all Featured Courses <i
                                        class="far fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 d-none d-xl-block wow fadeInUp">
                            <div class="wsus__quality_courses_img">
                                <img src="{{ asset('frontend/assets/images/quality_courses_img_2.png') }}" alt="Quality Courses"
                                    class="img-fluid w-100">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-4 col-md-6 col-lg-5 wow fadeInUp">
                            <div class="row quality_course_card_slider">
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_1.jpg') }}" alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 15 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Complete Blender Creator Learn 3D Modelling.</a>
                                            <ul>
                                                <li>24 Lessons</li>
                                                <li>38 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hermann P. Schnitzel</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                            <p><del>$254</del> $156.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_2.jpg') }}" alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 24 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">

                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.9 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">50 Tips For Designing an Exceptional
                                                Online Learning Progress.</a>
                                            <ul>
                                                <li>32 Lessons</li>
                                                <li>48 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Hugh Millie-Yate</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                            <p>$239.00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="wsus__single_courses_3">
                                        <div class="wsus__single_courses_3_img">
                                            <img src="{{ asset('frontend/assets/images/courses_3_img_3.jpg') }}" alt="Courses" class="img-fluid">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/love_icon_black.png') }}" alt="Love"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/compare_icon_black.png') }}" alt="Compare"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('frontend/assets/images/cart_icon_black_2.png') }}" alt="Cart"
                                                            class="img-fluid">
                                                    </a>
                                                </li>
                                            </ul>
                                            <span class="time"><i class="far fa-clock"></i> 17 Hours</span>
                                        </div>
                                        <div class="wsus__single_courses_text_3">
                                            <div class="rating_area">
                                                <p class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>(4.8 Rating)</span>
                                                </p>
                                            </div>

                                            <a class="title" href="#">Holistic Internet-Based Instruction
                                                Mastery Program.</a>
                                            <ul>
                                                <li>37 Lessons</li>
                                                <li>56 Student</li>
                                            </ul>
                                            <a class="author" href="#">
                                                <div class="img">
                                                    <img src="{{ asset('frontend/assets/images/author_img_2.jpg') }}" alt="Author" class="img-fluid">
                                                </div>
                                                <h4>Dominic L. Ement</h4>
                                            </a>
                                        </div>
                                        <div class="wsus__single_courses_3_footer">
                                            <a class="common_btn" href="#">Enroll <i class="far fa-arrow-right"></i></a>
                                            <p>$199.00</p>
                                        </div>
                                    </div>
                                </div>
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
                        <h2>Comments From Our Learners</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row testimonial_slider">
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                    <p class="description">Duis ullamcorper arcu egestas nisl luctus, sit amet lobortis lorem gravida
                        Phasellus u mauris sodales hendre phasellus interdum lacinia diam bibendum nisi elementum
                        urna.Morbi molestie purus egestas aliquam euismod utrum eget dapibus fames ac ante  orci ut
                        lectus.</p>
                    <div class="testimonial_logo">
                        <img src="{{ asset('frontend/assets/images/testimonial_logo.png') }}" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/testimonial_user_1.png') }}" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            Spruce Springclean
                            <span>Computer Engineer</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                    <p class="description">Duis ullamcorper arcu egestas nisl luctus, sit amet lobortis lorem gravida
                        Phasellus u mauris sodales hendre phasellus interdum lacinia diam bibendum nisi elementum
                        urna.Morbi molestie purus egestas aliquam euismod utrum eget dapibus fames ac ante  orci ut
                        lectus.</p>
                    <div class="testimonial_logo">
                        <img src="{{ asset('frontend/assets/images/testimonial_logo_2.png') }}" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/testimonial_user_2.png') }}" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            Ravi O'Leigh
                            <span>IT Director at Cognizant</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                    <p class="description">Duis ullamcorper arcu egestas nisl luctus, sit amet lobortis lorem gravida
                        Phasellus u mauris sodales hendre phasellus interdum lacinia diam bibendum nisi elementum
                        urna.Morbi molestie purus egestas aliquam euismod utrum eget dapibus fames ac ante  orci ut
                        lectus.</p>
                    <div class="testimonial_logo">
                        <img src="{{ asset('frontend/assets/images/testimonial_logo_3.png') }}" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/testimonial_user_3.png') }}" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            Hanson Deck
                            <span>UX Design Lead</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 wow fadeInUp">
                <div class="wsus__single_testimonial">
                    <p class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </p>
                    <p class="description">Duis ullamcorper arcu egestas nisl luctus, sit amet lobortis lorem gravida
                        Phasellus u mauris sodales hendre phasellus interdum lacinia diam bibendum nisi elementum
                        urna.Morbi molestie purus egestas aliquam euismod utrum eget dapibus fames ac ante  orci ut
                        lectus.</p>
                    <div class="testimonial_logo">
                        <img src="{{ asset('frontend/assets/images/testimonial_logo_2.png') }}" alt="Testimonial" class="img-fluid">
                    </div>
                    <div class="wsus__testimonial_footer">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/testimonial_user_2.png') }}" alt="user" class="img-fluid">
                        </div>
                        <h3>
                            Spruce Springclean
                            <span>Computer Engineer</span>
                        </h3>
                    </div>
                </div>
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
                        <img src="{{ asset('frontend/assets/images/blog_4_img_1.jpg') }}" alt="Blog" class="img-fluid">
                        <span class="date">March 23, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/user_icon_black.png') }}" alt="User" class="img-fluid"></span>
                                By Richard Tea
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}" alt="Comment" class="img-fluid"></span>
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
                        <img src="{{ asset('frontend/assets/images/blog_4_img_2.jpg') }}" alt="Blog" class="img-fluid">
                        <span class="date">April 28, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/user_icon_black.png') }}" alt="User" class="img-fluid"></span>
                                By Doug Lyphe
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}" alt="Comment" class="img-fluid"></span>
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
                        <img src="{{ asset('frontend/assets/images/blog_4_img_3.jpg') }}" alt="Blog" class="img-fluid">
                        <span class="date">Jan 12, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/user_icon_black.png') }}" alt="User" class="img-fluid"></span>
                                By Eleanor Fant
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}" alt="Comment" class="img-fluid"></span>
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
                        <img src="{{ asset('frontend/assets/images/blog_4_img_4.jpg') }}" alt="Blog" class="img-fluid">
                        <span class="date">April 28, 2024</span>
                    </a>
                    <div class="wsus__single_blog_4_text">
                        <ul>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/user_icon_black.png') }}" alt="User" class="img-fluid"></span>
                                By Doug Lyphe
                            </li>
                            <li>
                                <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png') }}" alt="Comment" class="img-fluid"></span>
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
