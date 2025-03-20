<?php
namespace App\Jobs;

use App\Models\Business;
use App\Models\UtilityTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class BankOneDebitCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $trxId;
    /**
     * Create a new job instance.
     */
    public function __construct($trxId)
    {
        $this->trxId = $trxId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Log::info("Bank One Debit Customer Job Invoked.");
        try {
            $transaction = UtilityTransaction::find($this->trxId);
            $business    = Business::find($transaction->business_id);

            $baseURL   = env("BANK_ONE_BASE_URL");
            $GLCode    = env("BANK_ONE_DEBIT_GL");
            $authToken = env("MY_BANK_ONE_AUTH_TOKEN");
            $url       = $baseURL . "/thirdpartyapiservice/apiservice/CoreTransactions/Debit";

            $amount = ($transaction->amount + $transaction->fee);

            $postData = [
                "Amount"             => (100 * $amount),
                "RetrievalReference" => $transaction->reference,
                "AccountNumber"      => $business->accountNumber,
                "Narration"          => "Debiting Customer Account For Bill Purchase",
                "Token"              => $authToken,
                "GLCode"             => $GLCode,
            ];

            $response = Http::post($url, $postData);

            $data = json_decode($response, true);

            if ($response->failed()) {
                \Log::info("Request Failed.");
                \Log::error($data);
            }

            if ($response['ResponseCode'] !== '00') {
                \Log::info("Error Encountered.");
                \Log::error($data);
            } else {
                \Log::info("Request Successful Without Errors.");
                $transaction->bankone_debit_status    = 1;
                $transaction->bankone_debit_reference = $response['Reference'];
                $transaction->save();

                \Log::info($data);

            }

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

    }
}
