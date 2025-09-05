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
                                        <img src="{{ $blog->author->image ? asset($blog->author->image) : asset('default-files/image-profile.png') }}"
                                            alt="user" class="img-fluid">
                                    </span>
                                    By {{ $blog->author->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/calendar_gray.png') }}" alt="calendar"
                                            class="img-fluid">
                                    </span>
                                    {{ date('M d, Y', strtotime($blog->created_at)) }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/bookmark_icon.png') }}" alt="bookmark"
                                            class="img-fluid">
                                    </span>
                                    {{ $blog->category->name }}
                                </li>
                                <li>
                                    <span>
                                        <img src="{{ asset('frontend/assets/images/comment_icon_gray.png') }}"
                                            alt="bookmark" class="img-fluid">
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
                                <img src="{{ $blog->author->image ? asset($blog->author->image) : asset('default-files/image-profile.png') }}"
                                    alt="Author" class="img-fluid">
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
                                <div class="wsus__blog_single_comment" data-comment-id="{{ $comment->id }}">
                                    <div class="img">
                                        <img src="{{ $comment->user->image ? asset($comment->user->image) : asset('default-files/image-profile.png') }}"
                                            alt="Comments" class="img-fluid">
                                    </div>
                                    <div class="text">
                                        <h4>{{ $comment->user->name }}</h4>
                                        <h6>{{ date('M d, Y', strtotime($comment->created_at)) }}
                                            <div class="d-flex gap-2 align-items-center mt-2">
                                                @auth
                                                    @if (auth()->id() === $comment->user_id)
                                                        <a href="#" class="btn btn-sm text-danger delete-comment"
                                                            data-id="{{ $comment->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @endif
                                                @endauth

                                                <a href="#" class="review_reply" data-id="{{ $comment->id }}">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                            </div>
                                        </h6>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                                @if ($comment->children->count())
                                    <div class="replies ms-4 " id="comment-replies-{{ $comment->id }}">
                                        @foreach ($comment->children as $reply)
                                            <div class="wsus__blog_single_comment single_comment_reply"
                                                data-comment-id="{{ $reply->id }}">
                                                <div class="img">
                                                    <img src="{{ $reply->user->image ? asset($reply->user->image) : asset('default-files/image-profile.png') }}"
                                                        alt="Comments" class="img-fluid">
                                                </div>
                                                <div class="text">
                                                    <h4>{{ $reply->user->name }}</h4>
                                                    <h6>{{ date('M d, Y', strtotime($reply->created_at)) }}


                                                        @auth
                                                            @if (auth()->id() === $reply->user_id)
                                                                <a href="#"
                                                                    class="btn btn-sm text-danger delete-comment"
                                                                    data-id="{{ $reply->id }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            @endif
                                                        @endauth
                                                    </h6>
                                                    <p>{{ $reply->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @auth
                                    <div class="single_comment_reply">
                                        <form class="reply-form d-none mt-3" data-parent-id="{{ $comment->id }}">
                                            @csrf
                                            <textarea name="comment" rows="5" placeholder="Write your reply..."></textarea>
                                            <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                                        </form>
                                    </div>
                                @endauth
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
                                            <textarea rows="5" placeholder="Leave a comment" name="comment" required></textarea>
                                        </div>
                                        <x-input-error :messages="$errors->get('comment')" class="mt-2 mb-2" />
                                        <div class="col-12">
                                            <button type="submit" class="btn btnPrimary">
                                                <i class="fas fa-paper-plane me-1"></i> Submit</button>
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
                                <img src="{{ asset('frontend/assets/images/search_icon.png') }}" alt="Search"
                                    class="img-fluid">
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
                                                    <img src="{{ asset('frontend/assets/images/calendar_blue.png') }}"
                                                        alt="Clander" class="img-fluid">
                                                </span>
                                                {{ date('M d, Y', strtotime($blog->created_at)) }}
                                            </p>
                                            <a href="{{ route('blog.show', $blog->slug) }}"
                                                class="title">{{ $blog->title }}</a>
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
                                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}">{{ $category->name }}
                                            <span>({{ $category->blogs()->count() }})</span></a>
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
    <script>
        $(document).ready(function() {

            $(document).on('click', '.review_reply', function(e) {
                e.preventDefault();
                const parentId = $(this).data('id');
                const form = $(`.reply-form[data-parent-id="${parentId}"]`);

                $('.reply-form').not(form).addClass('d-none');
                form.toggleClass('d-none');

                if (!form.hasClass('d-none')) {
                    form.find('textarea').focus();
                }
            });

            $(document).on('submit', '.reply-form', function(e) {
                e.preventDefault();

                const form = $(this);
                const comment = form.find('textarea[name="comment"]').val();
                const parentId = form.data('parent-id');
                const blogId = `{{ $blog->id }}`;

                if (comment.trim() === '') {
                    alert('Comment cannot be empty!');
                    return;
                }

                $.ajax({
                    url: `/blog/comment/${blogId}`,
                    method: 'POST',
                    data: {
                        comment: comment,
                        parent_id: parentId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let deleteButton = '';
                        if ({{ auth()->id() }} === response.data.user_id) {
                            deleteButton = `
                <a href="#" class="btn btn-sm text-danger delete-comment" data-id="${response.data.id}">
                    <i class="fas fa-trash"></i>
                </a>`;
                        }

                        const replyHtml = `
                        <div class="wsus__blog_single_comment single_comment_reply mt-3" data-comment-id="${response.data.id}">
                            <div class="img">
                                <img src="${response.data.user_image}" alt="Comments" class="img-fluid">
                            </div>
                            <div class="text">
                                <h4>${response.data.user_name}</h4>
                                <h6>${response.data.date} <span class="d-inline-flex gap-2 ms-2 align-items-center">
                    ${deleteButton}
                </span></h6>
                                <p>${response.data.comment}</p>
                            </div>
                        </div>
                    `;

                        const container = $(`#comment-replies-${response.data.parent_id}`);
                        if (container.length) {
                            container.append(replyHtml);
                        } else {
                            $(`div[data-comment-id="${response.data.parent_id}"]`).after(`
                            <div class="replies ms-4" id="comment-replies-${response.data.parent_id}">
                                ${replyHtml}
                            </div>
                        `);
                        }

                        form[0].reset();
                        form.addClass('d-none');
                        notyf.success('Reply added successfully');
                    },

                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            alert(xhr.responseJSON.message);
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });

            const notyf = new Notyf();

            $(document).on('click', '.delete-comment', function(e) {
                e.preventDefault();

                if (!confirm('Are you sure you want to delete this comment?')) return;

                const button = $(this);
                const commentId = button.data('id');

                $.ajax({
                    url: `/blog/comment/${commentId}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $(`[data-comment-id="${commentId}"]`).remove();
                        $(`#comment-replies-${commentId}`)
                            .remove();

                        notyf.success(response.message || 'Comment deleted successfully');
                    },
                    error: function(xhr) {
                        notyf.error('Failed to delete comment');
                    }
                });
            });

        });
    </script>
@endpush
