<?php

use App\Http\Controllers\SendNotificationController;
use Illuminate\Support\Facades\Route;

Route::as('api.')->group(function() {
    Route::prefix('/notification')
        ->as('notification.')
        ->group(function () {
            Route::post('/', SendNotificationController::class)->name('send');
        });
});
