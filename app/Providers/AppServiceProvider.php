<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
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
        // 全てのビューで利用できるようにするためのビューコンポーザーを定義
        // View::composer('*', function ($view) {
        //     if (Auth::check()) {
        //         $user = Auth::user();
        //         $followingCount = $user->follows()->count();
        //         $followersCount = $user->followers()->count();

        //         $view->with('followingCount', $followingCount)
        //              ->with('followersCount', $followersCount);
        //     }
        // });
    }
}
