# gmj-laravel_livewire2_banner

Laravel Block for backend and frontend - need tailwindcss support

**composer require gmj/laravel_livewire2_banner**

in terminal run:

```
php artisan vendor:publish --provider="GMJ\LaravelLivewire2Banner\LaravelLivewire2BannerServiceProvider" --force
php artisan migrate
php artisan db:seed --class=LaravelLivewire2BannerSeeder
```

package for test<br>
composer.json#autoload-dev#psr-4: "GMJ\\LaravelLivewire2Banner\\": "package/laravel_livewire2_banner/src/",<br>
config: GMJ\LaravelLivewire2Banner\LaravelLivewire2BannerServiceProvider::class,
