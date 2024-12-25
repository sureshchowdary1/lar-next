<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/{any}', function () { 
//     return view('welcome');
// })->where('any', '.*');

use Illuminate\Support\Facades\Cache;

// Route::get('/{any?}', function ($file = null) {
//     if (!$file) {
//         // If no file is provided, serve the default index.html or handle differently
//         return response()->view('welcome'); // or any default view you want to show
//     }
//     $clientDir = base_path('client'); // Path to the client folder
//     $path = $clientDir . '/' . $file . '/index.html';
//     $fileContent = Cache::remember("file_content:{$file}", 60, function () use ($path) {
//         if (!File::exists($path)) {
//             abort(404);
//         }
//         return File::get($path);
//     });

//     $mimeType = Cache::remember("file_mime:{$file}", 60, function () use ($path) {
//         return File::mimeType($path);
//     });

//     return response($fileContent, 200)->header('Content-Type', $mimeType);
// })->where('any', '.*');

Route::get('/{any?}', function ($file = null) {
    $clientDir = public_path('client'); // Path to the client build folder
    $indexFilePath = $clientDir. '/' . $file  . '/index.html';

    if (!File::exists($indexFilePath)) {
        abort(404, 'Index file not found');
    }


    return response(File::get($indexFilePath), 200)
        ->header('Content-Type', 'text/html');
})->where('any', '.*');