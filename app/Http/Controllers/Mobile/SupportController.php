<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\CustomerUploads;
use App\Models\IssueTypes;
use App\Models\SupportTickets;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * getSupportCategories
     *
     * @return void
     */
    public function getSupportCategories()
    {
        $supportCategories = IssueTypes::all();
        return ResponseHelper::success($supportCategories);
    }

    /**
     * submitTicket
     *
     * @param Request request
     *
     * @return void
     */
    public function submitTicket(Request $request)
    {
        $validator = $this->validate($request, [
            'category_id' => 'required|numeric',
            'description' => 'required',
            'media.*' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);

        try {

            $issue = IssueTypes::find($request->category_id);

            if (!isset($issue)) {
                return ResponseHelper::error('Something Went Wrong. Invalid Category.');
            }

            if ($request->hasFile('media')) {

                // Check if more than 3 images are uploaded
                if (count($request->file('media')) > 3) {
                    return ResponseHelper::error('You can only upload a maximum of 3 images.');
                }
            }

            DB::beginTransaction();

            $ticket = new SupportTickets;
            $ticket->business_id = Auth::user()->id;
            $ticket->issue = $issue->category;
            $ticket->description = $request->description;
            $ticket->save();

            if ($request->hasFile('media')) {
                // Loop through each image and store it
                foreach ($request->file('media') as $image) {

                    $media = new CustomerUploads;
                    $media->business_id = Auth::user()->id;
                    $media->support_ticket_id = $ticket->id;
                    $media->tracker = "support";
                    $media->media = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    $media->save();
                }
            }

            DB::commit();

            $supportTicket = SupportTickets::with(['customerUploads'])->find($ticket->id);
            return ResponseHelper::success($supportTicket);

        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return ResponseHelper::error('Something Went Wrong. Please Try Again.' . $e->getMessage());
        }
    }

    /**
     * viewTickets
     *
     * @return void
     */
    public function viewTickets()
    {
        $customerTickets = SupportTickets::orderBy("id", "desc")->where("business_id", Auth::user()->id)->get();
        $data = TicketResource::collection($customerTickets);
        return ResponseHelper::success($data);
    }
}
