<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Notifications;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
         View::composer('*', function ($view) {

        if (Auth::check()) {

            $notifications = Notifications::where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get();

            $unread = Notifications::where('user_id', Auth::id())
                ->where('is_read', false)
                ->count();

            $view->with([
                'notifications' => $notifications,
                'unreadNotifications' => $unread,
            ]);
        }

    });
    }
}
