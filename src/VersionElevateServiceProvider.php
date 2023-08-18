<?php

namespace IrfanChowdhury\VersionElevate;
use Illuminate\Support\ServiceProvider;


class VersionElevateServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
