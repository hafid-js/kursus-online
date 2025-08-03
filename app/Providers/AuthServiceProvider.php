<?php

namespace App\Providers;

use App\Models\BlogComment;
use App\Policies\BlogCommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        BlogComment::class => BlogCommentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
