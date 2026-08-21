<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeasureResponseTime
{
    public function handle(Request $request, Closure $next): Response
    {
        $traceId = $request->attributes->get('trace_id');
        $start = microtime(true);

        logger('MeasureResponseTime - INICIO', [
            'trace_id' => $traceId,
        ]);

        $response = $next($request);

        $time = round((microtime(true) - $start) * 1000, 2);

        logger('MeasureResponseTime - FIN', [
            'trace_id' => $traceId,
            'response_time_ms' => $time,
        ]);

        $response->headers->set('X-Response-Time', $time . ' ms');

        return $response;
    }
}