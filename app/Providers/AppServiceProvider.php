<?php

namespace App\Providers;

use App\Support\SiteContent;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        View::composer(['index', 'book_demo', 'teacher_login', 'course_detail'], function ($view): void {
            $view->with('siteContent', SiteContent::values());
        });
    }
}
