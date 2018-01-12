# Laravel Exception Mailer

Simple email reporter for exceptions in laravel.

## Installation

    composer require laravel-exception-mailer

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
    \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
    \Illuminate\Auth\AuthenticationException::class,
];
```

### Customize Layout

You can also publish the view to customize the format.

    php artisan vendor:publish --tag=views --provider='jpuck\laravel\exception\mailer\Provider'