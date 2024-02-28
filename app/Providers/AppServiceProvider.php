<?php

namespace App\Providers;

use App\Models\Box;
use App\Models\Digital;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use App\Models\Partner;
use App\Models\ProjectCategory;
use App\Models\Slider;
use App\Models\Video;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //68804A defalth color
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {
            $pages = Page::where('is_active', 1)->get();
            $videos = Video::where('is_active', 1)->get();
            $digitals = Digital::where('is_active', 1)->get();
            $project_categories = ProjectCategory::where('is_active', 1)->get();
            $galleries = Gallery::where('is_active', 1)->orderBy('order_number', 'asc')->get();
            $sliders = Slider::where('is_active', 1)->orderBy('order_number', 'asc')->get();
            $icons = Box::where('is_active', 1)->get();
            $partners = Partner::where('is_active', 1)->get();
            $news = News::whereIsActive(1)->orderBy('created_at', 'desc')->get();

            View::share('digitals', $digitals);
            View::share('videos', $videos);
            View::share('project_categories', $project_categories);
            View::share('galleries', $galleries);
            View::share('news', $news);
            View::share('sliders', $sliders);
            View::share('pages', $pages);
            View::share('icons', $icons);
            View::share('partners', $partners);
        });
    }
}
