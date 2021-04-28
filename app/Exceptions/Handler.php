<?php

namespace App\Exceptions;

use Flash;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * 
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            switch ($exception->getStatusCode()) {
                case 404:
                    Flash::error(Lang::get('flash.404'));
                    return app('App\Http\Controllers\HomeController')->index();
                    break;

                case 403:
                    Flash::error(Lang::get('flash.403'));
                    return app('App\Http\Controllers\HomeController')->index();
                    break;

                default:
                    return parent::render($request, $exception);
                    break;
            }
        } else {
            return parent::render($request, $exception);
        }
    }
}
