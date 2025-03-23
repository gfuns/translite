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
                    <div class="mb-5 mobileDoLater ">
                        <a href="{{ route('business.dashboard') }}" class="dolater">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                    d="M7.4165 6.29922C7.67484 3.29922 9.2165 2.07422 12.5915 2.07422H12.6998C16.4248 2.07422 17.9165 3.56589 17.9165 7.29089V12.7242C17.9165 16.4492 16.4248 17.9409 12.6998 17.9409H12.5915C9.2415 17.9409 7.69984 16.7326 7.42484 13.7826"
                                    stroke="#667085" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M12.4999 10H3.0166" stroke="#667085" stroke-width="1.25" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M4.87516 7.20898L2.0835 10.0007L4.87516 12.7923" stroke="#667085"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span style="margin-left: 10px">I'll do this later.</span>
                        </a>
                    </div>

                    <div class="stepDisplay">Step 7 of 8</div>
                    <div class="processHeading">Add your bank information to receive settlement</div>
                    <p class="processDescription mb-5">This will be used to collect payments. Once verified, you will be
                        able to make payouts and direct withdrawals to the account provided.
                        <span style="display: block; color:red"> Note: You will able to add more bank accounts in your
                            account settings</span>
                    </p>
                    <form id="formValidate" method="post" action="">
                        @csrf

                        <div class="form-group">
                            <label for=""> <strong>Currency</strong></label>
                            <select id="currency" name="currency" required>
                                <option value="NGN">Naira (NGN)</option>
                                {{-- <option value="USD">US Dollar (USD)</option> --}}
                            </select>
                            <div class="help-block form-text with-errors form-control-feedback">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""> <strong>Bank</strong></label>
                            <select id="bank" name="bank" required>
                                <option value="">Select Bank</option>
                                <option value="1" data-image="https://nigerianbanks.xyz/logo/access-bank.png">
                                    Access Bank</option>
                                <option value="2"
                                    data-image="https://nigerianbanks.xyz/logo/first-bank-of-nigeria.png">First Bank
                                </option>
                            </select>
                            <div class="help-block form-text with-errors form-control-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><strong> Account Number</strong></label>
                            <input name="accountNumber" class="form-control"
                                data-error="Account number provided is invalid" placeholder=" Account Number"
                                value="" required="required" type="text">
                            <div class="help-block form-text with-errors form-control-feedback">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""><strong> Account Name</strong></label>
                            <input name="accountName" class="form-control" placeholder=" Account Name" value=""
                                required="required" type="text" disabled>
                        </div>

                        <div class="form-group">
                            <label for=""><strong> TIN</strong></label>
                            <input name="tin" class="form-control" data-error="TIN provided is invalid"
                                placeholder=" TIN" value="" required="required" type="text">
                            <div class="help-block form-text with-errors form-control-feedback">
                            </div>
                        </div>

                        <a href="{{ route('business.kyc.apply') }}?current=8">
                            <button type="button" class="btn btn-primary btn-block">Save & Continue</button>
                        </a>

                        <div class="center-button">
                            <a href="{{ route('business.kyc.apply') }}?current=8" class="skip">Skip to Charges
                                Information <i class="fas fa-long-arrow-alt-right"></i></a>
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
                                    stroke-linejoin="round"></path>
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
    </script>

</body>

</html>
