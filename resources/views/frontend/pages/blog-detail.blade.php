@extends('frontend.layouts.layout')
@push('meta')
    <meta property="og:title" content="{{ $blog->seo_title }}">
    <meta property="og:description" content="{{ $blog->seo_description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset($blog->image) }}">
    <meta property="og:type" content="Blog">
@endpush
@section('content')

<section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="wsus__breadcrumb_text">
                            <h1>Blog details</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Blog details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__blog_details mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                    <div class="wsus__blog_details_area">
                        <div class="wsus__blog_details_thumb">
                            <img src="{{ asset($blog->image) }}" alt="Blog" class="img-fluid w-100">
                        </div>
                        <div class="wsus__blog_details_header">
                            <ul class="d-flex flex-wrap">
                                <li>
                                    <span class="author">
                                        <img src="{{ $blog->author->image ? asset($blog->author->image) : asset('default-files/avatar.png') }}" alt="user" class="img-fluid">
                                    </span>
                                    By {{ $blog->author->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/calendar_gray.png') }}" alt="calendar" class="img-fluid">
                                    </span>
                                    {{ date('M d, Y', strtotime($blog->created_at)) }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/bookmark_icon.png') }}" alt="bookmark" class="img-fluid">
                                    </span>
                                    {{ $blog->category->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/comment_icon_gray.png') }}" alt="bookmark" class="img-fluid">
                                    </span>
                                    {{ $blog->comments->count() }} Comments
                                </li>
                            </ul>
                            <h2>{{ $blog->title }}</h2>
                        </div>
                        <div class="wsus__blog_details_text">
                            <p>{!! $blog->description !!}</p>
                        </div>
                        <div class="wsus__blog_det_tags_share d-flex flex-wrap mt_50">
                            <ul class="tags d-flex flex-wrap align-items-center">
                                <li><span>Tags:</span></li>
                                <li><a href="#">Course</a></li>
                                <li><a href="#">Education</a></li>
                                <li><a href="#">Learn</a></li>
                                <li><a href="#">Online</a></li>
                            </ul>
                            <ul class="share d-flex flex-wrap align-items-center">
                                <li><span>share:</span></li>
                                   <li class="ez-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="ez-linkedin"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li class="ez-x"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="ez-reddit"><a href="#"><i class="fab fa-reddit"></i></a></li>
                            </ul>
                        </div>
                        <div class="wsus__blog_det_author">
                            <div class="img">
                                <img src="{{ $blog->author->image ? asset($blog->author->image) : asset('default-files/avatar.png') }}" alt="Author" class="img-fluid">
                            </div>
                            <div class="text">
                                <h3>{{ $blog->author->name }}</h3>
                                <h5>Digital Marketing</h5>
                                <p>Sed mi leo, accumsan vel ante at, viverra placerat nulla. Donec pharetra rutrum sed
                                    allium lectus fermentum enim Nam maximus.</p>
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="wsus__blog_comment_area mt_75">
                            <h2>Comments</h2>
                            @foreach ($blog->comments ?? [] as $comment)
                            <div class="wsus__blog_single_comment">
                                <div class="img">
                                    <img src="{{ asset($comment->user->image ? asset($comment->user->image) : asset('default-files/avatar.png')) }}" alt="Comments" class="img-fluid">
                                </div>
                                <div class="text">
                                    <h4>{{ $comment->user->name }}</h4>
                                    <h6>{{ date('M d, Y', strtotime($comment->created_at)) }} <a href="#"><i class="fas fa-reply" aria-hidden="true"></i></a></h6>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            </div>
                            <div class="wsus__blog_single_comment single_comment_reply">
                                <div class="img">
                                    <img src="images/testimonial_user_2.png" alt="Comments" class="img-fluid">
                                </div>
                                <div class="text">
                                    <h4>Doug Lyphe</h4>
                                    <h6>June 25, 2024 at 08:45 pm <a href="#"><i class="fas fa-reply" aria-hidden="true"></i></a></h6>
                                    <p>Nulla a ipsum nibh. Fusce purus elit, tristique vitae enim sed, auctor placerat
                                        est. Maecenas consequat nibh consequat malesuada fringilla, mauris lorem dapibus
                                        metus, non imperdiet nunc erat ultricies est. Praesent ames nec lorem sit amet
                                        leo consequat rutrum non nibh sem eget metus.</p>
                                </div>
                            </div>
                              @endforeach
                        </div>
                        @auth
                        <div class="wsus__blog_comment_input_area mt_75">
                            <h2>Post a Comment</h2>
                            <p>Please add you comment here</p>
                            <form action="{{ route('blog.comment.store', $blog->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-12">
                                        <textarea rows="5" placeholder="Leave a comment" name="comment"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="common_btn">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="alert alert-info text-center">You need to login to comment</div>
                          @endauth
                    </div>
                </div>
                <div class="col-lg-4 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__blog_sidebar wsus__sidebar">
                        <form action="{{ route('blog.index') }}" class="wsus__sidebar_search" method="GET">
                            <input type="text" name="search" placeholder="Search Here...">
                            <button type="submit">
                                <img src="{{ asset('frontend/assets/images/search_icon.png') }}" alt="Search" class="img-fluid">
                            </button>
                        </form>
                        <div class="wsus__sidebar_recent_post">
                            <h3>Recent Posts</h3>
                            <ul class="d-flex flex-wrap">
                                @foreach ($recentBlogs as $blog)
                                <li>
                                    <a href="#" class="img">
                                        <img src="{{ asset($blog->image) }}" alt="Blog" class="img-fluid">
                                    </a>
                                    <div class="text">
                                        <p>
                                            <span>
                                                <img src="{{ asset('frontend/assets/images/calendar_blue.png') }}" alt="Clander" class="img-fluid">
                                            </span>
                                            {{ date('M d, Y', strtotime($blog->created_at)) }}
                                        </p>
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="title">{{ $blog->title}}</a>
                                    </div>
                                </li>
                                  @endforeach
                            </ul>
                        </div>
                        <div class="wsus__sidebar_blog_category">
                            <h3>Categories</h3>
                            <ul>
                                @foreach ($blogCategories as $category)
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}">{{ $category->name }} <span>({{ $category->blogs()->count() }})</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/shakilahmed0369/ez-share/dist/ez-share.min.js"></script>

    <script>
        $(function() {
            $('#starRating li').on('click', function() {
                var $starRating = $('#starRating').find('.active').length;

                $('#rating').val($starRating);
            })
        })
    </script>
@endpush
