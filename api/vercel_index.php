<?php

/*
|--------------------------------------------------------------------------
| Vercel Deployment Entry Point
|--------------------------------------------------------------------------
|
| This file is the entry point for Vercel. It manually configures the
| Laravel application to work in the Vercel serverless environment,
| specifically binding the public path correctly.
|
*/

// 1. Require Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 2. Create The Application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Bind Paths for Vercel
// Bind the public path to the 'public' directory at the project root
$app->bind('path.public', function() {
    return __DIR__ . '/../public';
});

// Fix storage path if needed (Vercel is read-only except /tmp)
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
    
    // Ensure cache paths are also in /tmp
    $app->useCachedPackagesPath('/tmp/packages.php');
    $app->useCachedServicesPath('/tmp/services.php');
    
    // Ensure the storage directories exist
    if (!is_dir('/tmp/storage/framework/views')) {
        mkdir('/tmp/storage/framework/views', 0755, true);
    }
}

// 4. Handle The Request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
