<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Cloudflared connects to the local Laravel server and forwards the
        // public HTTPS scheme. Trust that scheme only from the loopback proxy.
        $middleware->trustProxies(
            at: '127.0.0.1',
            headers: \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO,
        );
        
        $middleware->validateCsrfTokens(except: [
            'stripe/webhook'
        ]);
    
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
