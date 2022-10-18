<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomVerifyMiddleware
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
        if (is_null($request->user()->email_verified_at)) {
            if ($request->user()->getTable() === 'admins') {
                return redirect()->route('admin.verification.notice');
            } else if ($request->user()->getTable() === 'users') {
                return redirect()->route('verification.notice');
            }
        }
        return $next($request);
    }
}
