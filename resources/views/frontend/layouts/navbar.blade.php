@php
    $categories = \App\Models\CourseCategory::whereNull('parent_id')->where('status', 1)->get();
    $customPages = \App\Models\CustomPage::where('status', 1)->where('show_at_nav', 1)->get();
@endphp

<nav class="navbar navbar-expand-lg main_menu main_menu_3">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset(config('settings.site_logo')) }}" alt="EduCore" class="img-fluid">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="menu_category">
            <div class="icon">
                <img src="{{ asset('frontend/assets/images/grid_icon.png') }}" alt="Category" class="img-fluid">
            </div>
            Category
            <ul>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('courses.index', ['main_category' => $category->slug]) }}">
                            <span>
                                <img src="{{ asset($category->image) }}" alt="Category" class="img-fluid">
                            </span>
                            {{ $category->name }}
                        </a>
                        @if ($category->subCategories->count() > 0)
                            <ul class="category_sub_menu">
                                @foreach ($category->subCategories as $subCategory)
                                    <li><a
                                            href="{{ route('courses.index', ['category' => $subCategory->id]) }}">{{ $subCategory->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link {{ navbarItemIndexActive('/') }}" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ navbarItemActive('about.index') }}" href="{{ route('about.index') }}">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ navbarItemActive('courses.index') }}" href="{{ route('courses.index') }}">Courses</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ navbarItemActive('blog.index') }}" href="{{ route('blog.index') }}">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ navbarItemActive('contact.index') }}" href="{{ route('contact.index') }}">Contact Us</a>
            </li>
            @foreach ($customPages as $page)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('custom-page', $page->slug) }}">{{ $page->title }}</a>
                </li>
            @endforeach
        </ul>

        <div class="right_menu">
            <div class="menu_search_btn">
                <img src="{{ asset('frontend/assets/images/search_icon.png') }}" alt="Search" class="img-fluid">
            </div>
            <ul>
                <li>
                    <a class="menu_signin" href="{{ route('cart.index') }}">
                        <span>
                            <img src="{{ asset('frontend/assets/images/cart_icon_black.png') }}" alt="user"
                                class="img-fluid">
                        </span>
                        <b class="cart_count">{{ cartCount() }}</b>
                    </a>
                </li>

                <li>
                    @if (!auth()->guard('web')->check())
                        <a class="common_btn" href="{{ route('login') }}">Sign In</a>
                    @endif
                    @if (user()?->role == 'student')
                        <a class="common_btn" href="{{ route('student.dashboard') }}">Dashboard</a>
                    @endif
                    @if (user()?->role == 'instructor')
                        <a class="common_btn" href="{{ route('instructor.dashboard') }}">Dashboard</a>
                    @endif
                    @auth
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="common_btn">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </li>

            </ul>
        </div>

    </div>
</nav>
