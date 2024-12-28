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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//
//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
