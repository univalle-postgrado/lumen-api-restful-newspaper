<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CheckAuthorizationHeader
{
    public function handle($request, Closure $next)
    {
        // Verifica si la cabecera Authorization está presente y no está vacía
        if ($request->header('Authorization')) {
            $validSecrets = explode(',', env('ACCEPTED_SECRETS'));
            if (in_array($request->header('Authorization'), $validSecrets)) {
                return $next($request);
            }
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }
}
