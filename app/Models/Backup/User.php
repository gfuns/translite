<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userRole()
    {
        return $this->belongsTo('App\Models\UserRole', 'role_id');
    }

    public function accountType()
    {
        return $this->belongsTo('App\Models\AccountType', 'account_type_id');
    }

    public function kyc()
    {
        return $this->hasOne('App\Models\CustomerKyc', 'user_id');
    }

    public function fee()
    {
        return $this->hasOne('App\Models\CustomFeeConfig', 'user_id');
    }

    public function business()
    {
        return $this->hasMany('App\Models\Business', 'user_id');
    }
}
