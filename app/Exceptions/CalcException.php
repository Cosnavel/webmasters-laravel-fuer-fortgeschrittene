<?php

namespace App\Exceptions;

use App\Mail\Quote;
use Exception;
use Illuminate\Support\Facades\Mail;

class CalcException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        info('error, falsche Handhabung von calc');

        Mail::to('bug@laravel.io')->send(new Quote());
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return $this->message ? $this->message : abort(500);
    }
}
