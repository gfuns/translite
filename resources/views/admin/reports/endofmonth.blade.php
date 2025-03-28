@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <a href="{{ route('admin.reports') }}" class="back-to-home-label">
                            <i class="fas fa-arrow-left"></i> Back to Administrative Reports
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">End Of Month Report</div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('report.searchEndOfMonth') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>Select Month</strong></label>
                                                <select id="month" name="month" class="form-select" data-width="100%"
                                                    required>
                                                    <option value="">Select Month</option>
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">April</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>

                                                @error('month')
                                                    <span class="" role="alert">
                                                        <strong
                                                            style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>Select Year</strong></label>
                                                <select id="year" name="year" class="form-select" data-width="100%"
                                                    required>
                                                    <option value="">Select Year</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2024">2024</option>
                                                </select>

                                                @error('year')
                                                    <span class="" role="alert">
                                                        <strong
                                                            style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3 filterButton">
                                            <button type="submit" class="btn btn-primary btn-md">Filter
                                                Transactions</button>
                                        </div>
                                    </div>


                                </form>
                            </div>


                            <hr />
                            <h6 class="mt-4 ms-4"><strong>
                                    End Of Month Report For {{ $month }}, {{ $year }}
                                </strong></h6>
                            @if (isset($endOfMonth))
                                <div class="">
                                    <div class="p-4 col-md-12">
                                        <h6 class="mt-4 ms-4"><strong>
                                                A. UTILITY/BILL TRANSACTIONS</strong></h6>
                                        <table class="table table-hover table-centered table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Total Value Of Airtime Sold</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->airtime, 2) }} </td>
                                                    <th>Total Value Of Airtime Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->airtime_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Of Data Sold</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->data, 2) }} </td>
                                                    <th>Total Value Of Data Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->data_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Of Electricity Sold</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->electricity, 2) }} </td>
                                                    <th>Total Value Of Electricity Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->electricity_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Of TV Subscription Sold</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->tv, 2) }} </td>
                                                    <th>Total Value Of TV Subscription Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->tv_fees, 2) }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Total Value Of Utility/Bill Payment Transactions</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->total_utilities, 2) }} </td>
                                                    <th>Total Value Of Utility/Bill Payment Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->utility_fees, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="ps-4 pe-4 col-md-12">
                                        <h6 class="mt-4 ms-4"><strong>
                                                B. POS WITHDRAWAL TRANSACTIONS</strong></h6>
                                        <table class="table table-hover table-centered table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Total Value Of POS Withdrawals</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->pos_withdrawals, 2) }} </td>
                                                    <th>Total Value Of POS Withdrawal Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->withdrawal_fees, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="p-4 col-md-12">
                                        <h6 class="mt-4 ms-4"><strong>
                                                C. CUSTOMER TRANSFER TRANSACTIONS</strong></h6>
                                        <table class="table table-hover table-centered table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Total Value Of Inward Transfers</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->inward_transfer, 2) }} </td>
                                                    <th>Total Value Of Inward Transfer Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->inward_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Of Outward Transfers</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->outward_transfer, 2) }} </td>
                                                    <th>Total Value Of Outward Transfer Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->outward_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Transfer Transactions</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->total_transfers, 2) }} </td>
                                                    <th>Total Value Of Transfer Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->transfer_fees, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="p-4 col-md-12">
                                        <h6 class=" ms-4"><strong>
                                                D. GROSS TOTALS</strong></h6>
                                        <table class="table table-hover table-centered table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Total Value Of Transactions Across Board</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->total_transactions, 2) }}
                                                    </td>
                                                    <th>Total Value Of Fees Generated Across Board</th>
                                                    <td>&#8358; {{ number_format($endOfMonth->total_fees, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="bg-light text-center rounded p-5">
                                        <p><em class="far fa-sad-tear" style="font-size: 24px"></em><br> NO RECORD FOUND FOR
                                            THE SELECTED MONTH AND YEAR!</p>
                                    </div>
                                </div>
                            @endif

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
