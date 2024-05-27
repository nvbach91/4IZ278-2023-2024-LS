<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Material;
use App\Models\University;
use App\Policies\CommentPolicy;
use App\Policies\MaterialPolicy;
use App\Policies\UniversityPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $policies = [
        Material::class => MaterialPolicy::class,
        University::class => UniversityPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
