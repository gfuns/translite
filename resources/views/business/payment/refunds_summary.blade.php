@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Refunds')

<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Refunds</h6>
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
                                            <a href="{{ route('business.refunds') }}?filter=summary"
                                                class="tabactive">
                                                <div class="tabtext">Summary</div>
                                            </a>
                                            <a href="{{ route('business.refunds') }}?filter=list"
                                                class="tabinactive">
                                                <div class="tabtext">Refunds List</div>
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
                                            <span class="atext">
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
                                        <div class="label" style="color:black; font-size: 12px"><strong>
                                                Processed Refunds</strong></div>

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
                                        <div class="label" style="color:black; font-size: 12px"><strong>Successful Refunds</strong></div>

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
                                        <div class="label" style="color:black; font-size: 12px"><strong>Pending Refunds</strong></div>

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
                                        <div class="label" style="color:black; font-size: 12px"><strong>Declined Refunds</strong></div>

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
        </div>
    </div>
</div>



@endsection
