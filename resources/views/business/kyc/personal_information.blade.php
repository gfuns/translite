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

    <style>
        :disabled {
            background-color: rgb(249, 250, 251) !important;
            border-color: rgb(208, 213, 221);
            /* color: rgb(169, 169, 170); */
            cursor: not-allowed;
        }
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

                    <div class="stepDisplay">Step 2 of 8</div>
                    <div class="processHeading">Enter Personal Information</div>
                    <p class="processDescription mb-5">Enter your personal information so we can identify you and serve
                        you
                        better.</p>
                    <form id="formValidate" method="post" action="">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for=""> <strong>First Name</strong></label>
                                <input name="firstName" class="form-control" data-error="Face name provided is invalid"
                                    placeholder=" First Name" value="{{ Auth::user()->firstName }}" required="required"
                                    type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for=""> <strong>Last Name</strong></label>
                                <input name="lastName" class="form-control" data-error="Last name provided is invalid"
                                    placeholder=" Last Name" value="{{ Auth::user()->lastName }}" required="required"
                                    type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for=""> <strong>Email Addres</strong></label>
                                <input name="email" class="form-control" data-error="Email provided is invalid"
                                    placeholder=" Email Address" value="{{ Auth::user()->email }}" required="required"
                                    type="email" disabled>
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for=""> <strong>Phone Number</strong></label>
                                <input name="password_confirmation" class="form-control"
                                    data-error="Phone number provided is invalid" placeholder=" Phone Number"
                                    value="{{ Auth::user()->phoneNumber }}" required="required" type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                        </div>


                        <a href="{{ route('business.kyc.apply') }}?current=3">
                            <button type="button" class="btn btn-primary btn-block">Save & Continue</button>
                        </a>

                        <div class="center-button">
                            <a href="{{ route('business.kyc.apply') }}?current=3" class="skip">Skip to Business
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
