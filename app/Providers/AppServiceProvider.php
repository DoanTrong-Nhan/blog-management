<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Services\AuthServiceInterface;
use App\Services\AuthService;
use App\Services\PostService;
use App\Services\PostServiceInterface;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
     $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
     $this->app->bind(AuthServiceInterface::class, AuthService::class);

     $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
     $this->app->bind(PostServiceInterface::class, PostService::class);

    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
      
    Blade::if('canManagePost', function ($post) {
         $user = Auth::user();
        return $user && ($user->role->name === 'admin' || $user->id === $post->user_id);
    });
    }
}
