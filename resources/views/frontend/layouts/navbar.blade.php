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
                <li>
                    <a href="#">
                        <span>
                            <img src="{{ asset('frontend/assets/images/menu_category_icon_1.png') }}" alt="Category"
                                class="img-fluid">
                        </span>
                        Development
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="{{ asset('frontend/assets/images/menu_category_icon_2.png') }}" alt="Category"
                                class="img-fluid">
                        </span>
                        Business
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="{{ asset('frontend/assets/images/menu_category_icon_3.png') }}" alt="Category"
                                class="img-fluid">
                        </span>
                        Marketing
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="{{ asset('frontend/assets/images/menu_category_icon_4.png') }}" alt="Category"
                                class="img-fluid">
                        </span>
                        Lifestyle
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="{{ asset('frontend/assets/images/menu_category_icon_5.png') }}" alt="Category"
                                class="img-fluid">
                        </span>
                        Health & Fitness
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="{{ asset('frontend/assets/images/menu_category_icon_6.png') }}" alt="Category"
                                class="img-fluid">
                        </span>
                        Design
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span>
                            <img src="{{ asset('frontend/assets/images/menu_category_icon_7.png') }}" alt="Category"
                                class="img-fluid">
                        </span>
                        Academics
                    </a>
                    <ul class="category_sub_menu">
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">UI/UX Design</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('courses.index') }}">Courses</i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">contact us</a>
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
                <li>
                    <a class="admin" href="#">
                        <span>
                            <img src="{{ asset('frontend/assets/images/user_icon_black.png') }}" alt="user"
                                class="img-fluid">
                        </span>
                        admin
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
