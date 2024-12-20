<?php

use App\Http\Controllers\Api\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(LinkController::class)->group(function () {
    Route::post('/check-slug', 'checkSlug')->name('api.links.checkSlug');
    Route::post('/encrypt', 'encrypt')->name('api.links.encrypt');
    Route::post('/decrypt', 'decrypt')->name('api.links.decrypt');
});
