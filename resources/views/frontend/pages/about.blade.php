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
                            <h1>How We Work</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>About Us</li>
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
        ABOUT 3 START
    ============================-->
   <section class="wsus__about_3 mt_120 xs_mt_100 ">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="wsus__about_3_img">

                        <img src="{{ asset($about?->image) }}" alt="About us" class="about_3_large img-fluid w-100">

                        <div class="text">
                            <h4> <span>{{ $about?->learner_count }}</span> {{ $about?->learner_test }}</h4>
                            <img src="{{ asset($about?->learner_image) }}" alt="Photo" class="img-fluid">
                        </div>

                        <div class="circle_box">
                            <svg viewBox="0 0 100 100">
                                <defs>
                                    <path id="circle2" d="
                            M 50, 50
                            m -37, 0
                            a 37,37 0 1,1 74,0
                            a 37,37 0 1,1 -74,0"></path>
                                </defs>
                                <text>
                                    <textPath xlink:href="#circle">
                                        {{ $about?->rounded_text }}
                                    </textPath>
                                </text>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <div class="wsus__about_3_text">
                        <div class="wsus__section_heading heading_left mb_15">
                            <h5>Learn More About Us</h5>
                            <h2>{{ $about?->title }}</h2>
                        </div>
{!! $about?->description !!}
                        @if($about?->button_text)
                        <a class="common_btn" href="{{ $about->button_url }}">{{ $about?->button_text }}</a>
                        @endif

                        @if($about?->video_url)
                        <div class="about_video">
                            <img src="{{ asset( $about->video_image) }}" alt="Video" class="img-fluid w-100">
                            <span>live</span>
                            <a class="play_btn venobox vbox-item" data-autoplay="true" data-vbtype="video"
                                href="$about->video_url">
                                <img src="{{ asset('frontend/assets/images/play_icon.png') }}" alt="Play" class="img-fluid">
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        ABOUT 3 END
    ============================-->


    <!--===========================
        CALL TO ACTION 4 START
    ============================-->
    <section class="wsus__call_to_action_4 pt_140 xs_pt_100">
        <ul class="d-flex flex-wrap wow fadeInUp">
            <li>
                <div class="img">
                    <img src="{{ asset('frontend/assets/images/call_to_action_4_img_1.jpg ') }}" alt="Photo" class="img-fluid w-100">
                </div>
                <div class="text">
                    <h4>Proficient Coach - Engage in Live Learning Experiences!</h4>
                    <a href="#" class="common_btn">Take Our Service</a>
                </div>
            </li>
            <li>
                <div class="img">
                    <img src="{{ asset('frontend/assets/images/call_to_action_4_img_2.jpg ') }}" alt="Photo" class="img-fluid w-100">
                </div>
                <div class="text">
                    <h4>Successfully Realize Your Goals with EduCore Education.</h4>
                    <a href="#" class="common_btn">Let’s Discover</a>
                </div>
            </li>
            <li>
                <div class="img">
                    <img src="{{ asset('frontend/assets/images/call_to_action_4_img_3.jpg ') }}" alt="Photo" class="img-fluid w-100">
                </div>
                <div class="text">
                    <h4>Take on the Role of an Educator & Start Generating Income.</h4>
                    <a href="#" class="common_btn">Join now</a>
                </div>
            </li>
        </ul>
    </section>
    <!--===========================
        CALL TO ACTION 4 END
    ============================-->


    <!--===========================
        FEATURES 3 START
    ============================-->
    <section class="wsus__features_3 wsus__features pt_120 xs_pt_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 m-auto wow fadeInUp">
                    <div class="wsus__section_heading mb_25">
                        <h5>High-Quality Courses</h5>
                        <h2>Remote Education Degrees To Online Classes.</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="wsus__features_item_3 orange">
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/features_3_icon_1.png ') }}" alt="Features" class="img-fluid">
                        </div>
                        <a href="#" class="title">E-Learning Degree Programs.</a>
                        <p>LMS platforms aim to be accessible to a diverse audience.</p>
                        <span>24 Course</span>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="wsus__features_item_3 blue">
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/features_3_icon_2.png ') }}" alt="Features" class="img-fluid">
                        </div>
                        <a href="#" class="title">Combined Online & On-Site Education.</a>
                        <p>LMS platforms aim to be accessible to a diverse audience.</p>
                        <span>57 Course</span>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="wsus__features_item_3 red">
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/features_3_icon_3.png ') }}" alt="Features" class="img-fluid">
                        </div>
                        <a href="#" class="title">Non-Campus Educational Offerings.</a>
                        <p>LMS platforms aim to be accessible to a diverse audience.</p>
                        <span>43 Course</span>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-4 wow fadeInUp">
                    <div class="wsus__features_item_3 pink">
                        <div class="icon">
                            <img src="{{ asset('frontend/assets/images/features_3_icon_4.png ') }}" alt="Features" class="img-fluid">
                        </div>
                        <a href="#" class="title">Micro-Credential Programs.</a>
                        <p>LMS platforms aim to be accessible to a diverse audience.</p>
                        <span>26 Course</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        FEATURES 3 END
    ============================-->


    <!--===========================
        COUNTER START
    ============================-->
    <section class="wsus__about_counter wsus__counter mt_120 xs_mt_100">
        <div class="container">
            <div class="wsus__counter_bg" style="background: url({{ asset('frontend/assets/images/counter_bg.jpg ') }});">
                <div class="row">
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="wsus__single_counter">
                            <h2><span class="counter">{{ $counter?->counter_one }}</span></h2>
                            <p>{{ $counter?->title_one }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="wsus__single_counter">
                            <h2><span class="counter">{{ $counter?->counter_two }}</span></h2>
                            <p>{{ $counter?->title_two }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="wsus__single_counter">
                            <h2><span class="counter">{{ $counter?->counter_three }}</span></h2>
                            <p>{{ $counter?->title_three }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp">
                        <div class="wsus__single_counter">
                            <h2><span class="counter">{{ $counter?->counter_four }}</span></h2>
                            <p>{{ $counter?->title_four }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================
        COUNTER END
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
                            @foreach ($testimonials as $testimonial)
            <div class="col-xl-4 wow fadeInUp">
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

            </div>
                     @endforeach
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

            @forelse ($blogs as $blog)
                        <div class="col-xl-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="wsus__single_blog_4">
                        <a href="{{ route('blog.show', $blog->slug) }}" class="wsus__single_blog_4_img">
                            <img src="{{ asset($blog->image) }}" alt="Blog" class="img-fluid">
                            <span class="date">{{ date('M d, Y', strtotime($blog->created_at)) }}</span>
                        </a>
                        <div class="wsus__single_blog_4_text">
                            <ul>
                                <li>
                                    <span><img src="{{ asset('frontend/assets/images/user_icon_black.png ') }}" alt="User" class="img-fluid"></span>
                                    By {{ $blog->author->name }}
                                </li>
                                <li>
                                    <span><img src="{{ asset('frontend/assets/images/comment_icon_black.png ') }}" alt="Comment" class="img-fluid"></span>
                                     {{ $blog->comments()->count() }} Comments
                                </li>
                            </ul>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="title">{{ $blog->title }}</a>
                            <p>{{ Str::limit(strip_tags($blog->description), 100) }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="common_btn">Read More <i class="far fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div>No Blog Found</div>
            @endforelse
        </div>
    </section>
    <!--===========================
        BLOG 4 END
    ============================-->

@endsection
