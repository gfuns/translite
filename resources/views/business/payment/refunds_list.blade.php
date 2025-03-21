@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Refunds')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
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
                                        class="tabinactive">
                                        <div class="tabtext">Summary</div>
                                    </a>
                                    <a href="{{ route('business.refunds') }}?filter=list"
                                        class="tabactive">
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

                                <!-- Filter Button -->
                                <div class="custombox">
                                    <span class="atext">
                                        <span class="os-icon os-icon-filter"></span> Filter
                                    </span> &nbsp; | &nbsp;
                                    <span class="atext">
                                        <a href="" class="atext"><span class="os-icon os-icon-download"></span> Download</a>
                                    </span>
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
                                    <th>Trans. Date</th>
                                    <th>Trans. ID</th>
                                    <th>Refund Type</th>
                                    <th>Reason</th>
                                    <th>Trans. Amount</th>
                                    <th>Refunded Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white">
                                    <td colspan="8">
                                        <div class="text-center rounded pdt-5x pdb-5x">
                                            <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No Refund Transaction Found!
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

@endsection
