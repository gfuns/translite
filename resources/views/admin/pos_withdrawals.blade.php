@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">POS Withdrawal Transactions</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('admin.filterWithdrawals') }}">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>Start Date</strong></label>
                                                <input type="date" name="start_date" class="form-control"
                                                    placeholder="Start Date" required>

                                                @error('start_date')
                                                    <span class="" role="alert">
                                                        <strong
                                                            style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>End Date</strong></label>
                                                <input type="date" name="end_date" class="form-control"
                                                    placeholder="End Date" required>

                                                @error('end_date')
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
                            <h6 class="mt-5 mb-5 ms-4"><strong>
                                    @if (isset($startDate) && isset($endDate))
                                        POS Withdrawal Transactions Between:
                                        {{ date_format($startDate, 'jS M, Y') }} and
                                        {{ date_format($endDate, 'jS M, Y') }}
                                    @else
                                        POS Withdrawal Transactions For The Last 30 Days
                                    @endif
                                </strong></h6>
                            <div class="table-responsive">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Reference</td>
                                            <td class="thh">Customer</td>
                                            <td class="th">Trx. Amount</td>
                                            <td class="th">Trx. Fee</td>
                                            <td class="th">Trx. Date</td>
                                            <td class="th">Status</td>
                                            <td class="th">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($transactions as $trx)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $trx->reference }}</td>
                                                <td>{{ $trx->business->businessName }}</td>
                                                <td>&#8358;{{ number_format($trx->amount, 2) }}</td>
                                                <td>&#8358;{{ number_format($trx->fee, 2) }}</td>
                                                <td>{{ date_format($trx->created_at, 'jS M, Y g:ia') }}</td>
                                                <td>
                                                    @if ($trx->status == 'successful')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 12px">{{ ucwords($trx->status) }}</span>
                                                    @elseif($trx->status == 'initiated')
                                                        <span class="badge badge-warning p-2"
                                                            style="font-size: 12px">{{ ucwords($trx->status) }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-2"
                                                            style="font-size: 12px">{{ ucwords($trx->status) }}</span>
                                                    @endif
                                                </td>

                                                <td class="align-middle">

                                                    <div class="btn-group dropdown">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="">
                                                            <li>
                                                                <a class="dropdown-item mb-2" href="#"
                                                                    data-bs-toggle="modal" data-bs-target="#viewDrwDetails"
                                                                    data-backdrop="static" data-myid="{{ $trx->id }}"
                                                                    data-reference="{{ $trx->reference }}"
                                                                    data-amount="&#8358;{{ number_format($trx->amount, 2) }}"
                                                                    data-fee="&#8358;{{ number_format($trx->fee, 2) }}"
                                                                    data-total="&#8358;{{ number_format($trx->total, 2)}}"
                                                                    data-bank="{{ $trx->bank}}"
                                                                    data-stan="{{ $trx->stan}}"
                                                                    data-maskedpan="{{ $trx->masked_pan}}"
                                                                    data-gateway="{{ $trx->gateway}}"
                                                                    data-description="{{ $trx->description}}"
                                                                    data-status="{{ ucwords($trx->status) }}"
                                                                    data-date="{{ date_format($trx->created_at, 'jS F, Y g:ia') }}"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="viewDrwDetails" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mb-0" id="newCatgoryLabel">
                    Transaction Details
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class=""><strong>Reference:</strong></td>
                            <td class=""><span id="vreference"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Amount:</strong></td>
                            <td class=""><span id="vamount"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Fee Charged:</strong></td>
                            <td class=""><span id="vfee"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Total:</strong></td>
                            <td class=""><span id="vtotal"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Bank:</strong></td>
                            <td class=""><span id="vbank"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Masked PAN:</strong></td>
                            <td class=""><span id="vmaskedpan"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>STAN:</strong></td>
                            <td class=""><span id="vstan"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Gateway:</strong></td>
                            <td class=""><span id="vgateway"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Description:</strong></td>
                            <td class=""><span id="vdescription"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Date Created</strong></td>
                            <td class=""><span id="vdate"></span></td>
                        </tr>

                        <tr>
                            <td class=""><strong>Status</strong></td>
                            <td class=""><span id="vstatus"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <script type="text/javascript">
        document.getElementById("withdrawals").classList.add('active');
    </script>
@endsection

@section('customjs')
    <script type="text/javascript">
        // Usage on an input field
        document.querySelector(".feeAmount").addEventListener("keydown", allowOnlyNumbersAndDecimal);
    </script>
@endsection
