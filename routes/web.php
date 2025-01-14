<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

Route::get('/test-log', function () {
    Log::info('Testing Laravel logs with Herd');
    return response()->json(['message' => 'Log tested']);
});

Route::get('/debug-storage', function () {
    return response()->json([
        'local_disk_path' => storage_path('app/private'),
    ]);
});

Route::get('/', IndexController::class)->name('index');

Route::controller(LinkController::class)->group(function () {
    Route::post('/links', 'store')->name('links.store');
    Route::get('/{slug}', 'redirect')->name('links.redirect');
    Route::delete('/links/{link}', 'destroy')->name('links.destroy');
});

require __DIR__.'/auth.php';
