<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// General API routes
Route::get('/welcome', function () {
    return response()
        ->json(
            [
                "message" => "success"
            ]
        );
});
