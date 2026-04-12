<?php
namespace App\Repositories;

interface CourseRepositoryInterface
{
    public function categoryName($parentId);
    public function subCategories($parentId);
    public function coursesGetStarted($parentId);
    public function popularInstructors($parentId);
    public function allCourses($parentId);
}
