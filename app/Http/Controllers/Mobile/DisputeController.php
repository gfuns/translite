<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\DisputeResource;
use App\Models\CustomerUploads;
use App\Models\Disputes;
use Auth;
use Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisputeController extends Controller
{
    public function __construct()
    {
        Auth::shouldUse('api');
    }

    /**
     * initateDispute
     *
     * @param Request request
     *
     * @return void
     */
    public function initateDispute(Request $request)
    {
        $validator = $this->validate($request, [
            'reference' => 'required',
            'description' => 'required',
            'media.*' => 'image|mimes:jpeg,png,jpg|max:1024',
        ]);

        try {
            if ($request->hasFile('media')) {

                // Check if more than 3 images are uploaded
                if (count($request->file('media')) > 3) {
                    return ResponseHelper::error('You can only upload a maximum of 3 images.');
                }
            }

            DB::beginTransaction();

            $dispute = new Disputes;
            $dispute->business_id = Auth::user()->id;
            $dispute->reference = $request->reference;
            $dispute->description = $request->description;
            $dispute->save();

            if ($request->hasFile('media')) {
                // Loop through each image and store it
                foreach ($request->file('media') as $image) {

                    $media = new CustomerUploads;
                    $media->business_id = Auth::user()->id;
                    $media->dispute_id = $dispute->id;
                    $media->tracker = "dispute";
                    $media->media = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    $media->save();
                }
            }

            DB::commit();

            $customerDispute = Disputes::with(['customerUploads'])->find($dispute->id);
            return ResponseHelper::success($customerDispute);

        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return ResponseHelper::error('Something Went Wrong. Please Try Again.');
        }
    }

    /**
     * history
     *
     * @return void
     */
    public function history()
    {
        $customerDisputes = Disputes::orderBy("id", "desc")->where("business_id", Auth::user()->id)->get();
        $data = DisputeResource::collection($customerDisputes);
        return ResponseHelper::success($data);
    }
}
