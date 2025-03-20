<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserPermissions;

class PermissionController extends Controller
{
    public static function allowAccess($role, $feature)
    {
        if ($role == 1) {
            return true;
        }

        $result     = false;
        $permission = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        if (isset($permission)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public static function canCreate($role, $feature)
    {
        if ($role == 1) {
            return true;
        }

        $result     = false;
        $permission = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        if ($permission->can_create == 1) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public static function canEdit($role, $feature)
    {
        if ($role == 1) {
            return true;
        }

        $result     = false;
        $permission = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        if ($permission->can_edit == 1) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public static function canDelete($role, $feature)
    {
        if ($role == 1) {
            return true;
        }

        $result     = false;
        $permission = UserPermissions::where("role_id", $role)->where("feature_id", $feature)->first();
        if ($permission->can_delete == 1) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
