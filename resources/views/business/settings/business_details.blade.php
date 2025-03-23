@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Settings / Business Details')
<style type="text/css">
    :disabled {
        background-color: white !important;
        cursor: not-allowed !important;
    }

    /* Target the Select2 dropdown when the original select is disabled */
    .select2-container--disabled .select2-selection {
        background-color: white !important;
        cursor: not-allowed !important;
    }
</style>
<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Settings / Business Details</h6>
                        <div class="custom-alert fade show custom-alert-primary">
                            <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                            &nbsp;Your Business is under Review!
                        </div>
                        <div class="element-content">

                            <div class="row mt-3">
                                <div class="col-12 col-md-7 nopadding">
                                    <div>
                                        <div class="custombox" style="display: flex; gap: 10px">
                                            <a href="{{ route('business.settings.businessType') }}" class="tabinactive">
                                                <div class="tabtext">Business Type</div>
                                            </a>
                                            <a href="{{ route('business.settings.about') }}"
                                                class="tabactive">
                                                <div class="tabtext">Business Details</div>
                                            </a>
                                            <a href="{{ route('business.settings.bizDocuments') }}"
                                                class="tabinactive">
                                                <div class="tabtext">KYC Documents</div>
                                            </a>

                                            <a href="{{ route('business.settings.notifSettings') }}"
                                                class="tabinactive">
                                                <div class="tabtext">Notifications</div>
                                            </a>

                                            <a href="{{ route('business.settings.bizReps') }}"
                                                class="tabinactive">
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
                                            <h5>Business Details! </h5>
                                            <div class="pencil" id="editConfiguration"><i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="progress-container" style="padding-bottom: 25px">
                                            <form id="formValidate" method="post" action="">
                                                @csrf

                                                <div class="row"
                                                    style="font-size: 14px; padding-top: 10px; margin-bottom:7px">
                                                    <div class="d-flex col-12 col-md-8 mb-2">
                                                        <div class="banklogo" style="margin-right:20px">
                                                            <img src="https://nigerianbanks.xyz/logo/first-city-monument-bank.png"
                                                                class="chakra-avatar__img css-3a5bz2">
                                                        </div>
                                                        <div style="margin-right:20px">
                                                            <strong>Blu Constellation Nigeria Limited</strong><br />
                                                            <span style="font-size: 12px"> 5915718010</span>
                                                        </div>
                                                        <div id="defat">
                                                            <label class="label labelinfo">Default</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <!-- Select Field -->
                                                            <div style="flex: 1;">
                                                                <select class="splitType select2 form-control"
                                                                    name="accounts[1][split_type]" disabled>
                                                                    <option value="Percentage">Percentage</option>
                                                                    <option value="Fixed">Fixed</option>
                                                                </select>
                                                            </div>

                                                            <!-- Input Field -->
                                                            <div style="flex: 1; margin-left: 0px;">
                                                                <input type="text" name="accounts[1][split_value]"
                                                                    class="form-control splitValue" value="100"
                                                                    disabled />
                                                            </div>
                                                        </div>

                                                        <!-- Default Checkbox -->
                                                        <div class="defatchk" style="display: none;">
                                                            <div class="defcheckbox-container mt-2">
                                                                <input name="accounts[1][default_status]"
                                                                    class="def-checkbox" type="checkbox" checked
                                                                    disabled>
                                                                <div>
                                                                    <div class="def-description">Set as default</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="row" style="font-size: 14px; padding-top: 10px;">
                                                    <div class="d-flex col-12 col-md-8 mb-2">
                                                        <div class="banklogo" style="margin-right:20px">
                                                            <img src="https://nigerianbanks.xyz/logo/access-bank.png"
                                                                class="chakra-avatar__img css-3a5bz2">
                                                        </div>
                                                        <div style="margin-right:20px">
                                                            <strong>Blu Constellation Nigeria Limited</strong><br />
                                                            <span style="font-size: 12px"> 5915718010</span>
                                                        </div>
                                                        {{-- <div id="defat">
                                                            <label class="label labelinfo">Default</label>
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-12 col-md-4 mb-2">
                                                        <div class="d-flex align-items-center">
                                                            <!-- Select Field -->
                                                            <div style="flex: 1;">
                                                                <select class="splitType select2 form-control"
                                                                    name="accounts[1][split_type]" disabled>
                                                                    <option value="Percentage">Percentage</option>
                                                                    <option value="Fixed">Fixed</option>
                                                                </select>
                                                            </div>

                                                            <!-- Input Field -->
                                                            <div style="flex: 1; margin-left: 0px;">
                                                                <input type="text" name="accounts[2][split_value]"
                                                                    class="form-control splitValue" value="0"
                                                                    disabled />
                                                            </div>
                                                        </div>

                                                        <!-- Default Checkbox -->
                                                        <div class="defatchk" style="display: none;">
                                                            <div class="defcheckbox-container mt-2">
                                                                <input name="accounts[2][default_status]"
                                                                    class="def-checkbox" type="checkbox" disabled>
                                                                <div>
                                                                    <div class="def-description">Set as default</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr />
                                                <div class="mt-5"></div>
                                                <h6>Settlement Schedule</h6>
                                                <hr />
                                                <div>
                                                    <div class="">
                                                        <div class="row"
                                                            style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <span>Frequency</span>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <select id="frequency" name="frequency"
                                                                    class="freq" disabled>
                                                                    <option value="Next Day">Next Day</option>
                                                                    <option value="Weekly">Weekly</option>
                                                                    <option value="Monthly">Monthly</option>
                                                                </select>
                                                                <div class="checkbox-container mt-2">
                                                                    <input class="freq-checkbox" type="checkbox"
                                                                        disabled>
                                                                    <div>
                                                                        <div class="freq-description">Hold Settlement
                                                                            Until</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="fixedSetDate" class="" style="display: none">
                                                        <div class="row"
                                                            style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <span>Hold Settlement Until</span>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <input name="settlement_date"
                                                                    class="form-control freqdate" type="date">
                                                                <span style="font-size:12px">Settlements will be
                                                                    withheld until the date set above</span>
                                                            </div>
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


<div aria-hidden="true" aria-labelledby="addSplitAccount" class="modal fade" id="addSplitAccount" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add account to split configuration
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
                                <label for="">Select Settlement Account</label>
                                <select id="bankSelect" name="bank" required>
                                    <option value="">Select Bank</option>
                                    <option value="1" data-image="https://nigerianbanks.xyz/logo/access-bank.png" data-subtext="2225408265">Osatare Idemudia</option>
                                    <option value="2" data-image="https://nigerianbanks.xyz/logo/first-bank-of-nigeria.png" data-subtext="3333445566">Justin Odogwu</option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Cancel</button>
                    <button class="btn btn-primary" type="submit" style="font-size: 12px">
                        Add Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('customjs')
<script src="{{ asset('js/settlement.js') }}?version=4.5.0"></script>

@endsection
