<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disputes extends Model
{
    use HasFactory, SoftDeletes;

    public function customerUploads()
    {
        return $this->hasMany(CustomerUploads::class, "dispute_id");
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'business_id',
        'deleted_at',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
