<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];

        if ($this->category === 'transfer') {
            $data = [
                'id'          => $this->id,
                'beneficiary' => $this->beneficiary,
                'service'     => $this->service,
                'bank'        => $this->provider,
                'logo'        => $this->logo,
                'category'    => $this->category,
                'created_at'  => $this->created_at,
                'updated_at'  => $this->updated_at,
            ];
        }

        if ($this->category === 'bills') {
            $data = [
                'id'          => $this->id,
                'beneficiary' => $this->beneficiary,
                'service'     => $this->service,
                'provider'    => $this->provider,
                'logo'        => $this->logo,
                'category'    => $this->category,
                'created_at'  => $this->created_at,
                'updated_at'  => $this->updated_at,
            ];

            if ($this->service === "power") {
                $data['meterNumber'] = $this->recipient;
            } else {
                $data['smartcardNumber'] = $this->recipient;
            }
        }

        if ($this->category === 'airtime/data') {
            $data = [
                'id'          => $this->id,
                'beneficiary' => $this->beneficiary,
                'provider'    => $this->provider,
                'logo'        => $this->logo,
                'phoneNumber' => $this->recipient,
                'category'    => $this->category,
                'created_at'  => $this->created_at,
                'updated_at'  => $this->updated_at,
            ];
        }

        return $data;

    }
}
