<?php

namespace jpuck\laravel\exception\mailer;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;

class Provider extends ServiceProvider
{
    public function boot()
    {
        $config = __DIR__.'/../config/exception-mailer.php';
        $this->publishes([
            $config => config_path('exception-mailer.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../views', 'exception-mailer');
    }

    public function register()
    {
        $this->app->singleton(ExceptionHandler::class, Handler::class);
    }
}
