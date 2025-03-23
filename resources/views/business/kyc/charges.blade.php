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
        .disabled-btn {
            background: #e0e0e0;
            cursor: not-allowed !important;
        }
    </style>

</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap flex-row-reverse">
        <div class="page-ath-content customPageContent">
            <div class="page-ath-form center-div">
                <div class="progress-container">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <a href="{{ route('business.kyc.apply') }}?current=7"><div class="btn-back mb-4"><i class="fas fa-angle-left"></i> &nbsp;Previous Step</div></a>
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
                    <div class="stepDisplay">Step 8 of 8</div>
                    <div class="processHeading">Commercials</div>
                    <p class="processDescription mb-5">Let’s talk money!</p>
                    <form id="formValidate" method="post" action="">
                        @csrf

                        <p class="fw-semibold"><strong>How much do you intend to process yearly on TransLite?</strong>
                        </p>
                        <div class="radio-group">
                            <label class="radio-btn"><input type="radio" name="amount" value="<500K">
                                < ₦500,000</label>
                                    <label class="radio-btn"><input type="radio" name="amount" value="500K-5M"> ₦500K
                                        to ₦5M</label>
                                    <label class="radio-btn active"><input type="radio" name="amount" value="5M-25M"
                                            checked> ₦5M to
                                        ₦25M</label>
                                    <label class="radio-btn"><input type="radio" name="amount" value=">25M"> More
                                        than ₦25M</label>
                        </div>


                        <p class="mt-3"><strong>Should TransLite fees be added to the customer’s price during
                                purchase?</strong>
                        </p>
                        <div class="radio-group">
                            <label class="radio-btn active"><input type="radio" name="fees" value="yes" checked>
                                Yes</label>
                            <label class="radio-btn"><input type="radio" name="fees" value="no"> No</label>
                        </div>

                        <div class="alert alert-note">
                            <strong>NOTE:</strong><br>
                            TransLite fees are charged at <strong>1.5%</strong> per transaction amount. For any
                            transaction
                            amount, <strong>₦2,000</strong> and above, there is an additional <strong>₦100</strong>
                            charge.
                        </div>

                        <div class="mt-4 mb-4" style="display: flex">
                            <input class="agree-box" type="checkbox" id="agree">
                            <label class="form-check-label" for="agree" style="font-size:14px; cursor: pointer">
                                By checking this box, you agree to the <a href="#" target="_blank"
                                    class="">TransLite
                                    Payment Service Agreement</a>
                            </label>
                        </div>


                        <a href="{{ route('business.kyc.apply') }}?current=8">
                            <button id="submitBtn" type="button" class="btn btn-primary disabled-btn w-100"
                                disabled>Save
                                & Continue</button>
                        </a>


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

        document.getElementById("agree").addEventListener("change", function() {
            const submitBtn = document.getElementById("submitBtn");
            submitBtn.disabled = !this.checked;
            submitBtn.classList.toggle("disabled-btn", !this.checked);
        });

        document.querySelectorAll(".radio-group .radio-btn").forEach(button => {
            button.addEventListener("click", function() {
                let group = this.parentElement;
                group.querySelectorAll(".radio-btn").forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
            });
        });
    </script>


</body>

</html>
