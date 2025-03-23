@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Settings / Business Documents')
<style type="text/css">
   .upload-box input[type="file"]:disabled {
        cursor: not-allowed;
        opacity: 0.5;
        /* Optional: Make it look visually disabled */
    }

    /* If radio button is inside a label, apply it to the label */
    .upload-box:has(input[type="file"]:disabled) {
        cursor: not-allowed;
    }
</style>
<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Settings / Business Documents</h6>
                        <div
                            class="custom-alert fade show custom-alert-warning d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <span class="os-icon os-icon-alert-circle custom-alert-text"
                                    style="font-weight:bold;"></span>
                                &nbsp;<span class="custom-alert-text">Activate your business to start receiving payments
                                    with TransLite!</span>
                            </div>

                            <div>
                                <a href="{{ route('business.kyc.apply') }}"> <button
                                        class="btn btn-default custom-alert-button"
                                        style="font-size: 12px">Activate</button></a>
                            </div>
                        </div>
                        <div class="element-content">

                            <div class="row mt-3">
                                <div class="col-12 col-md-7 nopadding">
                                    <div>
                                        <div class="custombox" style="display: flex; gap: 10px">
                                            <a href="{{ route('business.settings.businessType') }}" class="tabinactive">
                                                <div class="tabtext">Business Type</div>
                                            </a>
                                            <a href="{{ route('business.settings.about') }}" class="tabinactive">
                                                <div class="tabtext">Business Details</div>
                                            </a>
                                            <a href="{{ route('business.settings.bizDocuments') }}" class="tabactive">
                                                <div class="tabtext">KYC Documents</div>
                                            </a>

                                            <a href="{{ route('business.settings.notifSettings') }}"
                                                class="tabinactive">
                                                <div class="tabtext">Notifications</div>
                                            </a>

                                            <a href="{{ route('business.settings.bizReps') }}" class="tabinactive">
                                                <div class="tabtext">Representatives</div>
                                            </a>

                                            <a href="{{ route('business.settings.paymentSettings') }}"
                                                class="tabinactive">
                                                <div class="tabtext">Payment</div>
                                            </a>
                                        </div>
                                    </div>


                                    <div class="element-box" style="padding: 0px">
                                        <div class="eb d-flex justify-content-between">
                                            <h5>Business Documents! </h5>
                                            <div class="pencil" id="editSettings"><i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="progress-container" style="padding-bottom: 25px">
                                            <form id="formValidate" method="post" action="">
                                                @csrf

                                                <div class="row">
                                                    <!-- Proof of Address -->
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <label class="title-bold">Proof of Address</label>
                                                        <div id="proofOfAddressPreview" class="uploaded-file d-none disabled">
                                                            <div>
                                                                <img src="https://cdn-icons-png.flaticon.com/512/136/136524.png"
                                                                    alt="File">
                                                            </div>
                                                            <div style="min-width: 170px">
                                                                <span id="proofOfAddressFilename"
                                                                    class="previewfname"></span>
                                                                <span id="proofOfAddressSize"
                                                                    class="previewfsize"></span>
                                                            </div>
                                                            <div style="min-width: 50px">
                                                                <a href="#" class="text-info justify-content-end"
                                                                    style="margin-right: 10px; font-size: 14px"><i
                                                                        class="fas fa-eye"></i></a>
                                                                <a href="#"
                                                                    class="text-danger justify-content-end"><i
                                                                        class="fas fa-trash"
                                                                        style="margin-right: 7px; font-size: 14px;"></i></a>
                                                            </div>
                                                        </div>
                                                        <div id="proofOfAddressUpload" class="upload-box"
                                                            style="display: flex; gap: 10px; ">

                                                            <div>
                                                                <svg width="46" height="46" viewBox="0 0 46 46"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="3" y="3" width="40" height="40"
                                                                        rx="20" fill="#F2F4F7"></rect>
                                                                    <g clip-path="url(#clip0_17884_342965)">
                                                                        <path
                                                                            d="M26.3326 26.3352L22.9992 23.0019M22.9992 23.0019L19.6659 26.3352M22.9992 23.0019V30.5019M29.9909 28.3269C30.8037 27.8838 31.4458 27.1826 31.8158 26.334C32.1858 25.4855 32.2627 24.5379 32.0344 23.6408C31.8061 22.7436 31.2855 21.9481 30.5548 21.3797C29.8241 20.8113 28.925 20.5025 27.9992 20.5019H26.9492C26.697 19.5262 26.2269 18.6205 25.5742 17.8527C24.9215 17.0849 24.1033 16.4751 23.181 16.069C22.2587 15.663 21.2564 15.4713 20.2493 15.5084C19.2423 15.5455 18.2568 15.8104 17.3669 16.2832C16.477 16.7561 15.7058 17.4244 15.1114 18.2382C14.517 19.0519 14.1148 19.9898 13.9351 20.9814C13.7553 21.9729 13.8027 22.9923 14.0736 23.9629C14.3445 24.9335 14.8319 25.8301 15.4992 26.5852"
                                                                            stroke="#0765FF" stroke-width="1.66667"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                    </g>
                                                                    <rect x="3" y="3" width="40" height="40"
                                                                        rx="20" stroke="#F9FAFB"
                                                                        stroke-width="6">
                                                                    </rect>
                                                                    <defs>
                                                                        <clipPath id="clip0_17884_342965">
                                                                            <rect width="20" height="20"
                                                                                fill="white"
                                                                                transform="translate(13 13)">
                                                                            </rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </div>
                                                            <div>
                                                                <span class="instruct">Click here to upload
                                                                    files</span>
                                                                <br> or drag and drop your file
                                                                <input type="file" id="proofOfAddressInput" hidden disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Statement of Account (Optional) -->
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <label class="title-bold">Statement of Account <span
                                                                class="warning-text">(optional)</span></label>
                                                        <div id="statementOfAccountPreview"
                                                            class="uploaded-file d-none disabled">
                                                            <div>
                                                                <img src="https://cdn-icons-png.flaticon.com/512/136/136524.png"
                                                                    alt="File">
                                                            </div>
                                                            <div style="min-width: 170px">
                                                                <span id="statementOfAccountFilename"
                                                                    class="previewfname"></span>
                                                                <span id="statementOfAccountSize"
                                                                    class="previewfsize"></span>
                                                            </div>
                                                            <div style="min-width: 50px">
                                                                <a href="#"
                                                                    class="text-info justify-content-end"
                                                                    style="margin-right: 10px; font-size: 14px"><i
                                                                        class="fas fa-eye"></i></a>
                                                                <a href="#"
                                                                    class="text-danger justify-content-end"><i
                                                                        class="fas fa-trash"
                                                                        style="margin-right: 7px; font-size: 14px;"></i></a>
                                                            </div>
                                                        </div>
                                                        <div id="statementOfAccountUpload" class="upload-box"
                                                            style="display: flex; gap: 10px; ">
                                                            <div>
                                                                <svg width="46" height="46"
                                                                    viewBox="0 0 46 46" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="3" y="3" width="40" height="40"
                                                                        rx="20" fill="#F2F4F7"></rect>
                                                                    <g clip-path="url(#clip0_17884_342965)">
                                                                        <path
                                                                            d="M26.3326 26.3352L22.9992 23.0019M22.9992 23.0019L19.6659 26.3352M22.9992 23.0019V30.5019M29.9909 28.3269C30.8037 27.8838 31.4458 27.1826 31.8158 26.334C32.1858 25.4855 32.2627 24.5379 32.0344 23.6408C31.8061 22.7436 31.2855 21.9481 30.5548 21.3797C29.8241 20.8113 28.925 20.5025 27.9992 20.5019H26.9492C26.697 19.5262 26.2269 18.6205 25.5742 17.8527C24.9215 17.0849 24.1033 16.4751 23.181 16.069C22.2587 15.663 21.2564 15.4713 20.2493 15.5084C19.2423 15.5455 18.2568 15.8104 17.3669 16.2832C16.477 16.7561 15.7058 17.4244 15.1114 18.2382C14.517 19.0519 14.1148 19.9898 13.9351 20.9814C13.7553 21.9729 13.8027 22.9923 14.0736 23.9629C14.3445 24.9335 14.8319 25.8301 15.4992 26.5852"
                                                                            stroke="#0765FF" stroke-width="1.66667"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                    </g>
                                                                    <rect x="3" y="3" width="40" height="40"
                                                                        rx="20" stroke="#F9FAFB"
                                                                        stroke-width="6">
                                                                    </rect>
                                                                    <defs>
                                                                        <clipPath id="clip0_17884_342965">
                                                                            <rect width="20" height="20"
                                                                                fill="white"
                                                                                transform="translate(13 13)">
                                                                            </rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </div>
                                                            <div>
                                                                <span class="instruct">Click here to upload
                                                                    files</span>
                                                                <br> or drag and drop your file
                                                                <input type="file" id="statementOfAccountInput"
                                                                    hidden disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Other Documents (Optional) -->
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <label class="title-bold">Other Documents <span
                                                                class="warning-text">(optional)</span></label>
                                                        <div id="otherDocumentsPreview" class="uploaded-file d-none disabled">
                                                            <div>
                                                                <img src="https://cdn-icons-png.flaticon.com/512/136/136524.png"
                                                                    alt="File">
                                                            </div>
                                                            <div style="min-width: 170px">
                                                                <span id="otherDocumentsFilename"
                                                                    class="previewfname"></span>
                                                                <span id="otherDocumentsSize"
                                                                    class="previewfsize"></span>
                                                            </div>
                                                            <div style="min-width: 50px">
                                                                <a href="#"
                                                                    class="text-info justify-content-end"
                                                                    style="margin-right: 10px; font-size: 14px"><i
                                                                        class="fas fa-eye"></i></a>
                                                                <a href="#"
                                                                    class="text-danger justify-content-end"><i
                                                                        class="fas fa-trash"
                                                                        style="margin-right: 7px; font-size: 14px;"></i></a>
                                                            </div>
                                                        </div>

                                                        <div id="otherDocumentsUpload" class="upload-box"
                                                            style="display: flex; gap: 10px; ">
                                                            <div>
                                                                <svg width="46" height="46"
                                                                    viewBox="0 0 46 46" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="3" y="3" width="40" height="40"
                                                                        rx="20" fill="#F2F4F7"></rect>
                                                                    <g clip-path="url(#clip0_17884_342965)">
                                                                        <path
                                                                            d="M26.3326 26.3352L22.9992 23.0019M22.9992 23.0019L19.6659 26.3352M22.9992 23.0019V30.5019M29.9909 28.3269C30.8037 27.8838 31.4458 27.1826 31.8158 26.334C32.1858 25.4855 32.2627 24.5379 32.0344 23.6408C31.8061 22.7436 31.2855 21.9481 30.5548 21.3797C29.8241 20.8113 28.925 20.5025 27.9992 20.5019H26.9492C26.697 19.5262 26.2269 18.6205 25.5742 17.8527C24.9215 17.0849 24.1033 16.4751 23.181 16.069C22.2587 15.663 21.2564 15.4713 20.2493 15.5084C19.2423 15.5455 18.2568 15.8104 17.3669 16.2832C16.477 16.7561 15.7058 17.4244 15.1114 18.2382C14.517 19.0519 14.1148 19.9898 13.9351 20.9814C13.7553 21.9729 13.8027 22.9923 14.0736 23.9629C14.3445 24.9335 14.8319 25.8301 15.4992 26.5852"
                                                                            stroke="#0765FF" stroke-width="1.66667"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </g>
                                                                    <rect x="3" y="3" width="40" height="40"
                                                                        rx="20" stroke="#F9FAFB"
                                                                        stroke-width="6"></rect>
                                                                    <defs>
                                                                        <clipPath id="clip0_17884_342965">
                                                                            <rect width="20" height="20"
                                                                                fill="white"
                                                                                transform="translate(13 13)"></rect>
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                            </div>
                                                            <div>
                                                                <span class="instruct">Click here to upload
                                                                    files</span>
                                                                <br> or drag and drop your file
                                                                <input type="file" id="otherDocumentsInput" hidden disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="buttons" class="form-buttons-w" style="display: none">
                                                    <div class="d-flex justify-content-between">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="cancelEdit">Cancel</button>
                                                        <button class="btn btn-primary" type="submit"
                                                            style="font-size: 12px">
                                                            Save Changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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
<script src="{{ asset('js/bizdocs.js') }}?version=4.5.0"></script>

@endsection
