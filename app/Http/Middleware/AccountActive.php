<?php
namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->status == "active") {
            return $next($request);
        } else {
            auth()->logout();
            return redirect()
                ->back()
                ->withErrors([
                    'email' => 'Your account is inactive. Please contact support.',
                ]);
        }
    }
}
