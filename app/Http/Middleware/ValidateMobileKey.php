<?php

namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\Models\GeneralSettings;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateMobileKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('XGM-KEY') == null) {

            return ResponseHelper::error('Please Provide Application Key', 412);

        } elseif ($request->header('XGM-KEY') != GeneralSettings::appMobile()->setting_value) {

            return ResponseHelper::error('Invalid Authorization Key', 412);

        } else {
            if (Auth::check()) {
                if (Auth::user()->status == "suspended") {
                    return ResponseHelper::error('This account has been suspended', 403);

                } elseif (Auth::user()->status == "banned") {

                    return ResponseHelper::error('This account has been banned', 403);

                } elseif (Auth::user()->status == "deleted") {
                    return ResponseHelper::error('We could not find a user with these credentials on our records', 404);
                }
            }

            return $next($request);
        }
    }
}
