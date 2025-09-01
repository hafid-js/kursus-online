<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    use FileUpload;

    public function index()
    {
        $user = auth()->user();

        $userCourses = $user->enrollments()->count();
        $reviewCount = Review::where('user_id', $user->id)->count();
        $orderCount = Order::where('buyer_id', $user->id)->count();

        $orderItems = Order::where('buyer_id', $user->id)
            ->with('orderItems.course')
            ->take(10)
            ->get();

        return view('frontend.student-dashboard.index', compact(
            'userCourses',
            'reviewCount',
            'orderCount',
            'orderItems'
        ));
    }

    public function becomeInstructor()
    {
        $user = auth()->user();

        if ('instructor' === $user->role) {
            return view('frontend.dashboard.already-instructor');
        }

        return view('frontend.student-dashboard.become-instructor.index');
    }

    public function becomeInstructorUpdate(Request $request, User $user)
    {
        $request->validate([
            'document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:1200'],
        ]);

        $filePath = $this->uploadFile($request->file('document'));

        $user->update([
            'document' => $filePath,
            'document_status' => 'pending',
        ]);

        notyf()->success('Instructor application submitted successfully!');

        return redirect()
            ->route('student.dashboard');
    }
}
