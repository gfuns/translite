@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $service }} Transactions</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('admin.filterUtilityTrxs') }}">
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
                                            <input type="hidden" name="service" value="{{ $service }}" />

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
                                        {{ $service }} Transactions Between:
                                        {{ date_format($startDate, 'jS M, Y') }} and
                                        {{ date_format($endDate, 'jS M, Y') }}
                                    @else
                                        {{ $service }} Transactions For The Last 30 Days
                                    @endif
                                </strong></h6>
                            <div class="table-responsive">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Reference</td>
                                            <td class="thh">Customer</td>
                                            <td class="th">Provider</td>
                                            <td class="th">Recipient</td>
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
                                                <td>{{ $trx->biller }}</td>
                                                <td>{{ $trx->recipient }}</td>
                                                <td>&#8358;{{ number_format($trx->amount, 2) }}</td>
                                                <td>&#8358;{{ number_format($trx->trx_fee, 2) }}</td>
                                                <td>{{ date_format($trx->created_at, 'jS M, Y') }}</td>
                                                <td>
                                                    @if ($trx->status == 'successful')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 12px">{{ ucwords($trx->status) }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-2"
                                                            style="font-size: 12px">{{ ucwords($trx->status) }}</span>
                                                    @endif
                                                </td>
                                                <td><a href="{{ route("admin.requeryUtility", [$trx->id]) }}"><button class="btn btn-primary btn-xs" onClick="this.disabled=true; this.innerHTML='Processing...';">Requery</button></a></td>
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
        var service = {{ Js::from(strtolower($service)) }};
        document.getElementById("utilities").classList.add('active');
        document.getElementById("utilityTrxs").classList.add('show');
        document.getElementById(service).classList.add('active');
    </script>
@endsection

@section('customjs')
    <script type="text/javascript">
        // Usage on an input field
        document.querySelector(".feeAmount").addEventListener("keydown", allowOnlyNumbersAndDecimal);
    </script>
@endsection
