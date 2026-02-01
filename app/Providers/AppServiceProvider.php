<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

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


        Paginator::useBootstrapFive();

        view()->composer('layouts.sidebar', function(View $view) {
            $view->with('popular_posts', Post::query()->orderBy('views', 'desc')->limit(3)->get());

            $view->with('categories', Category::query()->withCount('posts')->get());
        });



        // View::composer('layouts.sidebar', function(View $view) {
        //     $view->with('popular_posts', Post::query()->orderBy('views', 'desc'))->limit(3)->get();
        // });
    }
}
