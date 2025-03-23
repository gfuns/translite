@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Settings / Payments')
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

    .customer-receipt input:disabled+.slider,
    .customer-receipt input:disabled {
        cursor: not-allowed !important;
    }
</style>
<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Settings / Payments</h6>
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
                                            <a href="{{ route('business.settings.about') }}" class="tabinactive">
                                                <div class="tabtext">Business Details</div>
                                            </a>
                                            <a href="{{ route('business.settings.bizDocuments') }}" class="tabinactive">
                                                <div class="tabtext">KYC Documents</div>
                                            </a>

                                            <a href="{{ route('business.settings.notifSettings') }}"
                                                class="tabinactive">
                                                <div class="tabtext">Notifications</div>
                                            </a>

                                            <a href="{{ route('business.settings.bizReps') }}" class="tabinactive">
                                                <div class="tabtext">Representatives</div>
                                            </a>

                                            <a href="{{ route('business.settings.paymentSettings') }}"
                                                class="tabactive">
                                                <div class="tabtext">Payment</div>
                                            </a>
                                        </div>
                                    </div>


                                    <div class="element-box" style="padding: 0px">
                                        <div class="eb d-flex justify-content-between">
                                            <h5>Payments Settings! </h5>
                                            <div class="pencil" id="editSettings"><i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="progress-container" style="padding-bottom: 25px">
                                            <form id="formValidate" method="post" action="">
                                                @csrf

                                                <div>
                                                    <div class="bb">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <strong>Cards<strong><br />
                                                                        <small>Visa, Mastercard, Discover, Verve.
                                                                        </small>
                                                            </div>
                                                            <div class="col-12 col-md-2 mb-2">
                                                                <div>
                                                                    <label class="customer-receipt">
                                                                        <input type="checkbox" checked disabled>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <hr /> --}}
                                                    <div class="bb">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <strong>Bank Transfer<strong><br />
                                                                        <small>GTB, Zenith bank, First bank, and lots
                                                                            more. </small>
                                                            </div>
                                                            <div class="col-12 col-md-2 mb-2">
                                                                <div>
                                                                    <label class="customer-receipt">
                                                                        <input type="checkbox" disabled>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bb">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <strong>USSD<strong><br />
                                                                        <small>GTB, Zenith bank, First bank, Stanbic
                                                                            IBTC, Access bank and lots more.</small>
                                                            </div>
                                                            <div class="col-12 col-md-2 mb-2">
                                                                <div>
                                                                    <label class="customer-receipt">
                                                                        <input type="checkbox" disabled>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bb">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <strong>Pay with XtrapayPOS<strong><br />
                                                                        <small>Allows you to accept Xtrapay wallet
                                                                            payment</small>
                                                            </div>
                                                            <div class="col-12 col-md-2 mb-2">
                                                                <div>
                                                                    <label class="customer-receipt">
                                                                        <input type="checkbox" disabled>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bb">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <strong>Pay With Bank Branch<strong><br />
                                                                        <small>Allows you to accept payment using the
                                                                            TransLite Reference Number (TLRN) in any
                                                                            Commercial or Microfinance Bank.</small>
                                                            </div>
                                                            <div class="col-12 col-md-2 mb-2">
                                                                <div>
                                                                    <label class="customer-receipt">
                                                                        <input type="checkbox" disabled>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bb">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <strong>Should credo fees be added to the customer’s
                                                                    price during purchase?<strong>
                                                            </div>
                                                            <div class="col-12 col-md-2 mb-2">
                                                                <div>
                                                                    <label class="customer-receipt">
                                                                        <input type="checkbox" disabled>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bb">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <strong>Enable cancel button<strong>
                                                            </div>
                                                            <div class="col-12 col-md-2 mb-2">
                                                                <div>
                                                                    <label class="customer-receipt">
                                                                        <input type="checkbox" disabled>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bb">
                                                        <div class="row"
                                                            style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <strong>Redirect on error<strong>
                                                            </div>
                                                            <div class="col-12 col-md-2 mb-2">
                                                                <div>
                                                                    <label class="customer-receipt">
                                                                        <input type="checkbox" disabled>
                                                                        <span class="slider"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bb">
                                                        <div class="row"
                                                            style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 mb-2">
                                                                <strong>Default currency<strong>
                                                            </div>
                                                            <div class="col-12 mb-2 defcur">
                                                                <select id="currency" name="currency" disabled>
                                                                    <option value="NGN">NGN</option>
                                                                    <option value="USD">USD</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bb">
                                                        <div class="row"
                                                            style="font-size: 14px; padding-top: 10px;">
                                                            <div class="col-12 mb-2">
                                                                <strong>Default Callback URL<strong>
                                                            </div>
                                                            <div class="col-12 mb-2">
                                                                <div class="defcallba">
                                                                    <input name="default_callback"
                                                                        placeholder="Default Callback URL"
                                                                        class="form-control" type="text" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div id="buttons" class="form-buttons-w" style="display: none">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            id="cancelEdit">Cancel</button>
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

@endsection


@section('customjs')
<script src="{{ asset('js/payments.js') }}?version=4.5.0"></script>

@endsection
