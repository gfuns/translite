<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserRole extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public function permissions()
    {
        return $this->hasMany('App\Models\UserPermissions', 'role_id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'role_id');
    }

    public function totalPermissions()
    {
        $totalPermissions = PlatformFeatures::count();
        return $totalPermissions;
    }

    public function featurePermission($feature)
    {
        $permission = UserPermissions::where("role_id", $this->id)->where("feature_id", $feature)->first();
        if (isset($permission)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function createPermission($feature)
    {
        $permission = UserPermissions::where("role_id", $this->id)->where("feature_id", $feature)->first();
        return $permission->can_create;
    }

    public function EditPermission($feature)
    {
        $permission = UserPermissions::where("role_id", $this->id)->where("feature_id", $feature)->first();
        return $permission->can_edit;
    }

    public function DeletePermission($feature)
    {
        $permission = UserPermissions::where("role_id", $this->id)->where("feature_id", $feature)->first();
        return $permission->can_delete;
    }
}
