<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = Review::with(['user:id,name','course:id,title'])->paginate(20);
        return view('admin.review.index', compact('reviews'));
    }

    public function show(Review $review)
    {
        return response()->view('admin.review.detail-review-modal', compact('review'));
    }
    public function update(Request $request, Review $review)
    {
        $review->status = $request->status ? 1 : 0;
        $review->save();

        notyf()->success('Updated Sucessfully!');
        return redirect()->back();
    }


    public function destroy(Review $review)
    {
         try {
            $review->delete();
            notyf()->success('Deleted Successfully!');
            return response(['message' => 'Deleted Successfully!'], 200);
        }catch(Exception $e) {
            logger("Course Ratting Error >> ".$e);
            return response(['message' => 'Something went wrong!'], 500);
        }
    }
}
