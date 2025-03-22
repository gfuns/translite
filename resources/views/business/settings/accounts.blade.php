@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Settings / Settlement Accounts')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">Settings / Settlement Accounts </h6>
                <div class="custom-alert fade show custom-alert-primary">
                    <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                    &nbsp;Your Business is under Review!
                </div>
                <div class="container nopadding">
                    <div class="row align-items-center">
                        <!-- All elements in a single row on desktop but stacked on mobile -->
                        <div
                            class="col-12 d-md-flex justify-content-between align-items-center flex-wrap gap-3 nopadding">

                            <div class="custombox" style="display: flex; gap: 10px">
                                <a href="{{ route('business.settings.settlement') }}" class="tabinactive">
                                    <div class="tabtext">Default Settlement Configuration</div>
                                </a>
                                <a href="{{ route('business.settings.dynamicSettlement') }}" class="tabinactive">
                                    <div class="tabtext">Dynamic Settlement Configuration</div>
                                </a>
                                <a href="{{ route('business.settings.settlementAccounts') }}" class="tabactive">
                                    <div class="tabtext">Settlement Accounts</div>
                                </a>
                            </div>


                            <!-- Right: Dropdowns and Filter (Will stack on mobile) -->
                            <div class="d-flex flex-wrap gap-3">


                                <!-- Filter Button -->
                                <div class="custombox" style="margin-right: 10px" data-toggle="modal"
                                    data-target="#createAccount" data-backdrop="static" data-keyboard="false">
                                    <span class="atext">
                                        <i class="far fa-plus-square" style="font-size: 12px"></i> Create Account
                                    </span>&nbsp;

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="element-box" style="padding: 1px">
                    <div class="table-responsive">
                        <table id="" width="100%" class="table table-striped table-lightfont">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>Bank</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white">
                                    <td colspan="8">
                                        <div class="text-center rounded pdt-5x pdb-5x">
                                            <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No
                                                Settlement Account Found!
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div aria-hidden="true" aria-labelledby="createAccount" class="modal fade" id="createAccount" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add a new settlement bank account
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true"> &times;</span>
                </button>
            </div>
            <form method="post" action="">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Currency</label>
                                <select id="selcurrency" name="currency" required>
                                    <option value="">Select Currency</option>
                                    <option value="NGN">Naira</option>
                                    <option value="USD">US Dollar</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Bank</label>
                                <select id="bank" name="bank" required>
                                    <option value="">Select Bank</option>
                                    <option value="1" data-image="https://nigerianbanks.xyz/logo/access-bank.png">Access Bank</option>
                                    <option value="2" data-image="https://nigerianbanks.xyz/logo/first-bank-of-nigeria.png">First Bank</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Account Number</label>
                                <input type="text" name="account_number" value="" placeholder="Account Number"
                                    class="form-control" required />

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Account Name</label>
                                <input type="text" name="account_name" value="" placeholder="Account Name"
                                    class="form-control" readonly required />

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit" style="font-size:13px">Add New Settlement
                        Bank Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
