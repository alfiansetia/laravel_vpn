<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        view()->composer(
            [
                'layouts.backend.template',
                'layouts.template',
                'layouts.auth',
                'auth.verify',
                'auth.confirm',
                'setting.profile',
                'setting.profile.profile_edit',
                'setting.profile.social',
                'setting.profile.password',
                'setting.company.general',
                'setting.company.social',
                'setting.company.image',
                'setting.company.telegram',
                'components.backend.footer',
            ],
            function ($view) {
                $view->with('company', Company::first());
                // $view->with('user', auth()->user());

                $view->with('user', User::with('notification_unreads')->withCount('notification_unreads')->find(auth()->id()));
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
