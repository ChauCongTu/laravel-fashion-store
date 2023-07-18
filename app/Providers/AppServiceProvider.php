<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFour();
        view()->composer('layouts.master', function ($view) {
            $setting = DB::table('settings')->where('id', 1)->first();
            $categories = Category::where('is_parent', 1)->get();
            $view->with('home', $setting)->with('categories', $categories);
        });
    }
}
