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
        //use Illuminate\Support\Facades\View;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //フォロー数とフォロワー数を全ビューで表示
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $followCount = $user->following()->count();
                $followerCount = $user->followers()->count();
                $view->with(compact('followCount', 'followerCount'));
            }
        });
    }
}
