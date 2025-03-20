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
                            <div class="card-title">Customer Businesses</div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('report.searchBusiness') }}">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>Customer:</strong></label>
                                                <select id="terminal" name="customer" class="form-select"
                                                    data-width="100%" required>
                                                    <option value="">Select Customer</option>
                                                    @foreach ($customers as $cust)
                                                        <option value="{{ $cust->id }}">
                                                            {{ $cust->firstName . ', ' . $cust->lastName . ' ' . $cust->otherNames }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('customers')
                                                    <span class="" role="alert">
                                                        <strong
                                                            style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3 filterButton">
                                            <button type="submit" class="btn btn-primary btn-md">Filter
                                                Customer Businesses</button>
                                        </div>
                                    </div>


                                </form>
                            </div>


                            <hr />
                            <h6 class="mt-4 mb-4 ms-4"><strong>

                                    @if (isset($customer))
                                        Customer Businesses belonging to <u> {{ $customer->lastName.", ".$customer->firstName." ".$customer->otherNames }}</u>
                                    @endif
                                </strong></h6>
                            <div class="table-responsive mb-5" style="padding-bottom: 100px">
                                <table class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Business ID</td>
                                            <td class="th">Business Name</td>
                                            <td class="th">Owner Name</td>
                                            <td class="th">Account No.</td>
                                            <td class="th">Reg. Date</td>
                                            <td class="th">Status</td>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($businesses as $cust)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $cust->agentId }}</td>
                                                <td>{{ $cust->businessName }}</td>
                                                <td>{{ $cust->user->lastName . ', ' . $cust->user->firstName . ' ' . $cust->user->otherNames }}
                                                </td>
                                                <td>{{ $cust->accountNumber }}</td>
                                                <td>{{ date_format($cust->created_at, 'jS M, Y g:ia') }}</td>
                                                <td>
                                                    @if ($cust->status == 'active')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 11px">{{ ucwords($cust->status) }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-2"
                                                            style="font-size: 11px">{{ ucwords($cust->status) }}</span>
                                                    @endif
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

    <script type="text/javascript">
        document.getElementById("reports").classList.add('active');
    </script>
@endsection
