<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait AgentIdTrait
{
    protected static function bootAgentIdTrait()
    {
        static::creating(function ($model) {
            $model->agentId = "PMFB-" . strtoupper(Str::random(10));
        });
    }
}
