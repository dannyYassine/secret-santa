<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public $whoops;

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
        $this->whoops = new \Whoops\Run;
        $this->whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $this->whoops->register();

        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
//        echo config('app.debug');
//        if (config('app.debug')) {
//            $html = $this->whoops->handleException($e);
//            return $html;
//        }
        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }
}
