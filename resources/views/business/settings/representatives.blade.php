@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Settings / Representatives')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">Settings / Representatives </h6>
                <div class="custom-alert fade show custom-alert-primary">
                    <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                    &nbsp;Your Business is under Review!
                </div>
                <div class="container nopadding">
                    <div class="row align-items-center">
                        <!-- All elements in a single row on desktop but stacked on mobile -->
                        <div
                            class="col-12 d-md-flex justify-content-between align-items-center flex-wrap gap-3 nopadding">

                            <div class="custombox" style="display: flex; gap: 10px">
                                <a href="{{ route('business.settings.businessType') }}" class="tabinactive">
                                    <div class="tabtext">Business Type</div>
                                </a>
                                <a href="{{ route('business.settings.about') }}" class="tabinactive">
                                    <div class="tabtext">Business Details</div>
                                </a>
                                <a href="{{ route('business.settings.bizDocuments') }}" class="tabinactive">
                                    <div class="tabtext">KYC Documents</div>
                                </a>

                                <a href="{{ route('business.settings.notifSettings') }}" class="tabinactive">
                                    <div class="tabtext">Notifications</div>
                                </a>

                                <a href="{{ route('business.settings.bizReps') }}" class="tabactive">
                                    <div class="tabtext">Representatives</div>
                                </a>

                                <a href="{{ route('business.settings.paymentSettings') }}" class="tabinactive">
                                    <div class="tabtext">Payment</div>
                                </a>
                            </div>


                            <!-- Right: Dropdowns and Filter (Will stack on mobile) -->
                            <div class="d-flex flex-wrap gap-3">


                                <!-- Filter Button -->
                                <div class="custombox" style="margin-right: 10px" data-toggle="modal"
                                    data-target="#addRep" data-backdrop="static" data-keyboard="false">
                                    <span class="atext">
                                        <i class="far fa-plus-square" style="font-size: 12px"></i> Add Representative
                                    </span>&nbsp;

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="element-box" style="padding: 1px">
                    <div class="table-responsive">
                        <table id="" width="100%" class="table table-striped table-lightfont">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>BVN</th>
                                    <th>Date of Birth</th>
                                    <th>Full Name</th>
                                    <th>Designation</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Identity</th>
                                    <th>Photo</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white">
                                    <td colspan="8">
                                        <div class="text-center rounded pdt-5x pdb-5x">
                                            <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No
                                                Representative Information Found!
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div aria-hidden="true" aria-labelledby="addRep" class="modal fade" id="addRep" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add new business representative
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true"> &times;</span>
                </button>
            </div>
            <form method="post" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Bank Verification Number (BVN)</label>
                                <input type="text" name="BVN" value=""
                                    placeholder="Bank Verification Number" class="form-control" required />

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Designation</label>
                                <select id="designation" name="currency" required>
                                    <option value="">Select Designation</option>
                                    <option value="Business Owner">Business Owner</option>
                                    <option value="Authorized Signatory">Authorized Signatory</option>
                                    <option value="Director">Director</option>
                                    <option value="Director & Shareholder">Director & Shareholder</option>
                                    <option value="Shareholder">Shareholder</option>
                                    <option value="Member">Member</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Verification Document</label>
                                <select id="veridoc" name="bank" required>
                                    <option value="">Select Document Type</option>
                                    <option value="Driver License">Driver License</option>
                                    <option value="Permanent Voter Card (PVC)">Permanent Voter Card (PVC)</option>
                                    <option value="National Identity Card">National Identity Card</option>
                                    <option value="International Passport">International Passport</option>
                                    <option value="Birth Certificate">Birth Certificate</option>
                                    <option value="Resident Permit">Resident Permit</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Upload <span id="seldoc"></span></label>
                                <div class="file-upload-container">
                                    <label class="file-upload">
                                        <span class="upload-btn"><i class="fa fa-upload"></i> Upload</span>
                                        <input type="file" name="verification_document" hidden
                                            onchange="displayFileName(this)">
                                        <span class="upload-text">Click to upload</span>
                                    </label>
                                </div>
                                {{--
                                <input type="file" name="account_number" value="" placeholder="Upload Document"
                                    class="form-control" required /> --}}

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Passport Photograph</label>
                                <div class="file-upload-container">
                                    <label class="file-upload">
                                        <span class="upload-btn"><i class="fa fa-upload"></i> Upload</span>
                                        <input type="file" name="passport" hidden
                                            onchange="displayFileName(this)">
                                        <span class="upload-text">Click to upload</span>
                                    </label>
                                </div>

                                {{-- <input type="file" name="passport" value="" placeholder="Upload Passport"
                                    class="form-control" required /> --}}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit" style="font-size:12px">Add Representative</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

