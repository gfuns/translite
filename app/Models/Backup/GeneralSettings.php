<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;

    public static function scopeAppMobile($query)
    {
        return $query->where("setting", "app_mobile_key")->first();
    }

    public static function scopeAccessKey($query)
    {
        return $query->where("setting", "access_key")->first();
    }
}
