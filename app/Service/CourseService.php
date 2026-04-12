<?php

namespace App\Service;

use App\Http\Resources\Api\CourseResource;
use App\Http\Resources\Api\InstructorResource;
use App\Repositories\CourseRepositoryInterface;

class CourseService
{
    public function __construct(
        protected CourseRepositoryInterface $courseRepo
    ) {}

    public function getCategoryPageData($parentId)
    {
        return [
            'category_name' => $this->courseRepo->categoryName($parentId),
            'sub_categories' => $this->courseRepo->subCategories($parentId),
            'courses_get_started' => CourseResource::collection($this->courseRepo->coursesGetStarted($parentId)),
            'popular_instructors' => InstructorResource::collection($this->courseRepo->popularInstructors($parentId)),
            'all_courses' => CourseResource::collection($this->courseRepo->allCourses($parentId)),
        ];
    }
}
