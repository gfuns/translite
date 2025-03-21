@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Settings / User Profile')

<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Settings / User Profile</h6>

                        <div class="element-content">

                            <div class="row mt-3">
                                <div class="col-12 col-md-7">


                                    <div class="element-box" style="padding: 0px">
                                        <div class="eb d-flex justify-content-between">
                                            <h5>User Profile! </h5>
                                            <div class="pencil" id="editProfile"><i class="fas fa-pencil-alt"></i></div>
                                        </div>
                                        <hr />
                                        <div class="progress-container" style="padding-bottom: 25px">
                                            <form id="formValidate" method="post" action="">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-12 col-md-6">
                                                        <label for=""> First Name</label>
                                                        <input name="firstName" class="form-control"
                                                            data-error="Face name provided is invalid"
                                                            placeholder=" First Name"
                                                            value="{{ Auth::user()->firstName }}" required="required"
                                                            type="text" readonly>
                                                        <div
                                                            class="help-block form-text with-errors form-control-feedback">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12 col-md-6">
                                                        <label for=""> Last Name</label>
                                                        <input name="lastName" class="form-control"
                                                            data-error="Last name provided is invalid"
                                                            placeholder=" Last Name"
                                                            value="{{ Auth::user()->lastName }}" required="required"
                                                            type="text" readonly>
                                                        <div
                                                            class="help-block form-text with-errors form-control-feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""> Email Address</label>
                                                    <input name="email" class="form-control"
                                                        data-error="Email provided is invalid"
                                                        placeholder=" Email Address" value="{{ Auth::user()->email }}"
                                                        required="required" type="email" readonly>
                                                    <div class="help-block form-text with-errors form-control-feedback">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""> Phone Number</label>
                                                    <input name="password_confirmation" class="form-control"
                                                        data-error="Phone number provided is invalid"
                                                        placeholder=" Phone Number"
                                                        value="{{ Auth::user()->phoneNumber }}" required="required"
                                                        type="text" readonly>
                                                    <div class="help-block form-text with-errors form-control-feedback">
                                                    </div>
                                                </div>
                                                <div class="form-group mt-4">
                                                    <div class="d-flex justify-content-between">
                                                        <div> Password</div>
                                                        <div><a href="#" data-toggle="modal"
                                                                data-target="#changePassword" data-backdrop="static"
                                                                data-keyboard="false">Change Password</a></div>
                                                    </div>
                                                </div>
                                                <div class="form-buttons-w">
                                                    <div class="d-flex justify-content-between">
                                                        <div> Two-Factor Authentication</div>
                                                        <div>
                                                            <label class="toggle-switch" data-toggle="modal"
                                                                data-target="#twoFA" data-backdrop="static"
                                                                data-keyboard="false">
                                                                <input type="checkbox" disabled>
                                                                <span class="slider"></span>
                                                            </label>
                                                            Disabled
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="buttons" class="form-buttons-w" style="display: none">
                                                    <div class="d-flex justify-content-between">
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            id="clearFilters">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            Changes</button>
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


<div aria-hidden="true" aria-labelledby="changePassword" class="modal fade" id="changePassword" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Change Password
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true"> &times;</span>
                </button>
            </div>
            <form method="post" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 password-toggle">
                            <div class="form-group">
                                <label for="">Old Password</label>
                                <input id="password" type="password" name="old_password" value=""
                                    placeholder="Old Password" class="form-control" required />
                                <span class="toggle-password" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye"></i>
                            </div>
                        </div>

                        <div class="col-sm-12 password-toggle">
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input id="password2" type="password" name="password" value=""
                                    placeholder="New Password" class="form-control" required />
                                <span class="toggle-password-2" onclick="togglePassword2Visibility()">
                                    <i class="fas fa-eye"></i>
                            </div>
                        </div>

                        <div class="col-sm-12 password-toggle">
                            <div class="form-group">
                                <label for="">New Password Confirmation</label>
                                <input id="password3" type="password" name="password_confirmation" value=""
                                    placeholder="New Password Confirmation" class="form-control" required />
                                <span class="toggle-password-3" onclick="togglePassword3Visibility()">
                                    <i class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Cancel</button>
                    <button class="btn btn-primary" type="submit">
                        Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div aria-hidden="true" aria-labelledby="twoFA" class="modal fade" id="twoFA" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true"> &times;</span>
                </button>
            </div>

            <form action="" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center card-title mb-4" style="color: black">Two Factor Authentication Setup
                    </h4>
                    <p style="color: black"><strong>Step 1:</strong> Download and Install the free Google Authenticator
                        app from <br /><a target="_blank"
                            href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">Google
                            Play Store</a> or <a target="_blank"
                            href="https://itunes.apple.com/us/app/google-authenticator/id388497605">Apple
                            Store</a>.</p>
                    <p style="color: black">
                        <strong>Step 2:</strong> Scan the below QR code using the Google Authenticator
                        app, or you can add account manually.
                    </p>
                    <p style="color: black">
                        <strong>Manually add Account:</strong><br>
                        <strong class="text-head">Account Name:</strong> &nbsp;
                        {{ env('APP_NAME') }} <br>
                        <strong class="text-head">Secret Key:</strong> &nbsp; {{ $google2faSecret }}
                    </p>
                    <div class="row" style="padding: 0px; margin:0px">
                        <!-- form group -->
                        <div class="col-md-4 col-12">
                            <div style="width: 150px; display: flex; overflow: hidden;">
                                {!! $QRImage !!}
                            </div>
                        </div>

                        {{-- <div class="col-md-4 col-12" style="padding: 0px; margin:0px;">
                            <div style="width:20px; border: 1px solid red">
                                {!! $QRImage !!}
                            </div>
                        </div> --}}
                        <div class="mb-3 col-md-8 col-12">
                            <div class="input-item mb-2">
                                <label for="google2fa_code" style="color: black"><strong>Enter Google Authenticator
                                        Code</strong></label>
                                <input id="google2fa_code" type="text" class="form-control" name="google2fa_code"
                                    required maxlength="6" data-msg-required="Required."
                                    data-msg-maxlength="Maximum 6 chars."
                                    placeholder="Enter the Google Authenticator Code">
                            </div>
                            <input type="hidden" name="google2fa_secret" value="{{ $google2faSecret }}">
                            <button type="submit" class="btn btn-primary btn-sm enable-2fa">Enable
                                Google
                                Authenticator</button>
                        </div>
                    </div>

                    <p class="p-3 text-danger">
                        <strong>Note:</strong> After activating this option, if
                        you loose your phone or uninstall the Google Authenticator app, then you will
                        loose access of your account.
                    </p>
                    <!--end col-->


                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('customjs')
<script src="{{ asset('js/profile.js') }}?version=4.5.0"></script>
@endsection
