<?php

define('LARAVEL_START', microtime(true));

// Composer autoload
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// Buat Kernel HTTP
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Tangkap request
$request = Illuminate\Http\Request::capture();

// Jalankan request dan kirim response
$response = $kernel->handle($request);
$response->send();

// Terminate kernel
$kernel->terminate($request, $response);
