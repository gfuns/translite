@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Transactions')

<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Transactions</h6>
                        <div class="custom-alert fade show custom-alert-primary">
                            <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                            &nbsp;Your Business is under Review!
                        </div>
                        <div class="container nopadding">
                            <div class="row align-items-center">
                                <!-- All elements in a single row on desktop but stacked on mobile -->
                                <div
                                    class="col-12 d-md-flex justify-content-between align-items-center flex-wrap gap-3">

                                    <div>
                                        <div class="custombox" style="display: flex; gap: 10px">
                                            <a href="{{ route('business.paymentTrxs') }}?filter=summary"
                                                class="tabactive">
                                                <div class="tabtext">Summary</div>
                                            </a>
                                            <a href="{{ route('business.paymentTrxs') }}?filter=list"
                                                class="tabinactive">
                                                <div class="tabtext">Transaction List</div>
                                            </a>
                                        </div>
                                    </div>


                                    <!-- Right: Dropdowns and Filter (Will stack on mobile) -->
                                    <div class="d-flex flex-wrap gap-3">

                                        <!-- Currency Dropdown -->
                                        <div class="dropdown">
                                            <div class="custombox dropdown-toggle" id="currencyDropdown"
                                                data-bs-toggle="dropdown">
                                                <span class="atext">NGN</span>
                                            </div>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">NGN</a></li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">USD</a></li>
                                            </ul>
                                        </div>

                                        <!-- Date Dropdown -->
                                        <div class="dropdown">
                                            <div class="custombox dropdown-toggle" id="dateDropdown"
                                                data-bs-toggle="dropdown">
                                                <span class="atext">Past 7 days: Mar 13 to Mar 20, 2025</span>
                                            </div>
                                            <ul class="dropdown-menu" aria-labelledby="dateDropdown">
                                                <li><a class="dropdown-item" href="#">Yesterday: Mar 19, 2025</a>
                                                </li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">Today: Mar 20, 2025</a></li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">Past 7 days: Mar 13 to Mar
                                                        20, 2025</a></li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">This Week: Mar 17 to Mar 20,
                                                        2025</a></li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">Last Week: Mar 17 to Mar 20,
                                                        2025</a></li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">This Month: Mar 17 to Mar
                                                        20,
                                                        2025</a></li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">Last Month: Mar 17 to Mar
                                                        20,
                                                        2025</a></li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">Custom Date Range</a></li>
                                            </ul>
                                        </div>

                                        <!-- Transaction Type Dropdown -->
                                        <div class="dropdown">
                                            <div class="custombox dropdown-toggle" id="typeDropdown"
                                                data-bs-toggle="dropdown">
                                                <span class="atext">Transaction Value</span>
                                            </div>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Transaction Value</a></li>
                                                <hr class="dropdown-divider">
                                                <li><a class="dropdown-item" href="#">Transaction Count</a></li>
                                            </ul>
                                        </div>

                                        <!-- Filter Button -->
                                        <div class="custombox">
                                            <span class="atext" data-bs-toggle="offcanvas"
                                                data-bs-target="#filterOffcanvas">
                                                <span class="os-icon os-icon-filter"></span> Filter
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="element-content">
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <a class="element-box el-tablo" href="#" style="padding:30px">
                                        <div class="label" style="color:black; font-size: 12px"><strong>Processed
                                                Transactions</strong></div>

                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-12">
                                                <span
                                                    style="font-size: 20px; color:#3E4B5B; ">&#8358;{{ number_format(0, 2) }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a class="element-box el-tablo" href="#" style="padding:30px">
                                        <div class="label" style="color:black; font-size: 12px"><strong>Successful
                                                Transactions</strong></div>

                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-12">
                                                <span
                                                    style="font-size: 20px; color:#3E4B5B; ">&#8358;{{ number_format(0, 2) }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a class="element-box el-tablo" href="#" style="padding:30px">
                                        <div class="label" style="color:black; font-size: 12px"><strong>Pending
                                                Transactions</strong></div>

                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-12">
                                                <span
                                                    style="font-size: 20px; color:#3E4B5B; ">&#8358;{{ number_format(0, 2) }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a class="element-box el-tablo" href="#" style="padding:30px">
                                        <div class="label" style="color:black; font-size: 12px"><strong>Declined
                                                Transactions</strong></div>

                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-12">
                                                <span
                                                    style="font-size: 20px; color:#3E4B5B; ">&#8358;{{ number_format(0, 2) }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="">Transactions Insight</h6>
                        <div class="element-box">
                            <canvas id="gasper" style="min-height: 250px;"></canvas>
                        </div>
                    </div>
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
