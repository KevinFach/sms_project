<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Obtener el token del header (usaremos 'X-API-TOKEN')
        $token = $request->header('X-API-TOKEN');
        
        // 2. Obtener el token esperado de la configuración
        $expectedToken = env('MESSAGE_API_TOKEN');

        // 3. Comprobar si el token existe y si coincide
        if (!$token || $token !== $expectedToken) {
            // Devolver un error 401 (No autorizado) si falla la verificación
            return response()->json([
                'error' => 'Acceso no autorizado. Token API inválido o faltante.'
            ], 401);
        }

        return $next($request);
    }
}
