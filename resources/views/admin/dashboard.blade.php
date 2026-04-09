@extends('admin.layouts.layout')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            Overview
                        </div>
                        <h2 class="page-title">
                            Dashboard
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="container-xl">
            <div class="page-body">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar">
                                                    <i class="ti ti-currency-dollar"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>{{ config('settings.currency_icon') }} {{ $todaysOrder }}</b>
                                                </div>
                                                <div class="text-secondary">Today's Earnings</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- This Week Orders -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-info text-white avatar">
                                                    <i class="ti ti-shopping-cart"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>{{ config('settings.currency_icon') }} {{ $thisWeekOrders }}</b>
                                                </div>
                                                <div class="text-secondary">This Week Orders</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- This Month Orders -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-warning text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <rect x="4" y="5" width="16" height="16" rx="2" />
                                                        <line x1="16" y1="3" x2="16" y2="7" />
                                                        <line x1="8" y1="3" x2="8" y2="7" />
                                                        <line x1="4" y1="11" x2="20" y2="11" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>{{ config('settings.currency_icon') }} {{ $thisMonthOrders }}</b>
                                                </div>
                                                <div class="text-secondary">This Month Orders</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- This Year Orders -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- This Year Orders -->
                                                <span class="bg-success text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                                        <line x1="3" y1="12" x2="21" y2="12" />
                                                        <line x1="12" y1="4" x2="12" y2="22" />
                                                    </svg>
                                                </span>

                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>{{ config('settings.currency_icon') }} {{ $thisYearOrders }}</b>
                                                </div>
                                                <div class="text-secondary">This Year Orders</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Courses -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-warning text-white avatar">
                                                    <i class="ti ti-clock"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>{{ $pendingCourses }}</b>
                                                </div>
                                                <div class="text-secondary">Pending Courses</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rejected Courses -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-danger text-white avatar">
                                                    <i class="ti ti-x"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>{{ $rejectedCourses }}</b>
                                                </div>
                                                <div class="text-secondary">Rejected Courses</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Courses -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar">
                                                    <i class="ti ti-book"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>{{ $totalCourses }}</b>
                                                </div>
                                                <div class="text-secondary">Total Courses</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Orders Statistics -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-info text-white avatar">
                                                    <i class="ti ti-chart-bar"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    <b>{{ config('settings.currency_icon') }} {{ $thisYearOrders }}</b>
                                                </div>
                                                <div class="text-secondary">Orders Statistics</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="height: 300px;">
                <canvas id="orderChart"></canvas>
            </div>

            <div class="row mt-4">
                <div class="col-4">
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-primary">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/ghost -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path
                                    d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7">
                                </path>
                                <path d="M10 10l.01 0"></path>
                                <path d="M14 10l.01 0"></path>
                                <path d="M10 14a3.5 3.5 0 0 0 4 0"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Courses</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentCourses as $course)
                                        <tr>
                                            <td>
                                                <a href="{{ route('courses.show', $course->slug) }}" target="_blank"
                                                    class="ms-1"
                                                    aria-label="Open website"><!-- Download SVG icon from http://tabler.io/icons/icon/link -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-1">
                                                        <path d="M9 15l6 -6"></path>
                                                        <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
                                                        <path
                                                            d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463">
                                                        </path>
                                                    </svg>
                                                    {{ Str::limit($course->title, 50) }}
                                                </a>
                                            </td>
                                            <td class="text-secondary">
                                                @if ($course->is_approved == 'approved')
                                                    <span class="badge bg-success text-white">Approved</span>
                                                @elseif($course->is_approved == 'Pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif($course->is_approved == 'approved')
                                                    <span class="badge bg-danger text-white">Rejected</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-primary">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/ghost -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path
                                    d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7">
                                </path>
                                <path d="M10 10l.01 0"></path>
                                <path d="M14 10l.01 0"></path>
                                <path d="M10 14a3.5 3.5 0 0 0 4 0"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Blogs</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentBlogs as $blog)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="ms-1"
                                                    aria-label="Open website"><!-- Download SVG icon from http://tabler.io/icons/icon/link -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-1">
                                                        <path d="M9 15l6 -6"></path>
                                                        <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
                                                        <path
                                                            d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463">
                                                        </path>
                                                    </svg>
                                                    {{ Str::limit($blog->title, 50) }}
                                                </a>
                                            </td>
                                            <td class="text-secondary">
                                                @if ($blog->status == 1)
                                                    <span class="badge bg-success text-white">Active</span>
                                                @else
                                                    <span class="badge bg-danger text-white">Inactive</span>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card-stamp card-stamp-lg">
                        <div class="card-stamp-icon bg-primary">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/ghost -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-1">
                                <path
                                    d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7">
                                </path>
                                <path d="M10 10l.01 0"></path>
                                <path d="M14 10l.01 0"></path>
                                <path d="M10 14a3.5 3.5 0 0 0 4 0"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Orders</h3>
                        </div>
                        <div class="card-table table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>User</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.orders.show', $order->id) }}">
                                                    #{{ strtoupper($order->invoice_id) }}
                                                </a>
                                            </td>
                                            <td class="text-start">
                                                {{ $order->customer->name }}
                                            </td>
                                            <td>
                                                {{ $order->total_amount }} {{ $order->currency }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                    'Dec'
                ],
                datasets: [{
                        label: 'Order Amount ($)',
                        data: @json($monthlyOrderSums),
                        backgroundColor: 'rgba(54, 163, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Order Count',
                        data: @json($monthlyOrderCounts),
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        type: 'line',
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Order Amount ({{ config('settings.currency_icon') }})'
                        },
                        position: 'left'
                    },
                    y1: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Order Count'
                        },
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
