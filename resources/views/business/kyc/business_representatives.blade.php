<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="apps" content="Xtratech Global Solution">
    <meta name="author" content="Xtratech Global Solution">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>KYC Application | TransLite</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.css') }}?ver=20241116180">
    <link rel="stylesheet" href="{{ asset('assets/css/kyc.css') }}?ver=20241116180">
    <link rel="stylesheet" href="{{ asset('assets/css/kyc-new.css') }}?ver=20241116180">
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet" />

    <style>

    </style>

</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap flex-row-reverse">
        <div class="page-ath-content customPageContent">
            <div class="page-ath-form center-div">
                <div class="progress-container">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <a href="{{ route('business.kyc.apply') }}?current=3">
                            <div class="btn-back mb-4"><i class="fas fa-angle-left"></i> &nbsp;Previous Step</div>
                        </a>
                        <div class="mb-5 mobileDoLater ">
                            <a href="{{ route('business.dashboard') }}" class="dolater">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none">
                                    <path
                                        d="M7.4165 6.29922C7.67484 3.29922 9.2165 2.07422 12.5915 2.07422H12.6998C16.4248 2.07422 17.9165 3.56589 17.9165 7.29089V12.7242C17.9165 16.4492 16.4248 17.9409 12.6998 17.9409H12.5915C9.2415 17.9409 7.69984 16.7326 7.42484 13.7826"
                                        stroke="#667085" stroke-width="1.25" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                    <path d="M12.4999 10H3.0166" stroke="#667085" stroke-width="1.25"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M4.87516 7.20898L2.0835 10.0007L4.87516 12.7923" stroke="#667085"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span style="margin-left: 10px">I'll do this later.</span>
                            </a>
                        </div>
                    </div>

                    <div class="stepDisplay">Step 4 of 8</div>
                    <div class="processHeading">Business Representative</div>
                    <p class="processDescription mb-5">Add the details of your shareholder and directors to proceed.</p>
                    <form id="formValidate" method="post" action="">
                        @csrf
                        <div class="business-card ">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-user-circle fa-3x text-primary"></i>
                                </div>
                                <div class="ms-3">
                                    <span class="repsRole">Business Owner</span>
                                </div>
                                <div class="viewFile" style="display: flex; gap: 10px">
                                    <div>
                                        <a href="">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_13889_187927)">
                                                    <path
                                                        d="M11.332 2.0015C11.5071 1.82641 11.715 1.68751 11.9438 1.59275C12.1725 1.49799 12.4177 1.44922 12.6654 1.44922C12.913 1.44922 13.1582 1.49799 13.387 1.59275C13.6157 1.68751 13.8236 1.82641 13.9987 2.0015C14.1738 2.1766 14.3127 2.38447 14.4074 2.61324C14.5022 2.84202 14.551 3.08721 14.551 3.33484C14.551 3.58246 14.5022 3.82766 14.4074 4.05643C14.3127 4.28521 14.1738 4.49307 13.9987 4.66817L4.9987 13.6682L1.33203 14.6682L2.33203 11.0015L11.332 2.0015Z"
                                                        stroke="#1D2939" stroke-width="1.33333" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_13889_187927">
                                                        <rect width="16" height="16" fill="white"></rect>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.5 5.0013H4.16667M4.16667 5.0013H17.5M4.16667 5.0013V16.668C4.16667 17.11 4.34226 17.5339 4.65482 17.8465C4.96738 18.159 5.39131 18.3346 5.83333 18.3346H14.1667C14.6087 18.3346 15.0326 18.159 15.3452 17.8465C15.6577 17.5339 15.8333 17.11 15.8333 16.668V5.0013H4.16667ZM6.66667 5.0013V3.33464C6.66667 2.89261 6.84226 2.46868 7.15482 2.15612C7.46738 1.84356 7.89131 1.66797 8.33333 1.66797H11.6667C12.1087 1.66797 12.5326 1.84356 12.8452 2.15612C13.1577 2.46868 13.3333 2.89261 13.3333 3.33464V5.0013M8.33333 9.16797V14.168M11.6667 9.16797V14.168"
                                                    stroke="#F97066" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </a>

                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 mb-3">
                                <h6 class=""><strong>Gabriel Nwankwo Onyedikachi</strong></h6>
                            </div>


                            <div class="mt-1 row disfield">
                                <div class="col-12 col-md-6">
                                    <input type="email" class="form-control mb-2" value="gfunzy@gmail.com" disabled>
                                </div>
                                <div class="col-12 col-md-6">
                                    <input type="tel" class="form-control" value="+234 8188664322" disabled>
                                </div>
                            </div>

                            <div class="mt-2 row">
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="file-box">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                viewBox="0 0 12 12" fill="none">
                                                <path
                                                    d="M6 0C2.694 0 0 2.69408 0 6.00018C0 9.30627 2.694 12.0004 6 12.0004C9.306 12.0004 12 9.30627 12 6.00018C12 2.69408 9.306 0 6 0ZM8.868 4.62014L5.466 8.02223C5.382 8.10624 5.268 8.15424 5.148 8.15424C5.028 8.15424 4.914 8.10624 4.83 8.02223L3.132 6.32419C2.958 6.15018 2.958 5.86217 3.132 5.68817C3.306 5.51416 3.594 5.51416 3.768 5.68817L5.148 7.06821L8.232 3.98412C8.406 3.81011 8.694 3.81011 8.868 3.98412C9.042 4.15812 9.042 4.44013 8.868 4.62014Z"
                                                    fill="#12B76A"></path>
                                            </svg>
                                        </div>
                                        <div style="min-width: 150px">
                                            <span class="previewfname">nin.png</span>
                                        </div>
                                        <div class="viewFile" style="min-width: 10px">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.9998 4.58301C14.7824 4.58301 16.9376 7.28514 17.8851 8.89571C18.178 9.39017 18.3332 9.96001 18.3332 10.5413C18.3332 11.1227 18.178 11.6925 17.8851 12.187C16.9376 13.7975 14.7824 16.4997 10.9998 16.4997C7.21724 16.4997 5.06204 13.7975 4.11455 12.187C3.82165 11.6925 3.6665 11.1227 3.6665 10.5413C3.6665 9.96001 3.82165 9.39017 4.11455 8.89571C5.06204 7.28514 7.21724 4.58301 10.9998 4.58301ZM10.9998 15.2245C14.188 15.2245 16.0299 12.9004 16.8436 11.5194C17.0176 11.2255 17.1098 10.8868 17.1098 10.5413C17.1098 10.1958 17.0176 9.85717 16.8436 9.56327C16.0299 8.17969 14.188 5.8582 10.9998 5.8582C7.81163 5.8582 5.96981 8.18224 5.15611 9.56327C4.98209 9.85717 4.88992 10.1958 4.88992 10.5413C4.88992 10.8868 4.98209 11.2255 5.15611 11.5194C5.96981 12.9004 7.81163 15.2245 10.9998 15.2245ZM9.3029 7.89073C9.80519 7.54043 10.3957 7.35346 10.9998 7.35346C11.8096 7.35447 12.586 7.69067 13.1586 8.28832C13.7312 8.88596 14.0533 9.69625 14.0543 10.5414C14.0543 11.172 13.8751 11.7883 13.5395 12.3126C13.2039 12.8368 12.7268 13.2455 12.1687 13.4867C11.6106 13.728 10.9965 13.7912 10.404 13.6682C9.81146 13.5452 9.26721 13.2415 8.84004 12.7957C8.41287 12.3498 8.12197 11.7818 8.00411 11.1634C7.88625 10.545 7.94674 9.90398 8.17792 9.32145C8.40911 8.73893 8.8006 8.24103 9.3029 7.89073ZM9.98168 12.1319C10.2831 12.342 10.6374 12.4542 10.9998 12.4542C11.4859 12.4542 11.952 12.2527 12.2957 11.894C12.6394 11.5353 12.8325 11.0487 12.8325 10.5414C12.8325 10.1631 12.725 9.79331 12.5236 9.47875C12.3223 9.1642 12.036 8.91903 11.7012 8.77425C11.3663 8.62948 10.9978 8.5916 10.6423 8.66541C10.2868 8.73921 9.96026 8.92139 9.70396 9.18889C9.44766 9.4564 9.27312 9.79723 9.2024 10.1683C9.13169 10.5393 9.16798 10.9239 9.30669 11.2734C9.4454 11.6229 9.6803 11.9217 9.98168 12.1319Z"
                                                    fill="#200E32"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-2">
                                    <div class="file-box">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                viewBox="0 0 12 12" fill="none">
                                                <path
                                                    d="M6 0C2.694 0 0 2.69408 0 6.00018C0 9.30627 2.694 12.0004 6 12.0004C9.306 12.0004 12 9.30627 12 6.00018C12 2.69408 9.306 0 6 0ZM8.868 4.62014L5.466 8.02223C5.382 8.10624 5.268 8.15424 5.148 8.15424C5.028 8.15424 4.914 8.10624 4.83 8.02223L3.132 6.32419C2.958 6.15018 2.958 5.86217 3.132 5.68817C3.306 5.51416 3.594 5.51416 3.768 5.68817L5.148 7.06821L8.232 3.98412C8.406 3.81011 8.694 3.81011 8.868 3.98412C9.042 4.15812 9.042 4.44013 8.868 4.62014Z"
                                                    fill="#12B76A"></path>
                                            </svg>
                                        </div>

                                        <div style="min-width: 150px">
                                            <span class="previewfname">dsc0638original...</span>
                                        </div>

                                        <div class="viewFile" style="min-width: 10px">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.9998 4.58301C14.7824 4.58301 16.9376 7.28514 17.8851 8.89571C18.178 9.39017 18.3332 9.96001 18.3332 10.5413C18.3332 11.1227 18.178 11.6925 17.8851 12.187C16.9376 13.7975 14.7824 16.4997 10.9998 16.4997C7.21724 16.4997 5.06204 13.7975 4.11455 12.187C3.82165 11.6925 3.6665 11.1227 3.6665 10.5413C3.6665 9.96001 3.82165 9.39017 4.11455 8.89571C5.06204 7.28514 7.21724 4.58301 10.9998 4.58301ZM10.9998 15.2245C14.188 15.2245 16.0299 12.9004 16.8436 11.5194C17.0176 11.2255 17.1098 10.8868 17.1098 10.5413C17.1098 10.1958 17.0176 9.85717 16.8436 9.56327C16.0299 8.17969 14.188 5.8582 10.9998 5.8582C7.81163 5.8582 5.96981 8.18224 5.15611 9.56327C4.98209 9.85717 4.88992 10.1958 4.88992 10.5413C4.88992 10.8868 4.98209 11.2255 5.15611 11.5194C5.96981 12.9004 7.81163 15.2245 10.9998 15.2245ZM9.3029 7.89073C9.80519 7.54043 10.3957 7.35346 10.9998 7.35346C11.8096 7.35447 12.586 7.69067 13.1586 8.28832C13.7312 8.88596 14.0533 9.69625 14.0543 10.5414C14.0543 11.172 13.8751 11.7883 13.5395 12.3126C13.2039 12.8368 12.7268 13.2455 12.1687 13.4867C11.6106 13.728 10.9965 13.7912 10.404 13.6682C9.81146 13.5452 9.26721 13.2415 8.84004 12.7957C8.41287 12.3498 8.12197 11.7818 8.00411 11.1634C7.88625 10.545 7.94674 9.90398 8.17792 9.32145C8.40911 8.73893 8.8006 8.24103 9.3029 7.89073ZM9.98168 12.1319C10.2831 12.342 10.6374 12.4542 10.9998 12.4542C11.4859 12.4542 11.952 12.2527 12.2957 11.894C12.6394 11.5353 12.8325 11.0487 12.8325 10.5414C12.8325 10.1631 12.725 9.79331 12.5236 9.47875C12.3223 9.1642 12.036 8.91903 11.7012 8.77425C11.3663 8.62948 10.9978 8.5916 10.6423 8.66541C10.2868 8.73921 9.96026 8.92139 9.70396 9.18889C9.44766 9.4564 9.27312 9.79723 9.2024 10.1683C9.13169 10.5393 9.16798 10.9239 9.30669 11.2734C9.4454 11.6229 9.6803 11.9217 9.98168 12.1319Z"
                                                    fill="#200E32"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mt-4 mb-5" style="color:blue; cursor:pointer" data-toggle="modal"
                            data-target="#addRep" data-backdrop="static" data-keyboard="false">
                            <i class="fas fa-plus"></i> <span class="add-rep">Add Business Representative</span>
                        </div>

                        <a href="{{ route('business.kyc.apply') }}?current=5">
                            <button type="button" class="btn btn-primary btn-block">Save & Continue</button>
                        </a>

                        <div class="center-button">
                            <a href="{{ route('business.kyc.apply') }}?current=5" class="skip">Skip to Business
                                Documents
                                Upload <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </form>

                </div>

            </div>

        </div>
        <div class="page-ath-gfx">
            <div class="w-100 d-flex ">
                <div class="col-12">
                    <div class="mt-5">
                        <img class="page-ath-logo-img" src="images/logos.png" alt="TransLite Logo">
                    </div>


                    <div class="kycinstruction">
                        <h5><span class="kycheading">Set up your business account</span></h5>
                        <p class="kycheadingsmall">Activate your business payments in quick and simple steps</p>
                    </div>

                    <div class="">
                        <a href="{{ route('business.dashboard') }}" class="dolater">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="none">
                                <path
                                    d="M7.4165 6.29922C7.67484 3.29922 9.2165 2.07422 12.5915 2.07422H12.6998C16.4248 2.07422 17.9165 3.56589 17.9165 7.29089V12.7242C17.9165 16.4492 16.4248 17.9409 12.6998 17.9409H12.5915C9.2415 17.9409 7.69984 16.7326 7.42484 13.7826"
                                    stroke="#667085" stroke-width="1.25" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                                <path d="M12.4999 10H3.0166" stroke="#667085" stroke-width="1.25"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M4.87516 7.20898L2.0835 10.0007L4.87516 12.7923" stroke="#667085"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span style="margin-left: 10px">I'll do this later.</span>
                        </a>
                    </div>



                    <div class="copyright">
                        <span style="margin-right: 10px">&copy; {{ date('Y') }} TransLite</span> |
                        <span style="margin-left: 10px"><a href="#" target="_blank">Terms &
                                Conditions</a></span>
                    </div>

                </div>
            </div>
        </div>


        <div aria-hidden="true" aria-labelledby="addRep" class="modal fade" id="addRep" role="dialog"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <strong>Add new business representative</strong>
                        </h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true"> &times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="tabs">
                            <a href="#" class="tab-link active" data-tab="nigerian">Nigerian</a>
                            <a href="#" class="tab-link" data-tab="other">Other Nationality</a>
                        </div>

                        {{-- <div class="tabs">
                                <button type="button" class="tab-btn active" data-tab="nigerian">Nigerian</button>
                                <button type="button" class="tab-btn" data-tab="other">Other Nationality</button>
                            </div> --}}

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Nigerian Tab -->
                            <div class="tab-panel active" id="nigerian">
                                <form method="post" action="" enctype="multipart/form-data">
                                    @csrf
                                    {{-- <label>
                                        <input type="checkbox" id="under18">
                                        Are you a registered director under 18 years old without a BVN?
                                    </label> --}}

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Bank Verification Number
                                                    (BVN)</label>
                                                <input type="text" name="BVN" value=""
                                                    placeholder="Bank Verification Number" class="form-control"
                                                    required />

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Designation</label>
                                                <select id="designation" name="currency" required>
                                                    <option value="">Select Designation</option>
                                                    <option value="Business Owner">Business Owner</option>
                                                    <option value="Authorized Signatory">Authorized Signatory</option>
                                                    <option value="Director">Director</option>
                                                    <option value="Director & Shareholder">Director & Shareholder
                                                    </option>
                                                    <option value="Shareholder">Shareholder</option>
                                                    <option value="Member">Member</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Verification Document</label>
                                                <select id="veridoc" name="bank" required
                                                    onchange="setDocumentType('document-type', this.value)">
                                                    <option value="">Select Document Type</option>
                                                    <option value="Driver License">Driver License</option>
                                                    <option value="Permanent Voter Card (PVC)">Permanent Voter Card
                                                        (PVC)
                                                    </option>
                                                    <option value="National Identity Card">National Identity Card
                                                    </option>
                                                    <option value="International Passport">International Passport
                                                    </option>
                                                    <option value="Birth Certificate">Birth Certificate</option>
                                                    <option value="Resident Permit">Resident Permit</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- File Upload Fields -->
                                    <div class="row g-3">
                                        <!-- Driver License Upload -->
                                        <div class="col-12 col-md-6 mb-1">
                                            <label class="custom-file-upload d-flex align-items-center gap-2"
                                                onclick="document.getElementById('driver-license').click()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                                    viewBox="0 0 16 14" fill="none">
                                                    <path
                                                        d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                        stroke="#0765FF" stroke-width="1.45455"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg> <span id="document-type">Select Document</span>
                                            </label>
                                            <input type="file" id="driver-license" class="hidden-input"
                                                onchange="updateFileName('document-type', this)">
                                        </div>

                                        <!-- Passport Photo Upload -->
                                        <div class="col-12 col-md-6 mb-1">
                                            <label class="custom-file-upload d-flex align-items-center gap-2"
                                                onclick="document.getElementById('passport-photo').click()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                                    viewBox="0 0 16 14" fill="none">
                                                    <path
                                                        d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                        stroke="#0765FF" stroke-width="1.45455"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg> <span id="passport-name">Passport Photo</span>
                                            </label>
                                            <input type="file" id="passport-photo" class="hidden-input"
                                                onchange="updateFileName('passport-name', this)">
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary w-100 mt-4">Save</button>
                                </form>
                            </div>

                            <!-- Other Nationality Tab -->
                            <div class="tab-panel" id="other">
                                <form method="post" action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Last Name</label>
                                                <input type="text" name="BVN" value=""
                                                    placeholder="Last Name" class="form-control" required />

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Other Names</label>
                                                <input type="text" name="BVN" value=""
                                                    placeholder="Other Names" class="form-control" required />

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Email Address</label>
                                                <input type="email" name="BVN" value=""
                                                    placeholder="Email Address" class="form-control" required />

                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Phone Number</label>
                                                <input type="text" name="BVN" value=""
                                                    placeholder="Phone Number" class="form-control" required />

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Date of Birth</label>
                                                <input type="date" name="BVN" value=""
                                                    placeholder="Date of Birth" class="form-control" required />

                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="formalabel" for="">Designation</label>
                                                <select id="representative" name="currency" required>
                                                    <option value="">Select Designation</option>
                                                    <option value="Business Owner">Business Owner</option>
                                                    <option value="Authorized Signatory">Authorized Signatory
                                                    </option>
                                                    <option value="Director">Director</option>
                                                    <option value="Director & Shareholder">Director & Shareholder
                                                    </option>
                                                    <option value="Shareholder">Shareholder</option>
                                                    <option value="Member">Member</option>
                                                </select>

                                            </div>
                                        </div>

                                    </div>

                                    <!-- File Upload Fields -->
                                    <div class="row g-3">
                                        <!-- Driver License Upload -->
                                        <div class="col-12 col-md-6 mb-1">
                                            <label class="custom-file-upload d-flex align-items-center gap-2"
                                                onclick="document.getElementById('foreigner-id').click()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                                    viewBox="0 0 16 14" fill="none">
                                                    <path
                                                        d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                        stroke="#0765FF" stroke-width="1.45455"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg> <span id="foreigner-document">Resident permit /
                                                    International Passport</span>
                                            </label>
                                            <input type="file" id="foreigner-id" class="hidden-input"
                                                onchange="updateFileName('foreigner-document', this)">
                                        </div>

                                        <!-- Passport Photo Upload -->
                                        <div class="col-12 col-md-6 mb-1">
                                            <label class="custom-file-upload d-flex align-items-center gap-2"
                                                onclick="document.getElementById('foreigner-photo').click()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                                    viewBox="0 0 16 14" fill="none">
                                                    <path
                                                        d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                        stroke="#0765FF" stroke-width="1.45455"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg> <span id="foreigner-passport">Passport Photo</span>
                                            </label>
                                            <input type="file" id="foreigner-photo" class="hidden-input"
                                                onchange="updateFileName('foreigner-passport', this)">
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary w-100">Save</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.bundle.js') }}?ver=20241116180"></script>
    <script src="{{ asset('assets/js/script.js') }}?ver=20241116180"></script>
    <script src="{{ asset('assets/js/kyc.js') }}?ver=20241116180"></script>

    <script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        jQuery(function() {
            var $frv = jQuery('.validate');
            if ($frv.length > 0) {
                $frv.validate({
                    errorClass: "input-bordered-error error"
                });
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".tab-link");
            const panels = document.querySelectorAll(".tab-panel");

            tabs.forEach(tab => {
                tab.addEventListener("click", function(e) {
                    e.preventDefault();
                    tabs.forEach(t => t.classList.remove("active"));
                    panels.forEach(p => p.classList.remove("active"));

                    this.classList.add("active");
                    document.getElementById(this.dataset.tab).classList.add("active");
                });
            });
        });


        function updateFileName(elementId, input) {
            const fileName = input.files.length > 0 ? input.files[0].name : "";
            document.getElementById(elementId).textContent = fileName;
        }

        function setDocumentType(elementId, fileName) {
            document.getElementById(elementId).textContent = fileName || "Select Document";
        }


        // Enable Save Button when required fields are filled
        // document.getElementById("bvn").addEventListener("input", function() {
        //     const bvn = this.value.trim();
        //     const saveButton = document.getElementById("save-btn");
        //     saveButton.disabled = bvn.length < 10; // Enable when BVN is at least 10 characters
        // });
    </script>

</body>

</html>
