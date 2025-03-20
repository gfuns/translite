<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosWithdrawals extends Model
{
    use HasFactory;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'business_id',
        'terminal_id',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
