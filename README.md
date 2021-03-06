# Laravel Exception Mailer

Whenever an uncaught exception is thrown,
this handler will email details about it and the request.

## Installation

    composer require jpuck/laravel-exception-mailer

If you're running Laravel 5.5, then you're done.

For Laravel 5.4, add the service provider to `config/app.php`

```php
jpuck\laravel\exception\mailer\Provider::class,
```

## Configuration

Make sure the app's mail settings are configured properly.

By default it will send to the `config('mail.from.address')`
but this and the subject can be overridden by publishing the configuration file.

    php artisan vendor:publish --tag=config --provider='jpuck\laravel\exception\mailer\Provider'

### Don't Report

You can filter out exceptions you aren't interested in by filling in the
`dontReport` array in `App\Exceptions\Handler`

```php
protected $dontReport = [
    \Illuminate\Foundation\Http\Exceptions\MaintenanceModeException::class,
    \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
    \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class,
    \Illuminate\Auth\AuthenticationException::class,
    \Illuminate\Auth\Access\AuthorizationException::class,
    \Illuminate\Session\TokenMismatchException::class,
];
```

### Customize Layout

You can also publish the view to customize the format.

    php artisan vendor:publish --tag=views --provider='jpuck\laravel\exception\mailer\Provider'
