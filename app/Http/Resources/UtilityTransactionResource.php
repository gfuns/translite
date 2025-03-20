<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UtilityTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'        => $this->id,
            'reference' => $this->reference,
            'service'   => $this->service,
            'biller'    => $this->biller,
            'recipient' => $this->recipient,
            'amount'    => $this->amount,
            'status'    => $this->status,

        ];

        if ($this->service === 'Power') {
            $data['meter_token']       = $this->recharge_token;
            $data['units']             = $this->units;
            $data['recipient_address'] = $this->recipient_address;
        }

        if ($this->service === 'Data' || $this->service === 'TV') {
            $data['subscription_plan'] = $this->subscription_plan;
        }

        $data['date'] = $this->created_at;

        return $data;
    }
}
