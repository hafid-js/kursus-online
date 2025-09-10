<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    use FileUpload, ApiResponseTrait;

    public function index()
    {
        $user = auth()->user();

        $userCourses = $user->enrollments()->count();
        $reviewCount = Review::where('user_id', $user->id)->count();
        $orderCount = Order::where('buyer_id', $user->id)->count();

        $orderItems = Order::where('buyer_id', $user->id)
            ->with('orderItems.course')
            ->latest()
            ->take(10)
            ->get();

        $data = [
            'courses_enrolled' => $userCourses,
            'reviews_made'     => $reviewCount,
            'orders_placed'    => $orderCount,
            'recent_orders'    => $orderItems,
        ];

        return $this->sendResponse($data, 'Student dashboard data retrieved successfully.');
    }

    public function becomeInstructor()
    {
        $user = auth()->user();

        if ($user->role === 'instructor') {
            return $this->sendError('You are already an instructor.', 409);
        }

        return $this->sendResponse(null, 'Ready to become instructor.');
    }

    public function becomeInstructorUpdate(Request $request)
    {
        $request->validate([
            'document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:1200'],
        ]);

        $user = auth()->user();

        $filePath = $this->uploadFile($request->file('document'));

        $user->update([
            'document'         => $filePath,
            'document_status'  => 'pending',
        ]);

        return $this->sendResponse(null, 'Instructor application submitted successfully!');
    }
}
