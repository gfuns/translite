<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalTransactionResource extends JsonResource
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
            "profit" => $this->profit,
            "gateway" => $this->gateway,
            "gateway_response" => $this->gateway_response,
            "stan" => $this->stan,
            "bank" => $this->bank,
            "masked_pan" => $this->masked_pan,
            "description" => $this->description,
            "status" => $this->status == "initiated" ? "pending" : $this->status,
            "created_at" => $this->created_at,
        ];

        return $data;

    }
}
