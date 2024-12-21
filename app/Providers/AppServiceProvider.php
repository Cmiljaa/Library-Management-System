<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
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
        Gate::define('isUserSelf', function($authUser, $userBeingAuthorized){
            return $authUser->id === $userBeingAuthorized->id;
        });

        Gate::define('canAccessReview', function($authUser, $review){
            return $authUser->id === $review->user_id;
        });
        
        Gate::define('isUserSelfOrAdminLibrarian', function ($authUser, $userBeingAuthorized) {
            return $authUser->role === 'admin' || $authUser->role === 'librarian' || Gate::allows('isUserSelf', $userBeingAuthorized);
        });
    }
}
