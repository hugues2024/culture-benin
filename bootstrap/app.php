<?php

use App\Http\Middleware\CheckContenuPaiement;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // ✅ Fusionner les alias en un seul tableau
        $middleware->alias([
            'admin.ou.manager' => \App\Http\Middleware\AdminOuManager::class,
            '2fa' => \App\Http\Middleware\Check2FA::class,
            'a_payé'=>CheckContenuPaiement::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
