<?php

use App\Http\Controllers\Api\V1\PiecesOfAdvicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/logs', function () {
    Log::error('Wait... This is huge');
    Log::error('Wait... This is huge');
    Log::error('Wait... This is huge');
    Log::error('Wait... This is huge');
    Log::error('Wait... This is huge');
    Log::error('Wait... This is huge');
    Log::error('Wait... This is huge');

    return response()
        ->json(
            [
                "message" => "success from logs"
            ]
        );
});
