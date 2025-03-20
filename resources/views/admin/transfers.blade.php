@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ ucwords($category) }} Transfer Transactions</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('admin.filterTransferTrxs') }}">
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
                                            <input type="hidden" name="category" value="{{ $category }}" />
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
                                        {{ ucwords($category) }} Transfer Transactions Between:
                                        {{ date_format($startDate, 'jS M, Y') }} and
                                        {{ date_format($endDate, 'jS M, Y') }}
                                    @else
                                        {{ ucwords($category) }} Transfer Transactions For The Last 30 Days
                                    @endif
                                </strong></h6>
                            <div class="table-responsive">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Reference</td>
                                            <td class="thh">Customer</td>
                                            <td class="th">{{ $label }} Name</td>
                                            <td class="th">{{ $label }} Bank</td>
                                            <td class="th">{{ $label }} Account</td>
                                            <td class="th">Trx. Amount</td>
                                            @if ($category == 'outward')
                                                <td class="th">Trx. Fee</td>
                                            @endif
                                            <td class="th">Trx. Date</td>
                                            <td class="th">Status</td>
                                            @if ($category == 'outward')
                                                <td class="th">Action</td>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($transactions as $trx)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $trx->reference }}</td>
                                                <td>{{ $trx->business->businessName }}</td>
                                                @if ($category == 'inward')
                                                    <td>{{ $trx->sender_name }}</td>
                                                    <td>{{ $trx->sender_bank }}</td>
                                                    <td>{{ $trx->sender_account }}</td>
                                                @else
                                                    <td>{{ $trx->receiver_name }}</td>
                                                    <td>{{ $trx->receiver_bank }}</td>
                                                    <td>{{ $trx->receiver_account }}</td>
                                                @endif
                                                <td>&#8358;{{ number_format($trx->amount, 2) }}</td>
                                                @if ($category == 'outward')
                                                    <td>&#8358;{{ number_format($trx->fee, 2) }}</td>
                                                @endif
                                                <td>{{ date_format($trx->created_at, 'jS M, Y') }}</td>
                                                <td>
                                                    @if ($trx->status == 'successful')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 12px">{{ ucwords($trx->status) }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-2"
                                                            style="font-size: 11px">{{ ucwords($trx->status) }}</span>
                                                    @endif
                                                </td>
                                                @if ($category == 'outward')
                                                    <td><a href="{{ route('admin.requeryTrfTrans', [$trx->id]) }}"><button
                                                                class="btn btn-primary btn-xs"
                                                                onClick="this.disabled=true; this.innerHTML='Processing...';">Requery</button>
                                                        </a></td>
                                                @endif
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


    <script type="text/javascript">
        var category = {{ Js::from(strtolower($category)) }};
        document.getElementById("transfers").classList.add('active');
        document.getElementById("transferTrxs").classList.add('show');
        document.getElementById(category).classList.add('active');
    </script>
@endsection

@section('customjs')
    <script type="text/javascript">
        // Usage on an input field
        document.querySelector(".feeAmount").addEventListener("keydown", allowOnlyNumbersAndDecimal);
    </script>
@endsection
