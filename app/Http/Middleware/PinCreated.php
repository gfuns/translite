<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PinCreated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (isset(Auth::user()->pin)) {
            return $next($request);
        } else {
            return ResponseHelper::error('Please Create Transaction PIN');
        }
    }
}
