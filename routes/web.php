<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicController;
use App\Http\Middleware\TraceRequest;
use App\Http\Middleware\RequireClientKey;
use App\Http\Middleware\MeasureResponseTime;

Route::get('/academic/courses', [
    AcademicController::class,
    'courses'
])->middleware([
    TraceRequest::class,
    RequireClientKey::class,
    MeasureResponseTime::class,
]);