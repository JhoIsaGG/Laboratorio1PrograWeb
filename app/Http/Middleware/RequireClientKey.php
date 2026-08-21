<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireClientKey
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $traceId = $request->attributes->get('trace_id');
        $labKey = 'PW2-2026';
        $clientKey = $request->header('X-Lab-Key');
        if (!$clientKey) {
            return response()->json(['error' => 'Es necesaria la clave del cliente'], 401);
        }
        else {
            if ($clientKey !== $labKey) {
                return response()->json(['error' => 'Clave de cliente inválida'], 401);
            }
        }

        logger('RequireClientKey - credencial correcta', [
            'trace_id' => $traceId,
        ]);
        
        return $next($request);
    }
}
