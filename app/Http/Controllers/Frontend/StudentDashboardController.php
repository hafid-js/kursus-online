<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{

    use FileUpload;
    function index(): View
    {
        $userCourses = user()->enrollments()->count();
        $reviewCount = Review::where('user_id', user()->id)->count();
        $orderCount = Order::where('buyer_id', user()->id)->count();


        $orderItems = Order::where('buyer_id', user()->id)
            ->with('orderItems.course')  // load orderItems dan relasi course di dalamnya
            ->take(10)
            ->get();

        return view('frontend.student-dashboard.index', compact('userCourses', 'orderCount', 'reviewCount', 'orderItems'));
    }

    function becomeInstructor()
    {
        if (auth()->user()->role == 'instructor') abort(404);
        return view('frontend.student-dashboard.become-instructor.index');
    }

    function becomeInstructorUpdate(Request $request, User $user): RedirectResponse
    {
        $request->validate(['document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:1200']]);
        $filePath = $this->uploadFile($request->file('document'));
        $user->update([
            'approve_status' => 'pending',
            'document' => $filePath
        ]);

        return redirect()->route('student.dashboard');
    }

    function review()
    {
        $reviews = Review::where('user_id', user()->id)->paginate(10);
        return view('frontend.student-dashboard.review.index', compact('reviews'));
    }

    function reviewDestroy(string $id)
    {
        try {
            $review = Review::where('id', $id)->where('user_id', user()->id)->firstOrFail();
            $review->delete();
            notyf()->success('Deleted Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        } catch (Exception $e) {
            logger("Review Error >> " . $e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
