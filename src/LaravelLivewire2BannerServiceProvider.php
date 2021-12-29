<?php

namespace GMJ\LaravelLivewire2Banner;

use GMJ\LaravelLivewire2Banner\Http\Livewire\Backend;
use GMJ\LaravelLivewire2Banner\View\Components\Frontend;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire;

class LaravelLivewire2BannerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php", 'LaravelLivewire2Banner');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'LaravelLivewire2Banner');

        Blade::component("LaravelLivewire2Banner", Frontend::class);
        Livewire::component("LaravelLivewire2BannerLivewire", Backend::class);

        $this->publishes([
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'GMJ\LaravelLivewire2Banner');
    }


    public function register()
    {
    }
}
