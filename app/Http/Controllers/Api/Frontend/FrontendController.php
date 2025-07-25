<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeNewsletterRequest;
use App\Http\Requests\StoreBlogCommentRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCommentResource;
use App\Models\AboutUsSection;
use App\Models\BecomeInstructorSection;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Brand;
use App\Models\Counter;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CustomPage;
use App\Models\Feature;
use App\Models\FeaturedInstructor;
use App\Models\Hero;
use App\Models\LatestCourseSection;
use App\Models\Newsletter;
use App\Models\Testimonial;
use App\Models\VideoSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(): JsonResponse
    {
        $hero = Hero::first();
        $feature = Feature::first() ?? [];
        $featureCategories = CourseCategory::withCount(['subCategories as active_course_count' => function ($q) {
            $q->whereHas('courses', fn($q2) => $q2->where(['is_approved' => 'approved', 'status' => 'active']));
        }])->whereNull('parent_id')->where('show_at_trending', 1)->limit(12)->get();
        $about = AboutUsSection::first();
        $latestCourses = LatestCourseSection::first();
        $becomeInstructorBanner = BecomeInstructorSection::first();
        $video = VideoSection::first();
        $brands = Brand::where('status', 1)->get();
        $featuredInstructor = FeaturedInstructor::first();
        $featuredInstructorCourses = Course::whereIn('id', json_decode($featuredInstructor?->featured_courses ?? '[]'))->get();
        $testimonials = Testimonial::all();
        $blogs = Blog::where('status', 1)->latest()->limit(6)->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'hero' => $hero,
                'feature' => $feature,
                'featureCategories' => $featureCategories,
                'about' => $about,
                'latestCourses' => $latestCourses,
                'becomeInstructorBanner' => $becomeInstructorBanner,
                'video' => $video ? new \App\Http\Resources\VideoSectionResource($video) : null,
                'brands' => $brands,
                'featuredInstructor' => $featuredInstructor,
                'featuredInstructorCourses' => $featuredInstructorCourses,
                'testimonials' => $testimonials,
                'blogs' => BlogResource::collection($blogs),
            ],
        ]);
    }

    public function about(): JsonResponse
    {
        $about = AboutUsSection::first();
        $counter = Counter::first();
        $testimonials = Testimonial::all();
        $blogs = Blog::where('status', 1)->latest()->limit(6)->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'about' => $about,
                'counter' => $counter,
                'testimonials' => $testimonials,
                'blogs' => BlogResource::collection($blogs),
            ],
        ]);
    }

    public function subscribe(SubscribeNewsletterRequest $request): JsonResponse
    {
        Newsletter::create(['email' => $request->email]);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully Subscribed!',
        ]);
    }

    public function customPage(string $slug): JsonResponse
    {
        $page = CustomPage::whereSlug($slug)->where('status', 1)->firstOrFail();

        return response()->json([
            'status' => 'success',
            'data' => ['page' => $page],
        ]);
    }

    public function blogIndex(Request $request): JsonResponse
    {
        $blogs = Blog::with('comments')
            ->where('status', 1)
            ->when($request->filled('search'), fn($q) =>
                $q->where(fn($q2) =>
                    $q2->where('title', 'like', '%' . $request->search . '%')
                       ->orWhere('description', 'like', '%' . $request->search . '%')
                )
            )
            ->when($request->filled('category'), fn($q) =>
                $q->whereHas('category', fn($q2) =>
                    $q2->where('slug', $request->category)
                )
            )
            ->paginate(20);

        return response()->json([
            'status' => 'success',
            'data' => BlogResource::collection($blogs),
            'meta' => [
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'per_page' => $blogs->perPage(),
                'total' => $blogs->total(),
            ]
        ]);
    }

    public function blogShow(Blog $blog): JsonResponse
    {
        $blog->load(['author', 'category', 'comments']);

        $recentBlogs = Blog::where('status', 1)
            ->where('slug', '!=', $blog->slug)
            ->latest()
            ->take(3)
            ->get();

        $blogCategories = BlogCategory::withCount('blogs')
            ->where('status', 1)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'blog' => new BlogResource($blog),
                'recentBlogs' => BlogResource::collection($recentBlogs),
                'blogCategories' => $blogCategories,
            ]
        ]);
    }

    public function storeComment(StoreBlogCommentRequest $request, Blog $blog): JsonResponse
    {
        $comment = BlogComment::create([
            'user_id' => $request->user()->id,
            'blog_id' => $blog->id,
            'parent_id' => $request->parent_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Comment added!',
            'data' => new BlogCommentResource($comment),
        ]);
    }
}
