<?php

namespace jpuck\laravel\exception\mailer;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use App\User;
use Illuminate\Validation\ValidationException;

class Handler
{
    public function mail(Exception $exception)
    {
        if (App::Environment() === 'testing') {
            return;
        }

        if (in_array(get_class($exception), $this->dontReport())) {
            return;
        }

        $user = Auth::user();
        if ($user instanceof User) {
            $user = json_encode($user->toArray(), JSON_PRETTY_PRINT);
        }

        $data = [
            'exception' => $exception,
            'user'      => Request::ip().PHP_EOL.$user.PHP_EOL.Request::header('User-Agent'),
            'request'   => Request::method().' '.Request::fullUrl().PHP_EOL
                        . 'Previous: '.URL::previous().PHP_EOL
                        . 'Referrer: '.Request::server('HTTP_REFERER').PHP_EOL
                        . print_r(Request::all(), true),
        ];

        if ($exception instanceof ValidationException) {
            $data['validations'] = $this->getValidationErrors($exception);
        }

        Mail::send('exception-mailer::mail', $data, function ($message) {
            $message->to($this->getRecipient());
            $message->subject($this->getSubject());
        });
    }

    protected function dontReport() : array
    {
        return [];
    }

    protected function getRecipient() : string
    {
        return config('mail.from.address');
    }

    protected function getSubject() : string
    {
        return 'THROWN '.config('app.name');
    }

    protected function getValidationErrors(ValidationException $exception) : string
    {
        $failed = $exception->validator->failed();
        $messages = $exception->validator->errors()->messages();
        return print_r(array_merge_recursive($failed, $messages), true);
    }
}
