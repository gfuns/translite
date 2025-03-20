<?php
namespace App\Http\Resources;

use App\Models\CustomerTransactions;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [

            'businessName'       => $this->businessName,
            'bankName'           => $this->bankName,
            'accountNumber'      => $this->accountNumber,
            'accountBalance'     => $this->balance->account_balance,
            'recentTransactions' => CustomerTransactions::orderBy("id", "desc")->where("business_id", $this->id)->limit(10)->get(),

        ];

        return $data;

    }
}
