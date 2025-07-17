<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorDashboardController extends Controller
{
    function index(): View
    {
        $pendingCourses = Course::where('instructor_id', user()->id)->where('is_approved', 'pending')->orderBy('id', 'DESC')->limit(5)->count();
        $approvedCourses = Course::where('instructor_id', user()->id)->where('is_approved', 'approved')->orderBy('id', 'DESC')->limit(5)->count();
        $rejectedCourses = Course::where('instructor_id', user()->id)->where('is_approved', 'rejected')->orderBy('id', 'DESC')->limit(5)->count();

        $orderItems = OrderItem::whereHas('course', function ($query) {
            $query->where('instructor_id', user()->id);
        })->take(10)->get();

        $bestSellingCourses = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'approved');
        })
            ->with('course', 'order')
            ->get()
            ->groupBy('course_id')
            ->map(function ($items) {
                $firstItem = $items->first();

                $totalBuyers = $items->pluck('order.buyer_id')->unique()->count();
                $totalRevenue = $items->sum(function ($item) {
                    return $item->price * $item->qty;
                });

                return (object)[
                    'course' => $firstItem->course,
                    'total_buyers' => $totalBuyers,
                    'total_revenue' => $totalRevenue,
                ];
            })
            ->sortByDesc('total_buyers')
            ->take(5)
            ->values();

        return view('frontend.instructor-dashboard.index', compact('pendingCourses', 'approvedCourses', 'rejectedCourses', 'orderItems', 'bestSellingCourses'));
    }
}
