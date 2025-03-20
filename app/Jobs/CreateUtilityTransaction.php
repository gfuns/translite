<?php

namespace App\Jobs;

use App\Models\UtilityTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateUtilityTransaction
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        UtilityTransaction::create([
            'user_id' => $this->data['user_id'],
            'service' => $this->data['service'],
            'biller' => $this->data['biller'],
            'recipient' => $this->data['recipient'],
            'amount' => $amount,
            'reference' => $this->data['reference'],
            'status' => $this->data['status'] === '00' ? StatusEnum::SUCCESSFUL->value : StatusEnum::FAILED->value,
        ]);
    }
}
