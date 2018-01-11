<?php

namespace jpuck\laravel\exception\mailer;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'exception-mailer');
    }
}
