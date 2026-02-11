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

// DEBUG: List files to check directory structure
if (isset($_GET['debug_files'])) {
    header('Content-Type: text/plain');
    echo "Current Directory (__DIR__): " . __DIR__ . "\n";
    echo "Parent Directory: " . realpath(__DIR__ . '/..') . "\n";
    
    $publicPath = realpath(__DIR__ . '/../public');
    echo "Public Path: " . $publicPath . "\n";
    
    if ($publicPath && is_dir($publicPath)) {
        echo "\nContents of public:\n";
        print_r(scandir($publicPath));
        
        $buildPath = $publicPath . '/build';
        if (is_dir($buildPath)) {
            echo "\nContents of public/build:\n";
            print_r(scandir($buildPath));
        } else {
            echo "\npublic/build does NOT exist.\n";
        }
    } else {
        echo "\npublic directory does NOT exist at expected path.\n";
    }
    
    // Check root directory contents
    echo "\nContents of Parent (Root):\n";
    print_r(scandir(__DIR__ . '/..'));
    exit;
}

$app->bind('path.public', function() {
    return __DIR__ . '/../public';
});

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);