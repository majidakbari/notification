<?php

use Illuminate\Support\Facades\Route;

Route::as('api.')->group(function() {
    Route::prefix('/')
        ->as('.')
        ->group(function () {

        });
});
