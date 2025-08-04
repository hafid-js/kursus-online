<?php

use Illuminate\Support\Str;

return [

    'default' => env('CACHE_DRIVER', 'file'),

   'stores' => [
    'redis' => [
        'driver' => 'redis',
        'connection' => env('CACHE_REDIS_CONNECTION', 'default'),
    ],

    'file' => [
        'driver' => 'file',
        'path' => storage_path('framework/cache/data'),
    ],

    // 'redis' => [
    //     'driver' => 'redis',
    //     'connection' => 'cache',
    //     'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_cache_'),
    // ],

],

'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_') . '_cache_'),

];
