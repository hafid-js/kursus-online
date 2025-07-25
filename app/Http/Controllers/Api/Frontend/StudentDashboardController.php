<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ReviewResource;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    use FileUpload;
    public function index(): JsonResponse
    {
        $user = auth()->user();

        $userCourses = $user->enrollments()->count();
        $reviewCount = Review::where('user_id', $user->id)->count();
        $orderCount = Order::where('buyer_id', $user->id)->count();

        $orderItems = Order::where('buyer_id', $user->id)
            ->with('orderItems.course')
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Dashboard data retrieved successfully',
            'data' => [
                'userCourses' => $userCourses,
                'reviewCount' => $reviewCount,
                'orderCount' => $orderCount,
                'orderItems' => OrderResource::collection($orderItems),
            ],
        ]);
    }

    public function becomeInstructor(): JsonResponse
    {
        $user = auth()->user();

        if ($user->role === 'instructor') {
            return response()->json([
                'success' => false,
                'message' => 'You are already an instructor.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'You can apply to become an instructor.',
        ]);
    }

    public function becomeInstructorUpdate(Request $request, User $user): JsonResponse
    {
        $request->validate([
            'document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:1200'],
        ]);

        $filePath = $this->uploadFile($request->file('document'));

        $user->update([
            'approve_status' => 'pending',
            'document' => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully, pending approval.',
        ]);
    }

    public function review(Request $request): JsonResponse
    {
        $user = auth()->user();

        $reviews = Review::where('user_id', $user->id)
            ->with(['user', 'course'])
            ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Reviews retrieved successfully',
            'data' => ReviewResource::collection($reviews),
            'meta' => [
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'per_page' => $reviews->perPage(),
                'total' => $reviews->total(),
            ],
        ]);
    }

    public function reviewDestroy(string $id): JsonResponse
    {
        $user = auth()->user();

        try {
            $review = Review::where('id', $id)
                ->where('user_id', $user->id)
                ->firstOrFail();

            $review->delete();

            return response()->json([
                'success' => true,
                'message' => 'Review deleted successfully',
            ]);
        } catch (Exception $e) {
            logger("Review delete error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while deleting the review',
            ], 500);
        }
    }
}
