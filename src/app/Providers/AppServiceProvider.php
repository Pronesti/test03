<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('components.uploadStory', 'uploadStory');
        Blade::component('components.sidebar', 'sidebar');
        Blade::component('components.stories', 'stories');
        Blade::component('components.showPosts', 'showPosts');
        Blade::component('components.postCategory', 'postCategory');
        Blade::component('components.modal', 'modal');
        Blade::component('components.carousel', 'carousel');
        Blade::component('components.modalUserLine', 'modalUserLine');
        Blade::component('components.notifications', 'notifications');
        Blade::component('components.userDropMenu', 'userDropMenu');
        Blade::component('components.post', 'post');
        Blade::component('components.postButtons', 'postButtons');
        Blade::component('components.pagination', 'pagination');
        Blade::component('components.comment', 'comment');
        Blade::component('components.addComment', 'addComment');
    }
}
