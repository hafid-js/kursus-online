@php
    $categories = \App\Models\CourseCategory::whereNull('parent_id')->where('status', 1)->get();
@endphp

<nav class="navbar navbar-expand-lg main_menu main_menu_3">
    <a class="navbar-brand" href="index_3.html">
        <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="EduCore" class="img-fluid">
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
                        <a href="javascript:;">
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
                <a class="nav-link active" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about.index') }}">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('courses.index') }}">Courses</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact.index') }}">Contact Us</a>
            </li>
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
                        <b>06</b>
                    </a>
                </li>

                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="common_btn">Log Out</button>
                        </form>
                    </li>
                @else
                    <li>
                        <a class="common_btn" href="{{ route('login') }}">Sign In</a>
                    </li>
                @endauth

            </ul>
        </div>

    </div>
</nav>
