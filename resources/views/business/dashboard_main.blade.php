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


                        <div class="element-content">
                            <h6>Welcome to Back, {{ Auth::user()->firstName }} 👋</h6>

                            <div class="mt-5 d-flex justify-content-between">
                                <h5>Overview</h5>
                                <div class="flex-wrap justify-content-end gap-3">
                                    <div class="dropdown">
                                        <div class="dashbox dropdown-toggle" id="dateDropdown"
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
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-7">

                                    <div class="element-box" style="padding: 0px">
                                        <div class="revenuebox">

                                            <p>Processed transactions so far</p>
                                            <h5 class="revenue">&#8358;{{ number_format(305, 2) }}</h5>

                                            <a href="{{ route('business.paymentTrxs') }}"
                                                style="text-decoration: none">See More Transaction Data</a>
                                        </div>


                                        <div class="row metrics-container">
                                            <div class="col-4">Transactions Count<br /><span>8</span></div>
                                            <div class="col-4">Disputes<br /><span>0</span></div>
                                            <div class="col-4">Success Rate<br /><span class="poor">37.5% </span>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="mt-5 mb-5">

                                        <div class="d-flex justify-content-between">
                                            <h5>Transaction Channels</h5>
                                            <div class="flex-wrap justify-content-end gap-3">
                                                <div class="dropdown">
                                                    <div class="dashbox dropdown-toggle" id="dateDropdown"
                                                        data-bs-toggle="dropdown">
                                                        <span class="atext">Transaction Count</span>
                                                    </div>
                                                    <ul class="dropdown-menu" aria-labelledby="dateDropdown">
                                                        <li><a class="dropdown-item" href="#">Transaction
                                                                Count</a>
                                                        </li>
                                                        <hr class="dropdown-divider">
                                                        <li><a class="dropdown-item" href="#">Transaction
                                                                Value</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column flex-md-row" style="gap: 15px;">
                                            <div class="pmbox">
                                                <div style="display: flex; gap: 10px;">
                                                    <div> <canvas id="card"
                                                            style="width:50px; height: 5px;"></canvas></div>
                                                    <div>Card<br /><span>3</span></div>
                                                </div>
                                            </div>
                                            <div class="pmbox">
                                                <div style="display: flex; gap: 10px;">
                                                    <div> <canvas id="transfer"
                                                            style="width:50px; height: 5px;"></canvas></div>
                                                    <div>Bank Transfer<br /><span>0</span></div>
                                                </div>
                                            </div>
                                            <div class="pmbox">
                                                <div style="display: flex; gap: 10px;">
                                                    <div> <canvas id="ussd"
                                                            style="width:50px; height: 5px;"></canvas></div>
                                                    <div>USSD<br /><span>0</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="element-box" href="#" style="padding:20px">
                                        <p>Next Settlement</p>
                                        <h5 class="settlementval mt-3 mb-4">&#8358;{{ number_format(305, 2) }}</h5>
                                        <p class="mb-4">Payout will be done on Monday 24 March, 2025.</p>

                                        <div class="mb-3">
                                            <a href="{{ route('business.settlements') }}"
                                                style="text-decoration: none">See
                                                All Settlements</a>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <div class="element-box" href="#" style="padding:20px">
                                            <p>You're doing amazing!</p>
                                            <p class="mt-4 mb-5"><span class="settlementval">4</span> Transactions
                                                processed using TransLite</p>

                                            <div class="d-flex justify-content-between pb-2">
                                                <div>Let the world know.<br />
                                                    Share your progress now!</div>

                                                <button class="btn btn-outline-primary" id="clearFilters">Share <i
                                                        class="fas fa-share-alt"></i></button>
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
</div>

@endsection

@section('customjs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard.js') }}?version=4.5.0"></script>
@endsection
