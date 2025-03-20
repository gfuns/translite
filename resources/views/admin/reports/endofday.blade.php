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
                            <div class="card-title">End Of Day Report</div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('report.searchEndOfDay') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>Select Date</strong></label>
                                                <input type="date" name="date" class="form-control"
                                                    placeholder="Select Date" required>

                                                @error('date')
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
                                    End Of Day Report For {{ date_format($date, 'jS F, Y') }}
                                </strong></h6>
                            @if (isset($endOfDay))
                                <div class="">
                                    <div class="p-4 col-md-12">
                                        <h6 class="mt-4 ms-4"><strong>
                                                A. UTILITY/BILL TRANSACTIONS</strong></h6>
                                        <table class="table table-hover table-centered table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Total Value Of Airtime Sold</th>
                                                    <td>&#8358; {{ number_format($endOfDay->airtime, 2) }} </td>
                                                    <th>Total Value Of Airtime Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->airtime_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Of Data Sold</th>
                                                    <td>&#8358; {{ number_format($endOfDay->data, 2) }} </td>
                                                    <th>Total Value Of Data Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->data_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Of Electricity Sold</th>
                                                    <td>&#8358; {{ number_format($endOfDay->electricity, 2) }} </td>
                                                    <th>Total Value Of Electricity Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->electricity_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Of TV Subscription Sold</th>
                                                    <td>&#8358; {{ number_format($endOfDay->tv, 2) }} </td>
                                                    <th>Total Value Of TV Subscription Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->tv_fees, 2) }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Total Value Of Utility/Bill Payment Transactions</th>
                                                    <td>&#8358; {{ number_format($endOfDay->total_utilities, 2) }} </td>
                                                    <th>Total Value Of Utility/Bill Payment Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->utility_fees, 2) }}</td>
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
                                                    <td>&#8358; {{ number_format($endOfDay->pos_withdrawals, 2) }} </td>
                                                    <th>Total Value Of POS Withdrawal Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->withdrawal_fees, 2) }}</td>
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
                                                    <td>&#8358; {{ number_format($endOfDay->inward_transfer, 2) }} </td>
                                                    <th>Total Value Of Inward Transfer Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->inward_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Of Outward Transfers</th>
                                                    <td>&#8358; {{ number_format($endOfDay->outward_transfer, 2) }} </td>
                                                    <th>Total Value Of Outward Transfer Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->outward_fees, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Value Transfer Transactions</th>
                                                    <td>&#8358; {{ number_format($endOfDay->total_transfers, 2) }} </td>
                                                    <th>Total Value Of Transfer Fees Generated</th>
                                                    <td>&#8358; {{ number_format($endOfDay->transfer_fees, 2) }}</td>
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
                                                    <td>&#8358; {{ number_format($endOfDay->total_transactions, 2) }} </td>
                                                    <th>Total Value Of Fees Generated Across Board</th>
                                                    <td>&#8358; {{ number_format($endOfDay->total_fees, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="bg-light text-center rounded p-5">
                                        <p><em class="far fa-sad-tear" style="font-size: 24px"></em><br> NO RECORD FOUND FOR THE SELECTED DATE!</p>
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
