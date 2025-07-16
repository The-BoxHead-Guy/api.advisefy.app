<?php

use App\Http\Controllers\Api\V1\PiecesOfAdvicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/logs', function () {
    $logger = new class {
        use \App\Traits\Logger;
    };

    $logger->logEmergency('This is an emergency log');
    $logger->logAlert('This is an alert log');
    $logger->logError('This is an error log');
    $logger->logWarning('This is a warning log');
    $logger->logNotice('This is a notice log');
    $logger->logInfo('This is an info log');
    $logger->logDebug('This is a debug log');
    $logger->logCritical('This is a critical log');

    return response()
        ->json(
            [
                "message" => "success from logs"
            ]
        );
});
