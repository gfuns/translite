<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'              => $this->id,
            'agentId'         => $this->agentId,
            'agentFirstName'  => $this->agentFirstName,
            'agentLastName'   => $this->agentLastName,
            'agentOtherNames' => $this->agentOtherNames,
            'agentEmail'      => $this->email,
            'agentPhoneNo'    => $this->agentPhoneNumber,
            'businessDetails' => [
                'businessName'    => $this->businessName,
                'businessAddress' => $this->businessAddress,
                'bankName'        => $this->bankName,
                'accountNumber'   => $this->accountNumber,
                'terminal'        => [
                    "id"              => $this->terminal->id,
                    "terminal_id"     => $this->terminal->terminal_id,
                    "serial_number"   => $this->terminal->serial_number,
                    "model"           => $this->terminal->model,
                    "ip"              => $this->terminal->ip,
                    "port"            => $this->terminal->port,
                    "notification_ip" => $this->terminal->notification_ip,
                ],
            ],
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];

        return $data;

    }
}
