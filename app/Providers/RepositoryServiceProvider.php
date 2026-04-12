<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\CourseRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
