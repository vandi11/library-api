<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(api: __DIR__.'/../routes/api.php')
    ->withMiddleware(function (Middleware $middleware): void {
        // API routes are stateless by default.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Laravel returns validation errors as JSON for API requests.
    })->create();
