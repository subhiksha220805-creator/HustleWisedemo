<?php

namespace App\Providers;

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
<<<<<<< HEAD
        //
=======
        View::composer(['index', 'book_demo', 'teacher_login', 'course_detail'], function ($view): void {
            $view->with('siteContent', SiteContent::values());
        });
>>>>>>> c35d112 (Updated Hustle Wise website)
    }
}
