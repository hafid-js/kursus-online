<?php

namespace App\Http\Controllers\Frontend;

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
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{

    function index(): View
    {
        $hero = Cache::rememberForever('homepage_hero',  function () {
            return Hero::first();
        });

        $feature = Cache::rememberForever('homepage_feature',  function () {
            return Feature::first() ?? new Feature();
        });

        $featureCategories = Cache::rememberForever('homepage_feature_categories',  function () {
            return CourseCategory::withCount([
                'subCategories as active_course_count' => function ($query) {
                    $query->whereHas('courses', function ($query) {
                        $query->where(['is_approved' => 'approved', 'status' => 'active']);
                    });
                }
            ])
                ->where(['parent_id' => null, 'show_at_trending' => 1])
                ->limit(12)
                ->get();
        });

        $about = Cache::rememberForever('homepage_about',  function () {
            return AboutUsSection::first();
        });

        $latestCourses = Cache::rememberForever('homepage_latest_courses',  function () {
            return LatestCourseSection::first();
        });

        $becomeInstructorBanner = Cache::rememberForever('homepage_instructor_banner',  function () {
            return BecomeInstructorSection::first();
        });

        $video = Cache::rememberForever('homepage_video_section',  function () {
            return VideoSection::first();
        });

        $brands = Cache::rememberForever('homepage_brands',  function () {
            return Brand::where('status', 1)->get();
        });

        $featuredInstructor = Cache::rememberForever('homepage_featured_instructor',  function () {
            return FeaturedInstructor::first();
        });

        $featuredInstructorCourses = Course::whereIn('id', json_decode($featuredInstructor?->featured_courses ?? '[]'))->get();

        $testimonials = Cache::rememberForever('homepage_testimonials',  function () {
            return Testimonial::all();
        });

        $blogs = Cache::rememberForever('homepage_blogs',  function () {
            return Blog::where('status', 1)->latest()->limit(6)->get();
        });

        return view('frontend.pages.index', compact(
            'hero',
            'feature',
            'featureCategories',
            'about',
            'latestCourses',
            'becomeInstructorBanner',
            'video',
            'brands',
            'featuredInstructor',
            'featuredInstructorCourses',
            'testimonials',
            'blogs'
        ));
    }


    function about()
    {
        $about = Cache::rememberForever('homepage_about', function () {
            return AboutUsSection::first();
        });
        $counter = Cache::rememberForever('aboutpage_counter', function () {
            return Counter::first();
        });
        $testimonials = Cache::rememberForever('homepage_testimonials', function () {
            return Testimonial::all();
        });
        $blogs = Cache::rememberForever('homepage_blogs', function () {
            return Blog::where('status', 1)->latest()->limit(6)->get();
        });
        return view('frontend.pages.about', compact('about', 'counter', 'testimonials', 'blogs'));
    }

    function subscribe(Request $request): Response
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already subscribed'
        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->save();

        return response([
            'status' => 'success',
            'message' => 'Successfully Subscribed!'
        ]);
    }

    function customPage(string $slug)
    {
        $page = Cache::rememberForever("custom_page_{$slug}", function () use ($slug) {
            return CustomPage::where('slug', $slug)->where('status', 1)->firstOrFail();
        });

        return view('frontend.pages.custom-page', compact('page'));
    }

    public function categories()
    {
        $featureCategories = CourseCategory::withCount([
            'subCategories as active_course_count' => function ($query) {
                $query->whereHas('courses', function ($query) {
                    $query->where(['is_approved' => 'approved', 'status' => 'active']);
                });
            }
        ])
            ->whereNull('parent_id')
            ->paginate(12);

        return view('frontend.pages.categories-page', compact('featureCategories'));
    }
}
