<!-- Sidebar -->
<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="{{ asset('admin/assets/img/logo.svg') }}" width="110" height="32" alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="./">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <i class="ti ti-home"></i> </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ sidebarItemActive(['admin.instructor-requests.*']) }}" href="{{ route('admin.instructor-requests.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                           <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-help-hexagon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" /><path d="M12 16v.01" /><path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Instructor Request
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown {{ sidebarItemActive(['admin.courses.index','admin.course-categories.index','admin.course-languages.index','admin.course-levels.index','admin.reviews.*']) }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                              <i class="ti ti-book"></i>
                        </span>
                        <span class="nav-link-title">
                            Course Management
                        </span>
                    </a>

                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.courses.*']) }}" href="{{ route('admin.courses.index') }}">
                                    Courses
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.course-categories.*']) }}" href="{{ route('admin.course-categories.index') }}">
                                    Course Categories
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.course-languages.*']) }}" href="{{ route('admin.course-languages.index') }}">
                                    Course Languages
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.course-levels.*']) }}" href="{{ route('admin.course-levels.index') }}">
                                    Course Levels
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.reviews.*']) }}" href="{{ route('admin.reviews.index') }}">
                                    Course Reviews
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ sidebarItemActive(['admin.certificate-builder.*']) }}" href="{{ route('admin.certificate-builder.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                            <i class="ti ti-certificate"></i>
                        </span>
                        <span class="nav-link-title">
                            Certificate Builder
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ sidebarItemActive(['admin.orders.*']) }}" href="{{ route('admin.orders.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg') }}" class="icon" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Orders
                        </span>
                    </a>
                </li>
                 <li class="nav-item dropdown {{ sidebarItemActive(['admin.blog-categories.index','admin.blogs.*']) }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                              <i class="ti ti-brand-blogger"></i>
                        </span>
                        <span class="nav-link-title">
                            Content Management
                        </span>
                    </a>

                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.blog-categories.*']) }}" href="{{ route('admin.blog-categories.index') }}">
                                    Blog Category
                                </a>
                            </div>
                        </div>
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.blogs.*']) }}" href="{{ route('admin.blogs.index') }}">
                                    Blogs
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ sidebarItemActive(['admin.payout-gateway.*']) }}" href="{{ route('admin.payout-gateway.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                              <i class="ti ti-cash"></i>
                        </span>
                        <span class="nav-link-title">
                            Payout Gateways
                        </span>
                    </a>
                </li>

                 <li class="nav-item dropdown {{ sidebarItemActive(['admin.feature.index','admin.hero.index','admin.about-section.index','admin.latest-courses-section.index','admin.become-instructor-section.index','admin.video-section.index','admin.brand-section.index','admin.featured-instructor-section.index','admin.testimonial-section.index','admin.counter-section.*']) }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                              <i class="ti ti-layout-grid"></i>
                        </span>
                        <span class="nav-link-title">
                            Sections
                        </span>
                    </a>

                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.hero.*']) }}" href="{{ route('admin.hero.index') }}">
                                    Hero
                                </a>
                            </div>
                                       <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.feature.*']) }}" href="{{ route('admin.feature.index') }}">
                                    Features
                                </a>

                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.about-section.*']) }}" href="{{ route('admin.about-section.index') }}">
                                    About Us
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.latest-courses-section.*']) }}" href="{{ route('admin.latest-courses-section.index') }}">
                                    Latest Courses
                                </a>
                            </div>

                             <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.become-instructor-section.*']) }}" href="{{ route('admin.become-instructor-section.index') }}">
                                    Become Instructor Banner
                                </a>
                            </div>

                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.video-section.*']) }}" href="{{ route('admin.video-section.index') }}">
                                    Video
                                </a>
                            </div>
                             <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.brand-section.*']) }}" href="{{ route('admin.brand-section.index') }}">
                                    Brand
                                </a>
                            </div>
                             <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.featured-instructor-section.*']) }}" href="{{ route('admin.featured-instructor-section.index') }}">
                                    Featured Instructor
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.testimonial-section.*']) }}" href="{{ route('admin.testimonial-section.index') }}">
                                    Testimonials
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.counter-section.*']) }}" href="{{ route('admin.counter-section.index') }}">
                                    Counter
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                  <li class="nav-item">
                    <a class="nav-link {{ sidebarItemActive(['admin.withdraw-request.*']) }}" href="{{ route('admin.withdraw-request.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                             <i class="ti ti-coins"></i>
                        </span>
                        <span class="nav-link-title">
                            Payout Requests
                        </span>
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ sidebarItemActive(['admin.custom-page.*']) }}" href="{{ route('admin.custom-page.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <i class="ti ti-app-window"></i>
                        </span>
                        <span class="nav-link-title">
                            Custom Pages
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ sidebarItemActive(['admin.payment-setting.*']) }}" href="{{ route('admin.payment-setting.index') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                             <i class="ti ti-adjustments"></i>
                        </span>
                        <span class="nav-link-title">
                            Payment Settings
                        </span>
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ sidebarItemActive(['admin.settings.*']) }}" href="{{ route('admin.settings.index') }}" >
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                             <i class="ti ti-settings"></i>
                        </span>
                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                </li>

                <li class="nav-item dropdown {{ sidebarItemActive(['admin.contact.index','admin.contact-setting.*']) }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                             <i class="ti ti-address-book"></i>
                        </span>
                        <span class="nav-link-title">
                            Contact
                        </span>
                    </a>

                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.contact.*']) }}" href="{{ route('admin.contact.index') }}">
                                    Contact Cards
                                </a>
                            </div>
                             <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.contact-setting.*']) }}" href="{{ route('admin.contact-setting.index') }}">
                                    Contact Setting
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown {{ sidebarItemActive(['admin.top-bar.index','admin.footer.index','admin.footer-column-one.index','admin.footer-column-two.index','admin.social-links.*']) }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                          <i class="ti ti-layout-navbar"></i>
                        </span>
                        <span class="nav-link-title">
                            Header / Footer
                        </span>
                    </a>

                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.top-bar.*']) }}" href="{{ route('admin.top-bar.index') }}">
                                    Top Bar
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.footer.*']) }}" href="{{ route('admin.footer.index') }}">
                                    Footer
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.footer-column-one.*']) }}" href="{{ route('admin.footer-column-one.index') }}">
                                    Footer Column One
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.footer-column-two.*']) }}" href="{{ route('admin.footer-column-two.index') }}">
                                    Footer Column Two
                                </a>
                            </div>
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ sidebarItemActive(['admin.social-links.*']) }}" href="{{ route('admin.social-links.index') }}">
                                    Social Links
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>
