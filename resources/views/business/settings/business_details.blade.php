@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Settings / Business Details')
<style type="text/css">
    :disabled {
        cursor: not-allowed !important;
    }
</style>
<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Settings / Business Details</h6>
                        <div class="custom-alert fade show custom-alert-primary">
                            <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                            &nbsp;Your Business is under Review!
                        </div>
                        <div>
                            <div class="row col-12 col-md-7 nopadding forcenopadding">
                                <div class="custombox" style="display: flex; gap: 10px">
                                    <a href="{{ route('business.settings.businessType') }}" class="tabinactive">
                                        <div class="tabtext">Business Type</div>
                                    </a>
                                    <a href="{{ route('business.settings.about') }}" class="tabactive">
                                        <div class="tabtext">Business Details</div>
                                    </a>
                                    <a href="{{ route('business.settings.bizDocuments') }}" class="tabinactive">
                                        <div class="tabtext">KYC Documents</div>
                                    </a>

                                    <a href="{{ route('business.settings.notifSettings') }}" class="tabinactive">
                                        <div class="tabtext">Notifications</div>
                                    </a>

                                    <a href="{{ route('business.settings.bizReps') }}" class="tabinactive">
                                        <div class="tabtext">Representatives</div>
                                    </a>

                                    <a href="{{ route('business.settings.paymentSettings') }}" class="tabinactive">
                                        <div class="tabtext">Payment</div>
                                    </a>
                                </div>
                            </div>


                            <div class="element-content">
                                <div class="row mt-3">
                                    <div class="col-12 col-md-7">
                                        <div class="element-box" style="padding: 0px">
                                            <div class="eb d-flex justify-content-between">
                                                <h5>Business Details! </h5>
                                                <div class="pencil" id="editConfiguration"><i
                                                        class="fas fa-pencil-alt"></i>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="progress-container" style="padding-bottom: 25px">
                                                <form id="formValidate" method="post" action="">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for=""> Business Type</label>
                                                            <select class="form-control" name="businessType" disabled
                                                                data-error="Business type selected is invalid">
                                                                <option>Freelancer</option>
                                                            </select>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for=""> Business Name</label>
                                                            <input name="businessName" class="form-control"
                                                                data-error="Business name provided is invalid"
                                                                placeholder=" Business Name"
                                                                value="Blu Constellation limited" required="required"
                                                                type="text" disabled>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for=""> Business Email</label>
                                                            <input name="businessEmail" class="form-control"
                                                                data-error="Business email provided is invalid"
                                                                placeholder=" Business Email"
                                                                value="hello@blu-constellationltd.com"
                                                                required="required" type="text" readonly>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for=""> Business Website</label>
                                                            <input name="businessWebsite" class="form-control"
                                                                data-error="Business website provided is invalid"
                                                                placeholder=" Business Website"
                                                                value="https://blu-constellationltd.com"
                                                                required="required" type="text" readonly>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for=""> Business Phone Number</label>
                                                        <input name="businessPhone" class="form-control"
                                                            data-error="Business phone number provided is invalid"
                                                            placeholder=" Business Phone Number" value="08188664322"
                                                            required="required" type="text" readonly>
                                                        <div
                                                            class="help-block form-text with-errors form-control-feedback">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for=""> Business Description</label>
                                                        <textarea name="businessDescription" class="form-control" data-error="Business description provided is invalid"
                                                            placeholder=" Business Description" style="resize:none" rows="3" readonly>Information Technology Service Provider</textarea>
                                                        <div
                                                            class="help-block form-text with-errors form-control-feedback">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for=""> Business Address</label>
                                                        <input name="businessAddress" class="form-control"
                                                            data-error="Business address provided is invalid"
                                                            placeholder=" Business Address"
                                                            value="1301 Akin Adesola Street, Victoria Island, Lagos - Nigeria"
                                                            required="required" type="text" readonly>
                                                        <div
                                                            class="help-block form-text with-errors form-control-feedback">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for=""> Business Industry</label>
                                                            <select id="businessIndustry" class="form-control"
                                                                name="businessIndustry" readonly disabled
                                                                data-error="Business industry selected is invalid">
                                                                <option value="Building Services">Building Services
                                                                </option>
                                                                <option value="Digital Products" selected>Digital
                                                                    Products
                                                                </option>
                                                                <option value="Education">Education</option>
                                                                <option value="Entertainment & Recreation">
                                                                    Entertainment &
                                                                    Recreation</option>
                                                                <option value="Financial Services">Financial Services
                                                                </option>
                                                                <option value="Food $ Drinks">Food $ Drinks</option>
                                                                <option value="Medical Services">Medical Services
                                                                </option>
                                                                <option value="Membership Organizations">Membership
                                                                    Organizations</option>
                                                                <option value="Personal Services">Personal Services
                                                                </option>
                                                                <option value="Regulated & Age Restricted Products">
                                                                    Regulated & Age Restricted Products</option>
                                                                <option value="Retail">Retail</option>
                                                                <option value="Transportation">Transportation</option>
                                                                <option value="Hospitality">Hospitality</option>
                                                            </select>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for=""> TIN Number</label>
                                                            <input name="tinNumber" class="form-control"
                                                                data-error="TIN number provided is invalid"
                                                                placeholder="  TIN Number" value="21184933-0001"
                                                                required="required" type="text" readonly>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for=""> Support Email Address</label>
                                                            <input name="supportEmail" class="form-control"
                                                                data-error="Support email address provided is invalid"
                                                                placeholder=" Support Email Address"
                                                                value="help@blu-constellationltd.com"
                                                                required="required" type="text" readonly>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for=""> Support Phone Number</label>
                                                            <input name="supportPhone" class="form-control"
                                                                data-error="Support phone number provided is invalid"
                                                                placeholder=" Support Phone Number" value="0818864322"
                                                                required="required" type="text" readonly>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-12 col-md-4">
                                                            <label for=""> Facebook URL</label>
                                                            <input name="facebookURL" class="form-control"
                                                                data-error="Facebook URL provided is invalid"
                                                                placeholder="  Facebook URL" value=""
                                                                required="required" type="text" readonly>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-md-4">
                                                            <label for=""> Instagram URL</label>
                                                            <input name="instagramURL" class="form-control"
                                                                data-error="Instagram URL provided is invalid"
                                                                placeholder="  Instagram URL" value=""
                                                                required="required" type="text" readonly>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12 col-md-4">
                                                            <label for=""> X(Formerly Twitter) URL</label>
                                                            <input name="xURL" class="form-control"
                                                                data-error="X URL provided is invalid"
                                                                placeholder="  X(Formerly Twitter) URL" value=""
                                                                required="required" type="text" readonly>
                                                            <div
                                                                class="help-block form-text with-errors form-control-feedback">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="buttons" class="form-buttons-w" style="display: none">
                                                        <div class="d-flex justify-content-between">
                                                            <button type="reset" class="btn btn-outline-secondary"
                                                                id="cancelEdit">Cancel</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                style="font-size:12px">Save
                                                                Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </div>


                                    </div>
                                    <div class="col-8 col-md-3 order-first order-md-last" >
                                        <div class="element-box" style="padding: 0px">
                                            <div>
                                                <div class="business-logo">
                                                    <img id="logoPreview" src="{{ asset('noimage.jpeg') }}" class="img-fluid" />
                                                </div>

                                                <div class="logo-btn">
                                                    <button class="btn btn-default" type="button" id="changeLogoBtn">Change Logo</button>
                                                </div>

                                                {{-- <form id="logoUploadForm" action="{{ route('business.logo.change') }}"
                                                    method="POST" enctype="multipart/form-data"
                                                    style="display: none;"> --}}
                                                    @csrf
                                                    <input type="file" id="logoInput" name="logo"
                                                        accept="image/*" style="display: none;">
                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('customjs')
    <script src="{{ asset('js/bizdetails.js') }}?version=4.5.0"></script>

@endsection
