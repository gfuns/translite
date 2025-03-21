@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | POS Terminals')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">POS Terminals</h6>
                <div class="custom-alert fade show custom-alert-primary">
                    <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                    &nbsp;Your Business is under Review!
                </div>
                <div class="container nopadding">
                    <div class="row align-items-center">
                        <!-- All elements in a single row on desktop but stacked on mobile -->
                        <div class="col-12 d-md-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>
                                <div class="custombox" style="display: flex; gap: 10px">
                                    <a href="{{ route('business.pos.terminals') }}" class="tabactive">
                                        <div class="tabtext">Terminals</div>
                                    </a>
                                    <a href="{{ route('business.pos.branches') }}" class="tabinactive">
                                        <div class="tabtext">Branches</div>
                                    </a>

                                    <a href="{{ route('business.paymentTrxs') }}" class="tabinactive">
                                        <div class="tabtext">Transactions</div>
                                    </a>
                                </div>
                            </div>


                            <!-- Right: Dropdowns and Filter (Will stack on mobile) -->
                            <div class="d-flex flex-wrap gap-3">


                                <!-- Filter Button -->
                                <div class="custombox">
                                    <span class="atext">
                                        <a href="{{ route('business.pos.requests') }}" class="atext"><span
                                                class="os-icon os-icon-edit"></span> Terminal Requests</a>
                                    </span>&nbsp; | &nbsp;
                                    <span class="atext" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
                                        <span class="os-icon os-icon-filter"></span> Filter
                                    </span>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="element-box" style="padding: 1px">
                    <div class="noprod text-center">
                        <div><img src="{{ asset("images/emptyProd.png") }}" class="noprodimg"></div>
                        <h5>Your account is awaiting approval</h5>
                        Once your account has been approved, you will be able to request for a POS Terminal.
                    </div>
                    {{-- <div class="table-responsive">
                        <table id="" width="100%" class="table table-striped table-lightfont">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Terminal ID</th>
                                    <th>Terminal SNo</th>
                                    <th>Model</th>
                                    <th>IP Address</th>
                                    <th>Port No.</th>
                                    <th>Branch</th>
                                    <th>Date Assigned</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white">
                                    <td colspan="8">
                                        <div class="text-center rounded pdt-5x pdb-5x">
                                            <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No Terminal Found!
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title" id="offcanvasLabel">Filters</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fa fa-times"></i></button>
    </div>
    <div class="offcanvas-body">
        <!-- Add your filter form or content here -->
        <form method="POST" action="">
            @csrf
            <div class="mb-3">
                <label for="dateRange" class="form-label">Date Range</label>
                <input type="text" class="form-control" id="dateRange" placeholder="Select Date Range"
                    name="date_range">
            </div>

            <div class="mb-3">
                <label for="transId" class="form-label">Transaction ID</label>
                <input type="text" class="form-control" id="transId" placeholder="Transaction ID"
                    name="transaction_id">
            </div>
            <div class="mb-5">
                <label for="status" class="form-label">Status</label>
                <select id="status" class="form-control" name="status">
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-outline-primary" id="clearFilters"><i class="fa fa-trash"></i>
                    Clear Filters</button>
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </div>
        </form>
    </div>
</div>

@endsection
