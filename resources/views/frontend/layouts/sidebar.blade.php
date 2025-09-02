@php
    $user = auth()->user();
    $role = $user->role;
    $image = $user->image ? asset($user->image) : asset('frontend/assets/images/image-profile.png');
@endphp

<div class="col-xl-3 col-md-4 wow fadeInLeft">
    <div class="wsus__dashboard_sidebar">
        <div class="wsus__dashboard_sidebar_top">
            <div class="dashboard_banner">
                <img src="{{ asset('frontend/assets/images/single_topic_sidebar_banner.jpg') }}" alt="img" class="img-fluid">
            </div>
            <div class="img">
                <img src="{{ $image }}" alt="profile" class="img-fluid w-100">
            </div>
            <h4>{{ $user->name }}</h4>
            <p>{{ ucfirst($role) }}</p>
        </div>

        <ul class="wsus__dashboard_sidebar_menu">
            <li>
                <a href="{{ route("$role.dashboard") }}" class="{{ sidebarItemActive(["$role.dashboard"]) }}">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_8.png') }}" alt="icon" class="img-fluid w-100">
                    </div>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route("$role.profile.index") }}" class="{{ sidebarItemActive(["$role.profile.*"]) }}">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_1.png') }}" alt="icon" class="img-fluid w-100">
                    </div>
                    Profile
                </a>
            </li>

            @if($role === 'instructor' && isDocumentApproved($user))
                <li>
                    <a href="{{ route('instructor.courses.index') }}" class="{{ sidebarItemActive(['instructor.courses.index','instructor.courses.create','instructor.courses.edit','instructor.courses.review']) }}">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/dash_icon_3.png') }}" alt="icon" class="img-fluid w-100">
                        </div>
                        My Courses
                    </a>
                </li>
                            <li>
                <a href="{{ route("$role.review.index") }}" class="{{ sidebarItemActive(["$role.review.index"]) }}">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_4.png') }}" alt="icon" class="img-fluid w-100">
                    </div>
                    Review
                </a>
            </li>

                <li>
                    <a href="{{ route('instructor.course-sales.index') }}" class="{{ sidebarItemActive(['instructor.course-sales.index']) }}">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/dash_icon_5.png') }}" alt="icon" class="img-fluid w-100">
                        </div>
                        Course Sales
                    </a>
                </li>

                <li>
                    <a href="{{ route('instructor.courses.students') }}" class="{{ sidebarItemActive(['instructor.courses.students']) }}">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/dash_icon_6.png') }}" alt="icon" class="img-fluid w-100">
                        </div>
                        My Students
                    </a>
                </li>

                <li>
                    <a href="{{ route('instructor.withdraw.index') }}" class="{{ sidebarItemActive(['instructor.withdraw.index']) }}">
                        <div class="img">
                            <img src="{{ asset('frontend/assets/images/dash_icon_8.png') }}" alt="icon" class="img-fluid w-100">
                        </div>
                        Withdrawals
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route("$role.enrolled-courses.index") }}" class="{{ sidebarItemActive(["$role.enrolled-courses.index"]) }}">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_3.png') }}" alt="icon" class="img-fluid w-100">
                    </div>
                    Enrolled Courses
                </a>
            </li>

            {{-- <li>
                <a href="{{ route("$role.review.review") }}" class="{{ sidebarItemActive(["$role.review.review"]) }}">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_4.png') }}" alt="icon" class="img-fluid w-100">
                    </div>
                    My Reviews
                </a>
            </li> --}}

            <li>
                <a href="{{ route("$role.orders.index") }}" class="{{ sidebarItemActive(["$role.orders.index"]) }}">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_5.png') }}" alt="icon" class="img-fluid w-100">
                    </div>
                    My Orders
                </a>
            </li>

            <li>
                <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                    <div class="img">
                        <img src="{{ asset('frontend/assets/images/dash_icon_16.png') }}" alt="icon" class="img-fluid w-100">
                    </div>
                    Sign Out
                </a>
                <form method="POST" id="logout" action="{{ route('logout') }}">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
