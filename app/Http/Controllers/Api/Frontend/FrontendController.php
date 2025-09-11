<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsSection;
use App\Models\BecomeInstructorSection;
use App\Models\Blog;
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
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    use ApiResponseTrait;

    public function home(): JsonResponse
    {
        $data = [
            'hero' => Cache::rememberForever('homepage_hero', fn() => Hero::first()),
            'feature' => Cache::rememberForever('homepage_feature', fn() => Feature::first() ?? new Feature()),
            'featureCategories' => Cache::rememberForever('homepage_feature_categories', function () {
                return CourseCategory::withCount([
                    'subCategories as active_course_count' => function ($query) {
                        $query->whereHas('courses', function ($query) {
                            $query->where([
                                'is_approved' => 'approved',
                                'status' => 'active'
                            ]);
                        });
                    }
                ])
                    ->whereNull('parent_id')
                    ->where('show_at_trending', 1)
                    ->limit(12)
                    ->get();
            }),
            'about' => Cache::rememberForever('homepage_about', fn() => AboutUsSection::first()),
            'latestCourses' => Cache::rememberForever('homepage_latest_courses', fn() => LatestCourseSection::first()),
            'becomeInstructorBanner' => Cache::rememberForever('homepage_instructor_banner', fn() => BecomeInstructorSection::first()),
            'video' => Cache::rememberForever('homepage_video_section', fn() => VideoSection::first()),
            'brands' => Cache::rememberForever('homepage_brands', fn() => Brand::where('status', 1)->get()),
            'featuredInstructor' => Cache::rememberForever('homepage_featured_instructor', fn() => FeaturedInstructor::first()),
            'testimonials' => Cache::rememberForever('homepage_testimonials', fn() => Testimonial::all()),
            'blogs' => Cache::rememberForever('homepage_blogs', fn() => Blog::where('status', 1)->latest()->limit(6)->get()),
        ];

        $data['featuredInstructorCourses'] = Course::whereIn(
            'id',
            json_decode($data['featuredInstructor']?->featured_courses ?? '[]')
        )->get();

        return $this->sendResponse($data, 'Homepage data retrieved successfully.');
    }

    public function about(): JsonResponse
    {
        $data = [
            'about' => Cache::rememberForever('homepage_about', fn() => AboutUsSection::first()),
            'counter' => Cache::rememberForever('aboutpage_counter', fn() => Counter::first()),
            'testimonials' => Cache::rememberForever('homepage_testimonials', fn() => Testimonial::all()),
            'blogs' => Cache::rememberForever('homepage_blogs', fn() => Blog::where('status', 1)->latest()->limit(6)->get()),
        ];

        return $this->sendResponse($data, 'About page data retrieved successfully.');
    }

    public function subscribe(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already subscribed',
        ]);

        Newsletter::create($validated);

        return $this->sendResponse(null, 'Successfully Subscribed!');
    }

    public function customPage(string $slug): JsonResponse
    {
        $page = Cache::rememberForever(
            "custom_page_{$slug}",
            fn() => CustomPage::where('slug', $slug)->where('status', 1)->first()
        );

        if (!$page) {
            return $this->sendError('Custom page not found', 404);
        }

        return $this->sendResponse($page, 'Custom page data retrieved successfully.');
    }

    public function categories(): JsonResponse
    {
        $categories = CourseCategory::withCount([
            'subCategories as active_course_count' => function ($query) {
                $query->whereHas('courses', fn($query) =>
                    $query->where(['is_approved' => 'approved', 'status' => 'active'])
                );
            }
        ])
            ->whereNull('parent_id')
            ->paginate(12);

        return $this->sendPaginatedResponse(
            $categories->items(),
            'Categories retrieved successfully.',
            [
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'per_page' => $categories->perPage(),
                'total' => $categories->total(),
            ]
        );
    }
}
