<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PiecesOfAdvicesController;

Route::apiResource('pieces-of-advices', PiecesOfAdvicesController::class);
