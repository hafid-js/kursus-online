@extends('frontend.layouts.layout')

@section('content')
    <section class="wsus__breadcrumb" style="background: url('frontend/assets/images/breadcrumb_bg.jpg');">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Our Courses</h1>
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>Our Courses</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsus__courses mt_120 xs_mt_100 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filter -->
                <div class="col-xl-3 col-lg-4 col-md-8 order-2 order-lg-1 wow fadeInLeft">
                    <div class="wsus__sidebar">
                        <form id="course-filter-form" method="GET" action="{{ route('courses.index') }}">
                            <div class="wsus__sidebar_search">
                                <input type="text" placeholder="Search Course" name="search"
                                    value="{{ request()->search ?? '' }}">
                                <button type="submit">
                                    <img src="{{ asset('frontend/assets/images/search_icon.png') }}" alt="Search"
                                        class="img-fluid">
                                </button>
                            </div>

                            <div class="wsus__sidebar_category">
                                <h3>Categories</h3>
                                <ul class="categoty_list">
                                    @foreach ($categories as $category)
    <li>
        {{ $category->name }}
        <div class="wsus__sidebar_sub_category">
            @foreach ($category->subCategories as $subCategory)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="category[]"
                        value="{{ $subCategory->id }}"
                        id="category-{{ $subCategory->id }}"
                        @checked(in_array($subCategory->id, $activeSubcategoryIds ?? []))>
                    <label class="form-check-label" for="category-{{ $subCategory->id }}">
                        {{ $subCategory->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </li>
@endforeach

                                </ul>
                            </div>

                            <div class="wsus__sidebar_course_lavel">
                                <h3>Difficulty Level</h3>
                                @foreach ($levels as $level)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $level->id }}"
                                            name="level[]" id="level-{{ $level->id }}" @checked(in_array($level->id, request()->level ?? []))>
                                        <label class="form-check-label" for="level-{{ $level->id }}">
                                            {{ $level->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="wsus__sidebar_course_lavel rating">
                                <h3>Rating</h3>
                                @foreach ([5, 4, 3, 2, 1] as $star)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="rating[]"
                                            value="{{ $star }}" id="rating-{{ $star }}"
                                            @checked(in_array($star, request()->rating ?? []))>
                                        <label class="form-check-label" for="rating-{{ $star }}">
                                            @for ($i = 1; $i <= $star; $i++)
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                            @endfor
                                            {{ $star }} star{{ $star > 1 ? 's' : '' }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="wsus__sidebar_course_lavel duration">
                                <h3>Language</h3>
                                @foreach ($languages as $language)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $language->id }}"
                                            id="language-{{ $language->id }}" name="language[]"
                                            @checked(in_array($language->id, request()->language ?? []))>
                                        <label class="form-check-label" for="language-{{ $language->id }}">
                                            {{ $language->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="wsus__sidebar_rating">
                                <h3>Price Range</h3>
                                <div class="range_slider">
                                    <!-- Price slider here (jika ada plugin atau custom) -->
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Courses List -->
                <div class="col-xl-9 col-lg-8 order-lg-1">
                    <div class="wsus__page_courses_header wow fadeInUp">
                        <p>Showing <span>1-{{ $courses->count() }}</span> Of <span>{{ $courses->total() }}</span> Results
                        </p>

                        <form action="{{ route('courses.index') }}" method="GET">
                            <input type="hidden" name="search" value="{{ request()->search }}">
                            @foreach (['category', 'level', 'rating', 'language'] as $filter)
                                @if (request()->has($filter))
                                    @foreach ((array) request()->input($filter) as $value)
                                        <input type="hidden" name="{{ $filter }}[]" value="{{ $value }}">
                                    @endforeach
                                @endif
                            @endforeach

                            <p>Sort-by:</p>
                            <select class="select_js" name="order" onchange="this.form.submit()">
                                <option value="desc" @selected(request()->order == 'desc')>New to Old</option>
                                <option value="asc" @selected(request()->order == 'asc')>Old to New</option>
                            </select>
                        </form>
                    </div>

                    <div id="course-results">
                        @include('frontend.pages.partials.course-list', ['courses' => $courses])
                    </div>

                    <div class="wsus__pagination mt_50 wow fadeInUp">
                        {{ $courses->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.wsus__sidebar_sub_category input[type="checkbox"]').forEach(function (checkbox) {
            checkbox.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });
    });
</script>
@endpush
