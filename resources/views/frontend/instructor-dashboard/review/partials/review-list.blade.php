<div class="wsus__course_single_reviews">
    <div class="wsus__single_review_box d-flex align-items-start">
        <div class="wsus__single_review_img me-3">
            <img src="{{ $image }}" alt="user" class="img-fluid rounded-circle"
                style="width: 50px; height: 50px; object-fit: cover;">
        </div>

        <div class="wsus__single_review_text w-100">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-1">
                <h4 class="mb-0">{{ $review->user->name }}</h4>
                @if ($review->course)
                    <span class="badge bg-light text-dark fw-normal" style="font-size: 0.9rem;">
                        Course: {{ $review->course->title }}
                    </span>
                @endif
            </div>

            @php
                $rating = $review->rating ?? 0;
                $maxStars = 5;
                $ratingText = number_format($rating, 1);
            @endphp
            <div class="rating_area">
                <p class="rating mb-1">
                    @for ($i = 1; $i <= $maxStars; $i++)
                        @if ($i <= floor($rating))
                            <i class="fas fa-star text-warning"></i>
                        @elseif ($i == ceil($rating) && $rating != floor($rating))
                            <i class="fas fa-star text-warning"></i>
                        @else
                            <i class="far fa-star text-warning"></i>
                        @endif
                    @endfor
                    <span>({{ $ratingText }} Rating)</span>
                </p>
            </div>

            <h6 class="text-muted mb-2">{{ format_to_date($review->created_at) }}</h6>
            <p>{{ $review->review }}</p>

            @if ($review->replies->isEmpty())
                <a href="#" class="dash_review_reply" data-id="{{ $review->id }}">Reply</a>
            @endif

            @if ($review->replies && $review->replies->isNotEmpty())
                <div class="review_replies mt-4 ps-4 border-start">
                    @foreach ($review->replies as $reply)
                        <div class="wsus__single_review_box d-flex align-items-start mb-3">
                            <div class="wsus__single_review_img me-3">
                                <img src="{{ asset($reply->user->image ?? 'frontend/assets/images/image-profile.png') }}"
                                    alt="user" class="img-fluid rounded-circle"
                                    style="width: 45px; height: 45px; object-fit: cover;">
                            </div>

                            <div class="wsus__single_review_text w-100">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-1">
                                    <h4 class="mb-0">{{ $reply->user->name }}</h4>
                                </div>
                                <h6 class="text-muted mb-2">{{ format_to_date($reply->created_at) }}</h6>
                                <p class="mb-0">{{ $reply->reply }}</p>

                                <a href="#" class="dash_review_reply mt-2 d-inline-block"
                                    data-reply-id="{{ $reply->id }}" data-reply-text="{{ e($reply->reply) }}">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
