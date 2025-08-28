<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InstructorDashboardController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        $pendingCourses = Course::where('instructor_id', user()->id)->where('is_approved', 'pending')->orderBy('id', 'DESC')->limit(5)->count();
        $approvedCourses = Course::where('instructor_id', user()->id)->where('is_approved', 'approved')->orderBy('id', 'DESC')->limit(5)->count();
        $rejectedCourses = Course::where('instructor_id', user()->id)->where('is_approved', 'rejected')->orderBy('id', 'DESC')->limit(5)->count();

        $orderItems = OrderItem::whereHas('course', function ($query) {
            $query->where('instructor_id', user()->id);
        })->take(10)->get();

        $bestSellingCourses = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'approved');
        })->whereHas('course', function ($query) {
            $query->where('instructor_id', user()->id);
        })->with('course', 'order')
            ->take(10)
            ->get()
            ->groupBy('course_id')
            ->map(function ($items) {
                $firstItem = $items->first();

                $totalBuyers = $items->pluck('order.buyer_id')->unique()->count();
                $totalRevenue = $items->sum(function ($item) {
                    return $item->price * $item->qty;
                });

                return (object) [
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

    public function documentUpdate(Request $request, User $user)
    {
        $request->validate([
            'document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:1200'],
        ]);

        $filePath = $this->uploadFile($request->file('document'));

        $user->update([
            'document' => $filePath,
            'document_status' => 'pending',
        ]);

        notyf()->success('Document Submitted Successfully!');

        return redirect()
            ->route('instructor.dashboard');
    }

    public function review()
    {
        $reviews = Review::where('user_id', auth()->id())->paginate(10);

        return view('frontend.instructor-dashboard.review.index', compact('reviews'));
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
        } catch (\Exception $e) {
            logger('Review Error >> ' . $e);

            return redirect()
                ->back()
                ->with('error', 'Something went wrong!');
        }
    }
}
