<div class="wsus__course_single_reviews">
    <div class="wsus__single_review_box d-flex align-items-start">
        <div class="wsus__single_review_img me-3">
            <img src="{{ $review->user->image ?? asset('images/default-user.png') }}" alt="user" class="img-fluid" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
        </div>
        <div class="wsus__single_review_text">
            <h4>{{ $review->user->name }}</h4>
            <h6>{{ format_to_date($review->created_at) }}</h6>
            <p>{{ $review->review }}</p>
            <a href="#" class="dash_review_reply">Reply</a>
        </div>
    </div>
</div>
