<?php

use App\Http\Controllers\Api\LinkController;
use Illuminate\Support\Facades\Route;

Route::controller(LinkController::class)->group(function () {
    Route::post('/encrypt', 'encrypt')->name('api.links.encrypt');
});
