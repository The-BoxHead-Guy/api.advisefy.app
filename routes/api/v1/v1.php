<?php

use App\Http\Controllers\Api\V1\PiecesOfAdvicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('pieces-of-advices', PiecesOfAdvicesController::class);
