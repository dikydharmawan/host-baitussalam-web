<?php

use App\Http\Middleware\EnsureTakmir;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Tampung konfigurasi ke dalam variabel $app (Hapus 'return' di depan)
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'takmir' => EnsureTakmir::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Manually register core providers that are failing to autoload on Vercel
$app->register(\Illuminate\Filesystem\FilesystemServiceProvider::class);
$app->register(\Illuminate\Events\EventServiceProvider::class);
$app->register(\Illuminate\View\ViewServiceProvider::class);

// 2. Jalankan perintah khusus untuk Vercel (Hanya jika di lingkungan Vercel)
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
}
$app->bind('path.public', function() {
    return base_path('public');
});

// 3. Kembalikan variabel $app di paling akhir
return $app;