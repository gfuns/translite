<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $service = $this->getService($this->service, $this->category);
        return [
            // Transaction Fee Record
            [
                //'id'         => $this->id . '_fee', // Use a string or unique format to avoid duplicate IDs
                'transaction' => $service,
                'reference'   => $this->reference,
                'narration'   => "Transaction Fee For {$this->transaction}",
                'amount'      => $this->trx_fee,
                'status'      => $this->status,
                'created_at'  => $this->created_at,
                'updated_at'  => $this->updated_at,
            ],
            // Transaction Amount Record
            [
                //'id'         => $this->id,
                'transaction' => $service,
                'reference'   => $this->reference,
                'narration'   => $this->transaction,
                'amount'      => $this->amount,
                'status'      => $this->status, // Adjust if needed
                'created_at'  => $this->created_at,
                'updated_at'  => $this->updated_at,
            ],

        ];
    }

    public static function getService($service, $category)
    {
        if ($service == "airtime") {
            return "Airtime Purchase";
        } else if ($service == "power") {
            return "Power Purchase";
        } else if ($service == "data") {
            return "Data Subscription Purchase";
        } else if ($service == "tv") {
            return "TV Subscription Purchase";
        } else if ($service == "transfer" && $category == "inward") {
            return "Incoming Transfer";
        } else if ($service == "transfer" && $category == "outward") {
            return "Outward Transfer";
        } else if ($service == "withdrawal") {
            return "POS Withdrawal";
        }
    }
}
