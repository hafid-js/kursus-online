<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\User;
use Intervention\Image\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CourseRepository implements CourseRepositoryInterface
{
    public function categoryName($parentId) {
        return CourseCategory::select('name')->where('id', $parentId)->first();
    }

    public function subCategories ($parentId) {
        return CourseCategory::select('id','name')->where('parent_id', $parentId)->get();
    }
   public function coursesGetStarted($parentId)
{
    return Course::with(['instructor:id,name', 'category'])
        ->withCount('reviews')
        ->whereHas('category', function ($q) use ($parentId) {
            $q->where('slug', 'development')
              ->orWhere('parent_id', $parentId);
        })
        ->limit(5)
        ->get();
}

    public function popularInstructors($parentId)
    {

        return User::select('id','name', 'image', 'headline')->whereHas('courses', function ($q) use ($parentId) {
            $q->whereHas('category', function ($q2) use ($parentId) {
                $q2->where('slug', 'development')
                    ->orWhere('parent_id', $parentId);
            });
        })
            ->withCount([
                'courses as courses_count',
                'students as students_count'
            ])
            ->get();
    }

    public function allCourses($parentId)
    {
        return Course::with(['instructor', 'category'])->withCount('reviews')
            ->select('id', 'title', 'thumbnail', 'price', 'instructor_id')->whereHas('category', function ($q) use ($parentId) {
                $q->where('slug', 'development')
                    ->orWhere('parent_id', $parentId);
            })
            ->get();
    }
}
