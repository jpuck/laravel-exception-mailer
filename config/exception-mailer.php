<?php

return [
    'to' => env('EXCEPTION_MAILER_TO_ADDRESS'),
    'subject' => 'EXCEPTION THROWN in '.env('APP_NAME').' '.env('EXCEPTION_MAILER_SIGNATURE'),
];
