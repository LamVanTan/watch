<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('publicUrl',getenv('PUBLIC_URL'));
        View::share('adminUrl',getenv('ADMIN_URL'));



        $category = Category::where('cat_parent_id',0)->get();
        $category_parent = Category::all();
        //dd($menu_category);
        view::share(compact('category_parent','category'));
        
    }
}
