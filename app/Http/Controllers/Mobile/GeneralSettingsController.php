<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use Auth;
use Illuminate\Http\JsonResponse;

class GeneralSettingsController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * Get Application Key
     *
     *
     * @return JsonResponse
     */
    public function getApplicationKey()
    {
        return new JsonResponse([
            'authorization_key' => GeneralSettings::appMobile()->setting_value,
        ], 200);
    }
}
