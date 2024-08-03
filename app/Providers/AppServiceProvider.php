<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Http\ViewComposers\SocialMediaComposer;
use App\Http\ViewComposers\MainConfigComposer;
use App\Http\ViewComposers\SubServiceComposer;
use App\Http\ViewComposers\FooterContact;

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
        Schema::defaultStringLength(191);
        View::composer(
            'fe.*', // Nama view yang menggunakan composer ini
            SocialMediaComposer::class
        );
        View::composer(
            'fe.*', // Nama view yang menggunakan composer ini
            MainConfigComposer::class
        );
        View::composer(
            'fe.*', // Nama view yang menggunakan composer ini
            SubServiceComposer::class
        );
        View::composer(
            'fe.*', // Nama view yang menggunakan composer ini
            FooterContact::class
        );
    }
}
