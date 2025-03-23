@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Settings / Notifications')
<style type="text/css">
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
                        <h6 class="element-header">Settings / Notifications</h6>
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

                                            <a href="{{ route('business.settings.notifSettings') }}" class="tabactive">
                                                <div class="tabtext">Notifications</div>
                                            </a>

                                            <a href="{{ route('business.settings.bizReps') }}" class="tabinactive">
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
                                            <h5>Notification Settings! </h5>
                                            <div class="pencil" id="editSettings"><i class="fas fa-pencil-alt"></i>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="progress-container" style="padding-bottom: 25px">
                                            <form id="formValidate" method="post" action="">
                                                @csrf

                                                <div>
                                                    <div class="">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <span>Enable customer transaction receipts after
                                                                    transaction</span>
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

                                                    <div class="">
                                                        <div class="row" style="font-size: 14px; padding-top: 10px">
                                                            <div class="col-12 col-md-10 mb-2">
                                                                <span>Receive receipt notification after
                                                                    transactions</span>
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
<script src="{{ asset('js/notifications.js') }}?version=4.5.0"></script>

@endsection
