<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;
use App\Http\Middleware\TraceRequest;
use App\Http\Middleware\MeasureResponseTime;
use App\Http\Middleware\RequireClientKey;

Route::get('/academic/courses', [
    AcademicController::class,
    'courses'
])->middleware([
    MeasureResponseTime::class,
    TraceRequest::class,
    RequireClientKey::class,
]);