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
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <a href="{{ route('business.kyc.apply') }}?current=4"><div class="btn-back mb-4"><i class="fas fa-angle-left"></i> &nbsp;Previous Step</div></a>
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

                    <div class="stepDisplay">Step 5 of 8</div>
                    <div class="processHeading">Upload Business Documents</div>
                    <p class="processDescription mb-3">Kindly upload the following required documents, so we can verify your account and deposit your earnings. Only .pdf, .png, .jpg and .jpeg files are allowed (max size 10mb each).</p>
                    <p class="processDescription mb-5">Proof of address cannot be older than 3 months (except for rental agreement).</p>
                    <form id="formValidate" method="post" action="">
                        @csrf
                        <div class="row">
                            <div class="col-6 col-md-4 logobox nopadding">
                                <div class="business-logo">
                                    <img id="logoPreview" src="{{ asset('noimage.jpeg') }}" class="img-fluid" />
                                </div>

                                <div class="logo-btn">
                                    <button class="btn btn-default" type="button" id="changeLogoBtn">Change Logo</button>
                                </div>

                                <input type="file" id="logoInput" name="logo" accept="image/*"
                                    style="display: none;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""> <strong>Business Name</strong></label>
                            <input name="businessName" class="form-control"
                                data-error="Business name provided is invalid" placeholder=" Business Name"
                                value="Blu Constellation limited" required="required" type="text">
                            <div class="help-block form-text with-errors form-control-feedback">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for=""> <strong>Business Email</strong></label>
                                <input name="businessEmail" class="form-control"
                                    data-error="Business email provided is invalid" placeholder=" Business Email"
                                    value="hello@blu-constellationltd.com" required="required" type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for=""> <strong>Business Phone Number</strong></label>
                                <input name="businessPhone" class="form-control"
                                    data-error="Business phone number provided is invalid"
                                    placeholder=" Business Phone Number" value="08188664322" required="required"
                                    type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label for=""> <strong>Business Industry</strong></label>
                                <select id="businessIndustry" class="form-control" name="businessIndustry" disabled
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
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for=""> <strong>Business Website</strong></label>
                                <input name="businessWebsite" class="form-control"
                                    data-error="Business website provided is invalid" placeholder=" Business Website"
                                    value="https://blu-constellationltd.com" required="required" type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=""> <strong>Business Description</strong></label>
                            <textarea name="businessDescription" class="form-control" data-error="Business description provided is invalid"
                                placeholder=" Business Description" style="resize:none" rows="3">Information Technology Service Provider</textarea>
                            <div class="help-block form-text with-errors form-control-feedback">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><strong> Business Address</strong></label>
                            <input name="businessAddress" class="form-control"
                                data-error="Business address provided is invalid" placeholder=" Business Address"
                                value="1301 Akin Adesola Street, Victoria Island, Lagos - Nigeria" required="required"
                                type="text">
                            <div class="help-block form-text with-errors form-control-feedback">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 col-md-4">
                                <label for=""> <strong>Facebook URL</strong></label>
                                <input name="facebookURL" class="form-control"
                                    data-error="Facebook URL provided is invalid" placeholder="  Facebook URL"
                                    value="" required="required" type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for=""> <strong>Instagram URL</strong></label>
                                <input name="instagramURL" class="form-control"
                                    data-error="Instagram URL provided is invalid" placeholder="  Instagram URL"
                                    value="" required="required" type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for=""> <strong>X(Formerly Twitter) URL</strong></label>
                                <input name="xURL" class="form-control" data-error="X URL provided is invalid"
                                    placeholder="  X(Formerly Twitter) URL" value="" required="required"
                                    type="text">
                                <div class="help-block form-text with-errors form-control-feedback">
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('business.kyc.apply') }}?current=6">
                            <button type="button" class="btn btn-primary btn-block">Save & Continue</button>
                        </a>

                        <div class="center-button">
                            <a href="{{ route('business.kyc.apply') }}?current=6" class="skip">Skip to Support Information
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
