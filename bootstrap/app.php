<?php

use Illuminate\Routing\Router;
use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\ValidateSignature;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        function (Router $router) {
            $router->middleware('web')
                ->group(base_path('routes/web.php'));

            $router->middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
                
                $router->middleware('web')
                ->prefix('instructor')
                ->group(base_path('routes/instructor.php'));
                
                $router->middleware('web')
                ->prefix('student')
                ->group(base_path('routes/student.php'));
        },


        commands: __DIR__ . '/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => CheckRole::class,
            'auth', Authenticate::class,
            'signed', ValidateSignature::class,
            'throttle', ThrottleRequests::class,
           
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
