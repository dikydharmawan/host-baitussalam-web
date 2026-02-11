<?php
// Mengarahkan ke vendor dan bootstrap yang ada di root
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Bind Public Path
|--------------------------------------------------------------------------
|
| Bind the public path to use the directory above "api".
|
*/
$app->bind('path.public', function() {
    return __DIR__ . '/../public';
});

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);