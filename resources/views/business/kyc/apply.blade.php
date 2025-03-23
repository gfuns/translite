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

    </style>

</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap flex-row-reverse">
        <div class="page-ath-content customPageContent">
            <div class="page-ath-form center-div">
                <div class="progress-container">
                    <div class="mb-5 mobileDoLater ">
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

                    <div class="stepDisplay">Step 1 of 8</div>
                    <div class="processHeading">Which best describes your business?</div>
                    <p class="processDescription">Depending on your business type, a few necessary documents will be
                        required for verification and
                        security reasons.</p>
                    <form id="formValidate" method="post" action="">
                        @csrf

                        <div class="mt-3">
                            <!-- Freelancer -->
                            <label class="business-option">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="32" height="32" rx="16" fill="#3D78F9"></rect>
                                    <path
                                        d="M15.9998 16.0007C17.8408 16.0007 19.3332 14.5083 19.3332 12.6673C19.3332 10.8264 17.8408 9.33398 15.9998 9.33398C14.1589 9.33398 12.6665 10.8264 12.6665 12.6673C12.6665 14.5083 14.1589 16.0007 15.9998 16.0007Z"
                                        fill="white"></path>
                                    <path
                                        d="M15.9999 17.666C12.6599 17.666 9.93994 19.906 9.93994 22.666C9.93994 22.8527 10.0866 22.9993 10.2733 22.9993H21.7266C21.9133 22.9993 22.0599 22.8527 22.0599 22.666C22.0599 19.906 19.3399 17.666 15.9999 17.666Z"
                                        fill="white"></path>
                                </svg>
                                <div>
                                    <h6 class="title">Freelancers</h6>
                                    <p class="mb-0 description">Are you an individual offering
                                        services independently without a registered business?
                                        Then this is for you!?</p>
                                </div>
                                <input type="radio" name="businessType" checked>
                                <span class="radio-indicator"></span>
                            </label>

                            <!-- Sole Proprietorship -->
                            <label class="business-option">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="32" height="32" rx="16" fill="#7A5AF8"></rect>
                                    <g clip-path="url(#clip0_1894_18559)">
                                        <path
                                            d="M20 9.33398H12C10.8933 9.33398 10 10.2207 10 11.314V18.5873C10 19.6807 10.8933 20.5673 12 20.5673H12.5067C13.04 20.5673 13.5467 20.774 13.92 21.1473L15.06 22.274C15.58 22.7873 16.4267 22.7873 16.9467 22.274L18.0867 21.1473C18.46 20.774 18.9733 20.5673 19.5 20.5673H20C21.1067 20.5673 22 19.6807 22 18.5873V11.314C22 10.2207 21.1067 9.33398 20 9.33398ZM16 11.834C16.86 11.834 17.5533 12.5273 17.5533 13.3873C17.5533 14.2473 16.86 14.9407 16 14.9407C15.14 14.9407 14.4467 14.2407 14.4467 13.3873C14.4467 12.5273 15.14 11.834 16 11.834ZM17.7867 18.0407H14.2133C13.6733 18.0407 13.36 17.4407 13.66 16.994C14.1133 16.3207 14.9933 15.8673 16 15.8673C17.0067 15.8673 17.8867 16.3207 18.34 16.994C18.64 17.4407 18.32 18.0407 17.7867 18.0407Z"
                                            fill="white"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1894_18559">
                                            <rect width="16" height="16" fill="white"
                                                transform="translate(8 8)">
                                            </rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <div>
                                    <h6 class="title">Sole Proprietorship</h6>
                                    <p class="mb-0 description">Is your business unincorporated
                                        and owned by one individual? This is where you belong.
                                    </p>
                                </div>
                                <input type="radio" name="businessType">
                                <span class="radio-indicator"></span>
                            </label>

                            <!-- Public Limited Liability -->
                            <label class="business-option">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="32" height="32" rx="16" fill="#FA7066"></rect>
                                    <path
                                        d="M22.6668 20.6667V22.6667H9.3335V20.6667C9.3335 20.3 9.6335 20 10.0002 20H22.0002C22.3668 20 22.6668 20.3 22.6668 20.6667Z"
                                        fill="white" stroke="white" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M12.6668 15.334H11.3335V20.0007H12.6668V15.334Z" fill="white"></path>
                                    <path d="M15.3333 15.334H14V20.0007H15.3333V15.334Z" fill="white"></path>
                                    <path d="M17.9998 15.334H16.6665V20.0007H17.9998V15.334Z" fill="white"></path>
                                    <path d="M20.6668 15.334H19.3335V20.0007H20.6668V15.334Z" fill="white"></path>
                                    <path
                                        d="M23.3332 23.166H8.6665C8.39317 23.166 8.1665 22.9393 8.1665 22.666C8.1665 22.3927 8.39317 22.166 8.6665 22.166H23.3332C23.6065 22.166 23.8332 22.3927 23.8332 22.666C23.8332 22.9393 23.6065 23.166 23.3332 23.166Z"
                                        fill="white"></path>
                                    <path
                                        d="M22.2468 11.8326L16.2468 9.43258C16.1135 9.37924 15.8868 9.37924 15.7535 9.43258L9.7535 11.8326C9.52016 11.9259 9.3335 12.1992 9.3335 12.4526V14.6659C9.3335 15.0326 9.6335 15.3326 10.0002 15.3326H22.0002C22.3668 15.3326 22.6668 15.0326 22.6668 14.6659V12.4526C22.6668 12.1992 22.4802 11.9259 22.2468 11.8326ZM16.0002 13.6659C15.4468 13.6659 15.0002 13.2192 15.0002 12.6659C15.0002 12.1126 15.4468 11.6659 16.0002 11.6659C16.5535 11.6659 17.0002 12.1126 17.0002 12.6659C17.0002 13.2192 16.5535 13.6659 16.0002 13.6659Z"
                                        fill="white"></path>
                                </svg>
                                <div>
                                    <h6 class="title">Public Limited Liability Company</h6>
                                    <p class="mb-0 description">Does your business offers
                                        shares to the public and is listed on a stock exchange?
                                        You are in the right place.
                                    </p>
                                </div>
                                <input type="radio" name="businessType">
                                <span class="radio-indicator"></span>
                            </label>

                            <!-- Private Limited Liability -->
                            <label class="business-option">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="32" height="32" rx="16" fill="#FA7066"></rect>
                                    <path
                                        d="M22.6668 20.6667V22.6667H9.3335V20.6667C9.3335 20.3 9.6335 20 10.0002 20H22.0002C22.3668 20 22.6668 20.3 22.6668 20.6667Z"
                                        fill="white" stroke="white" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M12.6668 15.334H11.3335V20.0007H12.6668V15.334Z" fill="white"></path>
                                    <path d="M15.3333 15.334H14V20.0007H15.3333V15.334Z" fill="white"></path>
                                    <path d="M17.9998 15.334H16.6665V20.0007H17.9998V15.334Z" fill="white"></path>
                                    <path d="M20.6668 15.334H19.3335V20.0007H20.6668V15.334Z" fill="white"></path>
                                    <path
                                        d="M23.3332 23.166H8.6665C8.39317 23.166 8.1665 22.9393 8.1665 22.666C8.1665 22.3927 8.39317 22.166 8.6665 22.166H23.3332C23.6065 22.166 23.8332 22.3927 23.8332 22.666C23.8332 22.9393 23.6065 23.166 23.3332 23.166Z"
                                        fill="white"></path>
                                    <path
                                        d="M22.2468 11.8326L16.2468 9.43258C16.1135 9.37924 15.8868 9.37924 15.7535 9.43258L9.7535 11.8326C9.52016 11.9259 9.3335 12.1992 9.3335 12.4526V14.6659C9.3335 15.0326 9.6335 15.3326 10.0002 15.3326H22.0002C22.3668 15.3326 22.6668 15.0326 22.6668 14.6659V12.4526C22.6668 12.1992 22.4802 11.9259 22.2468 11.8326ZM16.0002 13.6659C15.4468 13.6659 15.0002 13.2192 15.0002 12.6659C15.0002 12.1126 15.4468 11.6659 16.0002 11.6659C16.5535 11.6659 17.0002 12.1126 17.0002 12.6659C17.0002 13.2192 16.5535 13.6659 16.0002 13.6659Z"
                                        fill="white"></path>
                                </svg>
                                <div>
                                    <h6 class="title">Private Limited Liability Company</h6>
                                    <p class="mb-0 description">Is your business a small,
                                        privately owned entity with limited owner liability?
                                        Then this is a great fit for you!
                                    </p>
                                </div>
                                <input type="radio" name="businessType">
                                <span class="radio-indicator"></span>
                            </label>

                            <!-- Government -->
                            <label class="business-option">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="32" height="32" rx="16" fill="#DD2590"></rect>
                                    <path opacity="0.4"
                                        d="M19.6133 8.83647C19.4733 8.74314 19.3 8.72313 19.1467 8.78313C18.1933 9.16313 17.14 9.16313 16.1867 8.78313C16.0333 8.72313 15.86 8.74314 15.72 8.83647C15.58 8.92981 15.5 9.08314 15.5 9.2498V11.2498V13.2498C15.5 13.5231 15.7267 13.7498 16 13.7498C16.2733 13.7498 16.5 13.5231 16.5 13.2498V11.9298C16.8867 12.0232 17.2733 12.0765 17.6667 12.0765C18.2933 12.0765 18.92 11.9565 19.52 11.7165C19.7067 11.6431 19.8333 11.4565 19.8333 11.2498V9.2498C19.8333 9.08314 19.7533 8.92981 19.6133 8.83647Z"
                                        fill="white"></path>
                                    <path
                                        d="M22.6666 23.0833H21.8333V16.25C21.8333 14.6367 20.9466 13.75 19.3333 13.75H12.6666C11.0533 13.75 10.1666 14.6367 10.1666 16.25V23.0833H9.33325C9.05992 23.0833 8.83325 23.31 8.83325 23.5833C8.83325 23.8567 9.05992 24.0833 9.33325 24.0833H10.6666H21.3333H22.6666C22.9399 24.0833 23.1666 23.8567 23.1666 23.5833C23.1666 23.31 22.9399 23.0833 22.6666 23.0833ZM20.8333 17.4167V23.0833H19.1599V17.4167H20.8333ZM15.4933 23.0833H13.8266V17.4167H15.4933V23.0833ZM16.4933 17.4167H18.1599V23.0833H16.4933V17.4167ZM11.1666 17.4167H12.8266V23.0833H11.1666V17.4167Z"
                                        fill="white"></path>
                                </svg>
                                <div>
                                    <h6 class="title">Government Entity</h6>
                                    <p class="mb-0 description">Are you a government
                                        parastatal, involved in collections, or engaged in IGR
                                        or tax collections? If so, you're in the right place!
                                    </p>
                                </div>
                                <input type="radio" name="businessType">
                                <span class="radio-indicator"></span>
                            </label>

                            <!-- NPO -->
                            <label class="business-option">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect width="32" height="32" rx="16" fill="#12B76A"></rect>
                                    <path
                                        d="M16.0002 9.33398C12.3202 9.33398 9.3335 12.3207 9.3335 16.0007C9.3335 19.6807 12.3202 22.6673 16.0002 22.6673C19.6802 22.6673 22.6668 19.6807 22.6668 16.0007C22.6668 12.3207 19.6802 9.33398 16.0002 9.33398ZM16.2202 19.334C16.1002 19.374 15.8935 19.374 15.7735 19.334C14.7335 18.9807 12.4002 17.494 12.4002 14.974C12.4002 13.8607 13.2935 12.9607 14.4002 12.9607C15.0535 12.9607 15.6335 13.274 16.0002 13.7673C16.3602 13.2807 16.9468 12.9607 17.6002 12.9607C18.7068 12.9607 19.6002 13.8607 19.6002 14.974C19.6002 17.494 17.2668 18.9807 16.2202 19.334Z"
                                        fill="white"></path>
                                </svg>
                                <div>
                                    <h6 class="title">NPO (Non-Profit Organization)</h6>
                                    <p class="mb-0 description">Are you a non-profit
                                        organization focused on social, charitable, or
                                        humanitarian missions? Choose this option.</p>
                                </div>
                                <input type="radio" name="businessType">
                                <span class="radio-indicator"></span>
                            </label>
                        </div>

                        <div class="center-button">
                            <a href="{{ route("business.kyc.apply") }}?current=2">
                                <button type="button" class="btn btn-primary">Continue with selected account
                                type</button>
                            </a>
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
                        <span style="margin-right: 10px">&copy; {{ date("Y") }} TransLite</span> |
                        <span style="margin-left: 10px"><a href="#" target="_blank">Terms & Conditions</a></span>
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
