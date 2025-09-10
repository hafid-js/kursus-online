<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogCommentRequest;
use App\Http\Requests\SubscribeNewsletterRequest;
use App\Http\Resources\BlogCommentResource;
use App\Http\Resources\BlogResource;
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
use App\Traits\ApiResponseTrait;

class FrontendController extends Controller
{
    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['storeComment', 'subscribe']);
    }

    public function index(): JsonResponse
    {
        $hero = Hero::first();
        $feature = Feature::first() ?? [];
        $featureCategories = CourseCategory::withCount(['subCategories as active_course_count' => function ($q) {
            $q->whereHas('courses', fn ($q2) => $q2->where(['is_approved' => 'approved', 'status' => 'active']));
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

        return $this->sendResponse([
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
        ], 'Frontend data loaded successfully');
    }

    public function about(): JsonResponse
    {
        $about = AboutUsSection::first();
        $counter = Counter::first();
        $testimonials = Testimonial::all();
        $blogs = Blog::where('status', 1)->latest()->limit(6)->get();

        return $this->sendResponse([
            'about' => $about,
            'counter' => $counter,
            'testimonials' => $testimonials,
            'blogs' => BlogResource::collection($blogs),
        ], 'About section data retrieved');
    }

    public function subscribe(SubscribeNewsletterRequest $request): JsonResponse
    {
        Newsletter::create(['email' => $request->email]);

        return $this->sendResponse(null, 'Successfully Subscribed!');
    }

    public function customPage(string $slug): JsonResponse
    {
        $page = CustomPage::whereSlug($slug)->where('status', 1)->first();

        if (!$page) {
            return $this->sendError('Page not found', 404);
        }

        return $this->sendResponse(['page' => $page], 'Page data retrieved');
    }

    public function blogIndex(Request $request): JsonResponse
    {
        $blogs = Blog::with('comments')
            ->where('status', 1)
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('title', 'like', '%' . $request->search . '%')
                       ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('category'), function ($q) use ($request) {
                $q->whereHas('category', function ($q2) use ($request) {
                    $q2->where('slug', $request->category);
                });
            })
            ->paginate(20);

        $pagination = [
            'current_page' => $blogs->currentPage(),
            'last_page' => $blogs->lastPage(),
            'per_page' => $blogs->perPage(),
            'total' => $blogs->total(),
        ];

        return $this->sendPaginatedResponse(BlogResource::collection($blogs), 'Blogs fetched successfully', $pagination);
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

        return $this->sendResponse([
            'blog' => new BlogResource($blog),
            'recentBlogs' => BlogResource::collection($recentBlogs),
            'blogCategories' => $blogCategories,
        ], 'Blog details retrieved');
    }

    public function storeComment(StoreBlogCommentRequest $request, Blog $blog): JsonResponse
    {
        $comment = BlogComment::create([
            'user_id' => $request->user()->id,
            'blog_id' => $blog->id,
            'parent_id' => $request->parent_id,
            'comment' => $request->comment,
        ]);

        return $this->sendResponse(new BlogCommentResource($comment), 'Comment added!');
    }
}
