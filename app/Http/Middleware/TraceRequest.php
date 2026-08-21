<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TraceRequest
{
    public function handle(Request $request, Closure $next): Response
    {

        $traceId = (string) Str::uuid();
        

        logger('TraceRequest - INICIO', [
            'trace_id' => $traceId,
            'method' => $request->method(),
            'url' => $request->fullUrl(),
        ]);

        $response = $next($request);

        logger('TraceRequest - FIN', [
            'trace_id' => $traceId,
            'status' => $response->getStatusCode(),
        ]);

        $response->headers->set('X-Trace-Id', $traceId);

        return $response;
    }
}