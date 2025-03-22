@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Dashboard')

<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Dashboard</h6>
                        <div class="custom-alert fade show custom-alert-primary">
                            <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                            &nbsp;Your Business is under Review!
                        </div>

                        <div class="element-content">
                            <h6>Profile Settings</h6>
                            <div class="row mt-2">
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('business.settings.profile') }}"
                                        style="text-decoration: none; color:#3E4B5B">
                                        <div class="element-box" style="padding: 0px">
                                            <div class="step-element sb" style="display: flex; gap: 20px; ">
                                                <div class="slc">
                                                    <img src="{{ asset('images/userProfile.svg') }}" class="sl">
                                                </div>
                                                <div>
                                                    <span class="sh">User Profile</span><br />
                                                    <span class="sd">Setup and manage user profile details.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="mt-3"></div>
                            <h6>Business Settings</h6>
                            <div class="row mt-2">
                                <div class="col-12 col-md-4">
                                    <div class="element-box" style="padding: 0px">
                                        <div class="step-element sb" style="display: flex; gap: 20px; ">
                                            <div class="slc">
                                                <img src="{{ asset('images/business.svg') }}" class="sl">
                                            </div>
                                            <div>
                                                <span class="sh">Your Business</span><br />
                                                <span class="sd">Provide business details and how we can reach
                                                    you.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <a href="{{ route('business.settings.settlement') }}"
                                    style="text-decoration: none; color:#3E4B5B">
                                        <div class="element-box" style="padding: 0px">
                                            <div class="step-element sb" style="display: flex; gap: 20px; ">
                                                <div class="slc">
                                                    <img src="{{ asset('images/settlement.svg') }}" class="sl">
                                                </div>
                                                <div>
                                                    <span class="sh">Settlement</span><br />
                                                    <span class="sd">Facilitates payments and payouts for your
                                                        platform.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                {{-- <div class="col-12 col-md-4">
                                    <div class="element-box" style="padding: 0px">
                                        <div class="step-element sb" style="display: flex; gap: 20px; ">
                                            <div class="slc">
                                                <img src="{{ asset("images/access.svg") }}" class="sl">
                                            </div>
                                            <div>
                                                <span class="sh">Access Management</span><br />
                                                <span class="sd">Manage user creation and administering access privileges.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="mt-3"></div>
                            <h6>Developer Settings</h6>
                            <div class="row mt-2">
                                <div class="col-12 col-md-4">
                                    <a href="{{ route('business.settings.apiKeys') }}"
                                        style="text-decoration: none; color:#3E4B5B">
                                        <div class="element-box" style="padding: 0px">
                                            <div class="step-element sb" style="display: flex; gap: 20px; ">
                                                <div class="slc">
                                                    <img src="{{ asset('images/api.svg') }}" class="sl">
                                                </div>
                                                <div>
                                                    <span class="sh">API Keys</span><br />
                                                    <span class="sd">Manage Application Programming Interface
                                                        Keys.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-12 col-md-4">
                                    <a href="{{ route('business.settings.webhooks') }}"
                                        style="text-decoration: none; color:#3E4B5B">
                                        <div class="element-box" style="padding: 0px">
                                            <div class="step-element sb" style="display: flex; gap: 20px; ">
                                                <div class="slc">
                                                    <img src="{{ asset('images/webhooks.svg') }}" class="sl">
                                                </div>
                                                <div>
                                                    <span class="sh">Webhooks</span><br />
                                                    <span class="sd">Choose Notification Preferences how you want to
                                                        be
                                                        contacted.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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
