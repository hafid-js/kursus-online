<!--============================
        MOBILE MENU START
    ==============================-->

@php
    $categories = \App\Models\CourseCategory::whereNull('parent_id')->where('status', 1)->get();
    $customPages = \App\Models\CustomPage::where('status', 1)->where('show_at_nav', 1)->get();
@endphp
<div class="mobile_menu_area">
    <div class="mobile_menu_area_top">
        <a class="mobile_menu_logo" href="{{ url('/') }}">
            <img src="{{ asset(config('settings.site_logo')) }}" alt="{{ config('settings.site_title') }}">
        </a>
        <div class="mobile_menu_icon d-block d-lg-none" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
            <span class="mobile_menu_icon"><i class="far fa-stream menu_icon_bar"></i></span>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fal fa-times"></i></button>
        <div class="offcanvas-body">

            <ul class="mobile_menu_header d-flex flex-wrap">
                <li><a href="cart_view.html"><i class="far fa-shopping-basket"></i> <span class="cart_count">{{ cartCount() }}</span></a>
                </li>
                <li><a href="{{ url('/login') }}"><i class="far fa-user"></i></a></li>
            </ul>

            <form class="mobile_menu_search">
                <input type="text" placeholder="Search">
                <button type="submit"><i class="far fa-search"></i></button>
            </form>

            <div class="mobile_menu_item_area">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">menu</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Categories</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <ul class="main_mobile_menu">
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
                                <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.index') }}">Contact Us</a>
                            </li>
                            @foreach ($customPages as $page)
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('custom-page', $page->slug) }}">{{ $page->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">

                        <ul class="main_mobile_menu">
                            @foreach ($categories as $category)
                                <li class="mobile_dropdown">
                                    <a href="#">
                                        <span>
                                            <img src="{{ asset($category->image) }}" alt="Category" class="img-fluid">
                                        </span>
                                        {{ $category->name }}
                                    </a>
                                    <ul class="inner_menu">
                                        @foreach ($category->subCategories as $subCategory)
                                            <li><a
                                                    href="{{ route('courses.index', ['category' => $subCategory->id]) }}">{{ $subCategory->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============================
        MOBILE MENU END
    ==============================-->
