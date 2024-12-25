<?php

// Get the NEXTJS_BUILD_DIR from the environment
$nextJsBuildDir = getenv('NEXTJS_BUILD_DIR') ?: 'client';  // Default to 'public/client' if not set

$requestUri = $_SERVER['REQUEST_URI'];

// Check if the request is for the Next.js app (e.g., "/my-laravel-app/public/client")
// if (preg_match('/^\/my-laravel-app\/public\/(.*)$/', $requestUri, $matches)) {
//     // Remove "/my-laravel-app/public" from the URI to get the relative path for Next.js
//     $relativePath = $matches[1];

//     // Build the file path dynamically using the NEXTJS_BUILD_DIR from the environment
//     $filePath = __DIR__ . '/' . $nextJsBuildDir . '/' . $relativePath;
// echo(file_exists($filePath));    // If the requested file exists, serve it directly
//     if (file_exists($filePath)) {
//         return false; // Let PHP serve the file directly
//     }

//     // If it's not a specific file, serve the Next.js index.html to handle client-side routing
//     include __DIR__ . '/' . $nextJsBuildDir . '/index.html';
//     exit;
// }

// If not a Next.js request, continue serving Laravel
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);
