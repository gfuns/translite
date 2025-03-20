<?php
namespace App\Http\Middleware;

use App\Helpers\ResponseHelper;
use App\Models\GeneralSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('AccessKey') == null) {

            return ResponseHelper::error('Please Provide Access Key', 412);

        } elseif ($request->header('AccessKey') != GeneralSettings::accessKey()->setting_value) {

            return ResponseHelper::error('Invalid Access Key', 412);

        }

        return $next($request);
    }
}
