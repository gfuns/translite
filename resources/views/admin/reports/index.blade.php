@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Administrative Reports</h4>
                            </div>
                        </div>
                        <div class="card-body" style="min-height: 500px">
                            <div class="row">

                                <div class="col-lg-4 col-12 mb-5" style="font-size: 12px;">
                                    <div>
                                        <fieldset>
                                            <legend>
                                                <h6 class=" fw-bold text-left">Customer Reports</h6>
                                            </legend>
                                            <div class="list-group" style="border: 1px solid #dee2e6 !important">
                                                <a class="list-group-item" href="{{ route("report.customerAccounts") }}">1. Customer Accounts</a>
                                                <a class="list-group-item" href="{{ route("report.customerBusinesses") }}">2. Customer Businesses</a>
                                                <a class="list-group-item" href="{{ route("report.customerTermimals") }}">3. Customer Terminals</a>
                                            </div>
                                        </fieldset>

                                    </div>

                                    <div class="mt-5">
                                        <fieldset>
                                            <legend>
                                                <h6 class=" fw-bold text-left">Utility Transactions</h6>
                                            </legend>
                                            <div class="list-group" style="border: 1px solid #dee2e6 !important">
                                                <a class="list-group-item" href="{{ route("report.utilityTrxs", ["Airtime"]) }}">1. Airtime Purchases </a>
                                                <a class="list-group-item" href="{{ route("report.utilityTrxs", ["Data"]) }}">2. Data Subscriptions</a>
                                                <a class="list-group-item" href="{{ route("report.utilityTrxs", ["Power"]) }}">3. Electricity Purchases</a>
                                                <a class="list-group-item" href="{{ route("report.utilityTrxs", ["TV"]) }}">4. TV Subscriptions</a>
                                                <a class="list-group-item" href="{{ route("report.utilityTrxs") }}">5. All Utility Transactions</a>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 mb-5" style="font-size: 12px;">
                                    <div>
                                        <fieldset>
                                            <legend>
                                                <h6 class=" fw-bold text-left">Transfer Reports</h6>
                                            </legend>
                                            <div class="list-group" style="border: 1px solid #dee2e6 !important">
                                                <a class="list-group-item" href="{{ route("report.customerTransfers", [1]) }}">1. Inward Transfers</a>
                                                <a class="list-group-item" href="{{ route("report.customerTransfers", [0]) }}">2. Outward Transfers</a>
                                                <a class="list-group-item" href="{{ route("report.customerTransfers") }}">3. All Transfer Transactions</a>
                                            </div>
                                        </fieldset>
                                    </div>


                                    <div class="mt-5">
                                        <fieldset>
                                            <legend>
                                                <h6 class=" fw-bold text-left">Financials & Ledgers</h6>
                                            </legend>
                                            <div class="list-group" style="border: 1px solid #dee2e6 !important">
                                                <a class="list-group-item" href="{{ route("report.endOfDay") }}">1. End Of Day Reports</a>
                                                <a class="list-group-item" href="{{ route("report.endOfMonth") }}">2. End Of Month Reports</a>
                                                <a class="list-group-item" href="{{ route("report.endOfYear") }}">3. End Of Year Reports</a>
                                            </div>
                                        </fieldset>
                                    </div>


                                </div>

                                <div class="col-lg-4 col-12 mb-5" style="font-size: 12px;">
                                    <div>
                                        <fieldset>
                                            <legend>
                                                <h6 class=" fw-bold text-left">Withdrawal Transactions</h6>
                                            </legend>
                                            <div class="list-group" style="border: 1px solid #dee2e6 !important">
                                                <a class="list-group-item"
                                                    href="{{ route('report.posWithdrawals', [1]) }}">1. Successful POS
                                                    Withdrawals</a>
                                                <a class="list-group-item"
                                                    href="{{ route('report.posWithdrawals', [0]) }}">2. Failed POS
                                                    Withdrawals</a>
                                                <a class="list-group-item"
                                                    href="{{ route('report.posWithdrawals', [2]) }}">3. Reversed POS
                                                    Withdrawals</a>
                                                <a class="list-group-item" href="{{ route('report.posWithdrawals') }}">4.
                                                    All POS Withdrawals</a>
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="mt-5">
                                        <fieldset>
                                            <legend>
                                                <h6 class=" fw-bold text-left">Terminal Reports</h6>
                                            </legend>
                                            <div class="list-group" style="border: 1px solid #dee2e6 !important">
                                                <a class="list-group-item" href="{{ route('report.terminals', [1]) }}">1.
                                                    Assigned Terminals</a>
                                                <a class="list-group-item" href="{{ route('report.terminals', [0]) }}">2.
                                                    Unassigned Terminals</a>
                                                <a class="list-group-item" href="{{ route('report.terminals') }}">3. All
                                                    Terminals</a>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>


                                <div class="col-lg-4 col-12 mb-5" style="font-size: 12px;">
                                    <div>
                                        <fieldset>
                                            <legend>
                                                <h6 class=" fw-bold text-left">Authentication & Audit Trail Reports</h6>
                                            </legend>
                                            <div class="list-group" style="border: 1px solid #dee2e6 !important">
                                                <a class="list-group-item" href="{{ route('report.userAuths') }}">1.
                                                    Authentication Report </a>
                                                <a class="list-group-item"
                                                    href="{{ route('report.auditTrailReport') }}">2. Audit Trail Report</a>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>


                            </div>

                            <div class="row">


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        document.getElementById("reports").classList.add('active');
    </script>
@endsection
