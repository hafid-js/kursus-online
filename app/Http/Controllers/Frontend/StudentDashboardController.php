<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use App\Traits\FileUpload;
use Exception;
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

        if ($user->role === 'instructor') {
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
            'document' => $filePath
        ]);

        notyf()->success('Instructor application submitted successfully!');

        return redirect()
            ->route('student.dashboard');
    }

    public function review()
    {
        $reviews = Review::where('user_id', auth()->id())->paginate(10);

        return view('frontend.student-dashboard.review.index', compact('reviews'));
    }

    public function reviewDestroy(string $id)
    {
        try {
            $review = Review::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $review->delete();

            return redirect()
                ->back()
                ->with('success', 'Review deleted successfully!');
        } catch (Exception $e) {
            logger("Review Error >> " . $e);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong!');
        }
    }
}
