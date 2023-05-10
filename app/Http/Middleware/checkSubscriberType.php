<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkSubscriberType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        info($user);
        if ($user && $user->type === 'subscriber') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
