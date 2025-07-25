<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderItemResource;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;

class InstructorDashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $user = auth()->user();

        $pendingCoursesCount = Course::where('instructor_id', $user->id)
            ->where('is_approved', 'pending')
            ->count();

        $approvedCoursesCount = Course::where('instructor_id', $user->id)
            ->where('is_approved', 'approved')
            ->count();

        $rejectedCoursesCount = Course::where('instructor_id', $user->id)
            ->where('is_approved', 'rejected')
            ->count();

        $orderItems = OrderItem::with('course')
            ->whereHas('course', fn($q) => $q->where('instructor_id', $user->id))
            ->latest()
            ->take(10)
            ->get();

        $bestSellingCourses = OrderItem::whereHas('order', fn($q) => $q->where('status', 'approved'))
            ->with('course')
            ->get()
            ->groupBy('course_id')
            ->map(function ($items) {
                $firstItem = $items->first();

                $totalBuyers = $items->pluck('order.buyer_id')->unique()->count();
                $totalRevenue = $items->sum(fn($item) => $item->price * $item->qty);

                return (object) [
                    'course' => $firstItem->course,
                    'total_buyers' => $totalBuyers,
                    'total_revenue' => $totalRevenue,
                ];
            })
            ->sortByDesc('total_buyers')
            ->take(5)
            ->values();

        return response()->json([
            'success' => true,
            'message' => 'Instructor dashboard data retrieved successfully',
            'data' => [
                'pendingCourses' => $pendingCoursesCount,
                'approvedCourses' => $approvedCoursesCount,
                'rejectedCourses' => $rejectedCoursesCount,
                'orderItems' => OrderItemResource::collection($orderItems),
                'bestSellingCourses' => $bestSellingCourses->map(function ($item) {
                    return [
                        'course' => new CourseResource($item->course),
                        'total_buyers' => $item->total_buyers,
                        'total_revenue' => $item->total_revenue,
                    ];
                }),
            ],
        ]);
    }
}
