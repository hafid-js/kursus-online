<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

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
            'userCourses' => $userCourses,
            'reviewCount' => $reviewCount,
            'orderCount' => $orderCount,
            'orderItems' => $orderItems,
        ]);
    }

    public function becomeInstructor(): JsonResponse
    {
        $user = auth()->user();
        if ($user->role === 'instructor') {
            return response()->json(['message' => 'Already an instructor'], 403);
        }

        return response()->json(['message' => 'Eligible to become instructor']);
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

        return response()->json(['message' => 'Instructor application submitted successfully']);
    }

    public function review(): JsonResponse
    {
        $reviews = Review::where('user_id', auth()->id())->paginate(10);

        return response()->json($reviews);
    }

    public function reviewDestroy(string $id): JsonResponse
    {
        try {
            $review = Review::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
            $review->delete();
            return response()->json(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("Review Error >> " . $e);
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }
}
