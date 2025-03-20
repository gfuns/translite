<?php
namespace App\Http\Controllers\Mobile;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\CustomerTransactions;
use Auth;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EODController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * endOfDay
     *
     * @param Request request
     *
     * @return void
     */
    public function endOfDay(Request $request)
    {
        if (isset($request->date)) {
            $date    = date('Y-m-d', strtotime($request->date));
            $trxDate = new DateTime($date);
        } else {
            $date    = date('Y-m-d', strtotime(now()));
            $trxDate = new DateTime($date);
        }

        if (isset($request->category) && $request->category != "all") {
            $category = $request->category;
            $trxCount = CustomerTransactions::whereDate("created_at", $trxDate)->where("classification", "category")->count();
            $trxValue = CustomerTransactions::whereDate("created_at", $trxDate)->where("classification", "category")->where("status", "successful")->sum("amount");

            $byStatus = [
                "totalApproved" => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("classification", "category")->where("status", "successful")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("classification", "category")->where("status", "successful")->sum("amount"),
                ],
                "totalFailed"   => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("classification", "category")->where("status", "failed")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("classification", "category")->where("status", "failed")->sum("amount"),
                ],
            ];

            $byTrxType = [
                "cardWithdrawal"    => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "pos")->where("classification", "category")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "pos")->where("classification", "category")->where("status", "successful")->sum("amount"),
                ],
                "outwardTransfers"  => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "outward")->where("classification", "category")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "outward")->where("classification", "category")->where("status", "successful")->sum("amount"),
                ],
                "receivedTransfers" => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "inward")->where("classification", "category")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "inward")->where("classification", "category")->where("status", "successful")->sum("amount"),
                ],
                "tvSubscription"    => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "tv")->where("classification", "category")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "tv")->where("classification", "category")->where("status", "successful")->sum("amount"),
                ],
                "electricity"       => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "power")->where("classification", "category")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "power")->where("classification", "category")->where("status", "successful")->sum("amount"),
                ],
                "airtime/data"      => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->whereIn("category", ["airtime", "data"])->where("classification", "category")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->whereIn("category", ["airtime", "data"])->where("classification", "category")->where("status", "successful")->sum("amount"),
                ],
                "balanceInquiry"    => [
                    "trxCount" => 0,
                    "trxValue" => 0,
                ],
            ];

        } else {
            $category = "all";
            $trxCount = CustomerTransactions::whereDate("created_at", $trxDate)->count();
            $trxValue = CustomerTransactions::whereDate("created_at", $trxDate)->where("status", "successful")->sum("amount");

            $byStatus = [
                "totalApproved" => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("status", "successful")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("status", "successful")->sum("amount"),
                ],
                "totalFailed"   => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("status", "failed")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("status", "failed")->sum("amount"),
                ],
            ];

            $byTrxType = [
                "cardWithdrawal"    => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "pos")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "pos")->where("status", "successful")->sum("amount"),
                ],
                "outwardTransfers"  => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "outward")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "outward")->where("status", "successful")->sum("amount"),
                ],
                "receivedTransfers" => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "inward")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "inward")->where("status", "successful")->sum("amount"),
                ],
                "tvSubscription"    => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "tv")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "tv")->where("status", "successful")->sum("amount"),
                ],
                "electricity"       => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "power")->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->where("category", "power")->where("status", "successful")->sum("amount"),
                ],
                "airtime/data"      => [
                    "trxCount" => CustomerTransactions::whereDate("created_at", $trxDate)->whereIn("category", ["airtime", "data"])->count(),
                    "trxValue" => CustomerTransactions::whereDate("created_at", $trxDate)->whereIn("category", ["airtime", "data"])->where("status", "successful")->sum("amount"),
                ],
                "balanceInquiry"    => [
                    "trxCount" => 0,
                    "trxValue" => 0,
                ],
            ];
        }

        $data = [
            "trxDate"     => $date,
            "trxCategory" => $category,
            "trxCount"    => $trxCount,
            "trxValue"    => $trxValue,
            "byStatus"    => $byStatus,
            "byTrxType"   => $byTrxType,
        ];
        return ResponseHelper::success($data);
    }

    public function emailEndOfDay(Request $request)
    {
        return new JsonResponse(['response' => [
            'statusCode' => (int) 200,
            'status'     => "Successful",
            'message'    => "End Of Day Email Sent Successfully",
        ]]);
    }
}
