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
    ->withMiddleware(function (Middleware $middleware): void {
        // Exclude certain routes from CSRF verification for serverless compatibility
        $middleware->validateCsrfTokens(except: [
            // Add any routes that need CSRF bypass if needed
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle CSRF token mismatch
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'CSRF token mismatch'], 419);
            }
            
            return redirect()->back()
                ->withInput($request->except('password'))
                ->with('error', 'Your session has expired. Please try again.');
        });
    })->create();
