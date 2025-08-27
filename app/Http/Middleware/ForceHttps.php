<?php

namespace App\Http\Middleware;

use Closure;

class ForceHttps
{
    public function handle($request, Closure $next)
    {
        // إذا البروتوكول القادم من Render ليس HTTPS
        if ($request->header('X-Forwarded-Proto') !== 'https') {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
