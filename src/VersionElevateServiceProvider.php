<?php

namespace IrfanChowdhury\VersionElevate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class VersionElevateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/version_elevate.php', 'version_elevate'
        );
    }

    public function boot(): void
    {
        Route::middleware('web')->group(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
        Route::middleware('api')->prefix('api')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'version-elevate');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'version-elevate');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/version-elevate'),
            __DIR__.'/../lang' => $this->app->langPath('vendor/version-elevate'),
        ]);

        $this->publishes([
            __DIR__.'/../public/assets' => public_path('vendor/version-elevate/assets'),
        ], 'public');
    }
}
