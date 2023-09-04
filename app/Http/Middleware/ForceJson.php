<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class ForceJson
{
    public function handle(Request $request, Closure $next): mixed
    {
        $request->headers->set(
            key: 'Accept',
            values: 'application/json'
        );

        return $next($request);
    }
}
