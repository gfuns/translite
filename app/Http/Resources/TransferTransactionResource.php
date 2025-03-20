<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            "id" => $this->id,
            "reference" => $this->reference,
            "terminal_model" => $this->terminal_model,
            "terminal_id" => $this->tid,
            "terminal_serial_number" => $this->terminal_sno,
            "amount" => $this->amount,
            "fee" => $this->fee,
            "total" => $this->total,
            "sender_name" => $this->sender_name,
            "sender_bank" => $this->sender_bank,
            "sender_account" => $this->sender_account,
            "receiver_name" => $this->receiver_name,
            "receiver_bank" => $this->receiver_bank,
            "receiver_account" => $this->receiver_account,
            "description" => $this->description,
            "status" => $this->status,
            "created_at" => $this->created_at,
        ];

        return $data;

    }
}
