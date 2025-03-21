@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Settings / API Keys')

<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Settings / API Keys</h6>
                        <div class="custom-alert fade show custom-alert-primary">
                            <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                            &nbsp;Your Business is under Review!
                        </div>
                        <div class="element-content">

                            <div class="row mt-3">
                                <div class="col-12 col-md-8">
                                    <div class="element-box" style="padding: 0px">
                                        <div class="eb">
                                            <h6>API Documentation </h6>
                                            <p style="font-size: 12px">Our documentation contains the Libraries, APIs
                                                you need to integrate TransLite in your projects to start collecting
                                                payment.</p>
                                            <button class="btn devbtn">Go To API Docs <svg width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.5332 12.1833L16.6665 10.05L14.5332 7.91666"
                                                        stroke="#0765FF" stroke-width="1.5" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M8.13281 10.05H16.6078" stroke="#0765FF" stroke-width="1.5"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path
                                                        d="M9.79948 16.6667C6.11615 16.6667 3.13281 14.1667 3.13281 10C3.13281 5.83334 6.11615 3.33334 9.79948 3.33334"
                                                        stroke="#0765FF" stroke-width="1.5" stroke-miterlimit="10"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 mt-2">
                                    <div class="element-box" style="padding: 0px">
                                        <div class="eb">
                                            <h6>Accessing Test or Demo Environment for TransLite </h6>
                                            <p style="font-size: 12px">Are you looking to test your integration before
                                                going live or even just to play around before fully setting up on credo,
                                                you can access our demo environment following these steps:</p>
                                            <ul class="uld" style="padding:5px">
                                                <li class="devstep">
                                                    <div style="display: flex; gap: 20px;">
                                                        <div>
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" fill="#ECF2FF"></rect>
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" stroke="#0765FF"></rect>
                                                                <path d="M4.5 8H11.5" stroke="#0765FF"
                                                                    stroke-width="1.66666" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div>Go to <a href="#">www.translitedemo.com</a></div>
                                                    </div>
                                                </li>
                                                <li class="devstep">
                                                    <div style="display: flex; gap: 20px;">
                                                        <div>
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" fill="#ECF2FF"></rect>
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" stroke="#0765FF"></rect>
                                                                <path d="M4.5 8H11.5" stroke="#0765FF"
                                                                    stroke-width="1.66666" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div>Sign up and create an account (No need to activate
                                                            the account when you have signed in)</div>
                                                    </div>
                                                </li>
                                                <li class="devstep">
                                                    <div style="display: flex; gap: 20px;">
                                                        <div>
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" fill="#ECF2FF"></rect>
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" stroke="#0765FF"></rect>
                                                                <path d="M4.5 8H11.5" stroke="#0765FF"
                                                                    stroke-width="1.66666" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div>Go to the settings menu</div>
                                                    </div>
                                                </li>
                                                <li class="devstep">
                                                    <div style="display: flex; gap: 20px;">
                                                        <div>
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" fill="#ECF2FF"></rect>
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" stroke="#0765FF"></rect>
                                                                <path d="M4.5 8H11.5" stroke="#0765FF"
                                                                    stroke-width="1.66666" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div>Go to API Keys</div>
                                                    </div>
                                                </li>
                                                <li class="devstep">
                                                    <div style="display: flex; gap: 20px;">
                                                        <div>
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" fill="#ECF2FF"></rect>
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" stroke="#0765FF"></rect>
                                                                <path d="M4.5 8H11.5" stroke="#0765FF"
                                                                    stroke-width="1.66666" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div>Copy your Test keys to start testing your integration
                                                            (Note: the base URL is <a
                                                                href="#">https://api.translitedemo.com</a>)</div>
                                                    </div>
                                                </li>
                                                <li class="devstep">
                                                    <div style="display: flex; gap: 20px;">
                                                        <div>
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" fill="#ECF2FF"></rect>
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" stroke="#0765FF"></rect>
                                                                <path d="M4.5 8H11.5" stroke="#0765FF"
                                                                    stroke-width="1.66666" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div>When you are done testing, go to your translite account to
                                                            get your
                                                            live keys and the test keys</div>
                                                    </div>
                                                </li>
                                                <li class="devstep">
                                                    <div style="display: flex; gap: 20px;">
                                                        <div>
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" fill="#ECF2FF"></rect>
                                                                <rect x="0.5" y="0.5" width="15" height="15"
                                                                    rx="3.5" stroke="#0765FF"></rect>
                                                                <path d="M4.5 8H11.5" stroke="#0765FF"
                                                                    stroke-width="1.66666" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                        </div>
                                                        <div>If you encounter any issues or you have feedback for us,
                                                            you can
                                                            reach us at hello@translite.com</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8 mt-2">
                                    <div class="element-box" style="padding: 0px">
                                        <div class="eb">
                                            <h6>API Keys </h6>
                                            <div class="row">
                                                <div class="col-12 col-md-8 mb-4" style="font-size: 12px">These keys
                                                    will allow you
                                                    to authenticate API
                                                    requests and should only be used in the live environment.</div>
                                                <div class="col-12 col-md-4 mb-4 d-md-flex justify-content-end " style="font-size: 12px"
                                                    data-toggle="modal" data-target="#genKey" data-backdrop="static"
                                                    data-keyboard="false">
                                                    <span class="genkey"> <svg xmlns="http://www.w3.org/2000/svg"
                                                            width="20" height="20" viewBox="0 0 20 20"
                                                            fill="none">
                                                            <path
                                                                d="M16.6667 9.1665H18.3334C17.9142 4.9554 14.3525 1.6665 10.0207 1.6665C5.40694 1.6665 1.66675 5.39746 1.66675 9.99984C1.66675 14.6022 5.40694 18.3332 10.0207 18.3332C13.4463 18.3332 16.3904 16.2763 17.6796 13.3332"
                                                                stroke="#141B34" stroke-width="1.25"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path
                                                                d="M11.8749 9.15216V7.65891C11.8749 6.65076 11.0354 5.8335 9.99992 5.8335C8.96442 5.8335 8.12492 6.65076 8.12492 7.65891V9.15216M9.99992 14.1668C8.38909 14.1668 7.08325 12.8955 7.08325 11.3273C7.08325 9.75908 8.38909 8.48775 9.99992 8.48775C11.6108 8.48775 12.9166 9.75908 12.9166 11.3273C12.9166 12.8955 11.6108 14.1668 9.99992 14.1668Z"
                                                                stroke="#141B34" stroke-width="1.25"
                                                                stroke-linecap="round"></path>
                                                        </svg> Regenerate Keys </span>
                                                </div>
                                            </div>

                                            <div class="keydisplay">
                                                <div class="row" style="font-size: 14px; padding-top: 10px">
                                                    <div class="col-12 col-md-6 mb-2">
                                                        <span id="publicKey">{{ $publicKey }}</span>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <label class="label labelpk">Publishable Key</label>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <i class="fas fa-copy copy"
                                                            onclick="copyToClipboard('publicKey')"></i>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row" style="font-size: 14px; padding-bottom: 10px">
                                                    <div class="col-12 col-md-6 mb-2">
                                                        <span id="secretKey" data-key="{{ $secretKey }}"
                                                            class="masked">{{ $secretKey }}</span>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <label class="label labelsk">Secret Key</label>
                                                    </div>
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <i class="fas fa-copy copy"
                                                            style="font-size:18px; margin-right:15px;"
                                                            onclick="copyToClipboard('secretKey')"></i>
                                                        <i class="fas fa-eye copy" id="toggleSecretKey"
                                                            onclick="toggleSecret()"></i>
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
        </div>
    </div>
</div>


<div aria-hidden="true" aria-labelledby="genKey" class="modal fade" id="genKey" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-top modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Generate new Secret Keys
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true"> &times;</span>
                </button>
            </div>
            <form method="post" action="">
                @csrf
                <div class="modal-body">
                    <p>This action will cause both your live and test secret keys to expire. You’ll have to update
                        your website and servers with the new keys to continue processing API calls through TransLite
                    </p>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Cancel</button>
                    <button class="btn btn-primary" type="submit" style="font-size: 12px">
                        Generate New Secret Keys
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('customjs')
<script src="{{ asset('js/apikeys.js') }}?version=4.5.0"></script>
@endsection
