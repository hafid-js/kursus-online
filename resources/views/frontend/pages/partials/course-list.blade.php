<div class="row">
    @forelse ($courses as $course)
        <div class="col-xl-4 col-md-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <div class="wsus__single_courses_3">
                <div class="wsus__single_courses_3_img">
                    <img src="{{ asset($course->thumbnail) }}" alt="Courses" class="img-fluid">
                    <ul>
                        <li>
                            <a href="">
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
                    <span class="time"><i class="far fa-clock" aria-hidden="true"></i>
                        {{ convertMinutesToHours($course->duration) }}</span>
                </div>
                <div class="wsus__single_courses_text_3">
                    <div class="rating_area">
                        <!-- <a href="#" class="category">Design</a> -->
                        <p class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $course->reviews()->avg('rating'))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                            <span>({{ number_format($course->reviews()->avg('rating'), 1) ?? 0 }}
                                Rating)</span>
                        </p>
                    </div>

                    <a class="title" href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                    <ul>
                        <li>{{ $course->lessons()->count() }} Lessons</li>
                        <li>{{ $course->enrollments->count() }} Student</li>
                    </ul>
                    <a class="author" href="#">
                        <div class="img">
                            <img src="{{ $course->instructor->image ? asset($course->instructor->image) : asset('frontend/assets/images/image-profile.png') }}"
                                alt="Author" class="img-fluid">
                        </div>
                        <h4>{{ $course->instructor->name }}</h4>
                    </a>
                </div>
                <div class="wsus__single_courses_3_footer">
                    @php
                        $isMyCourse = auth()->check() && $course->instructor_id == auth()->id();
                    @endphp
                    @php
                        $user = auth()->user();
                        $isMyCourse = auth()->check() && $course->instructor_id == auth()->id();

                        $hasPurchased = false;

                        if (auth()->check() && !$isMyCourse) {
                            $hasPurchased = \App\Models\OrderItem::whereHas('order', function ($query) use ($user) {
                                $query->where('buyer_id', $user->id)->where('status', 'approved');
                            })
                                ->where('course_id', $course->id)
                                ->exists();
                        }
                    @endphp

                    @if ($hasPurchased)
                        <a class="btn btn-primary" href="{{ route('student.course-player.index', $course->slug) }}">
                            <i class="fas fa-eye"></i> Watch Course
                        </a>
                    @elseif (!$isMyCourse)
                        <a class="common_btn add_to_cart" href="#" data-course-id="{{ $course->id }}">
                            Add to Cart <i class="far fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        <p>
                            @if ($course->discount > 0)
                                <del>${{ $course->price }}</del>${{ $course->discount }}
                            @else
                                ${{ $course->price }}
                            @endif
                        </p>
                    @endif

                </div>
            </div>
        </div>
    @empty
        <p>No Data Found</p>
    @endforelse
</div>
