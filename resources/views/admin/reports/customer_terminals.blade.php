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
                            <div class="card-title">Customer Terminals</div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('report.searchCustTerminals') }}">
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
                                        POS Terminals Assigned to <u> {{ $customer->lastName.", ".$customer->firstName." ".$customer->otherNames }}</u>
                                    @endif
                                </strong></h6>
                            <div class="table-responsive mb-5" style="padding-bottom: 100px">
                                <table class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Model</td>
                                            <td class="th">Terminal ID.</td>
                                            <td class="th">Serial No.</td>
                                            <td class="th">SIM No.</td>
                                            <td class="th">Assigned Business</td>
                                            <td class="th">Date Assigned</td>
                                            <td class="th">Status</td>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($terminals as $term)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $term->terminal->model }}</td>
                                                <td>{{ $term->terminal->terminal_id }}</td>
                                                <td>{{ $term->terminal->serial_number }}</td>
                                                <td>{{ $term->terminal->sim }}</td>
                                                <td>{{ $term->user->lastName . ', ' . $term->user->firstName . ' ' . $term->user->otherNames }}
                                                </td>
                                                <td>{{ date_format($term->created_at, 'jS M, Y g:ia') }}</td>
                                                <td>
                                                    @if ($term->terminal->status == 'active')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 11px">{{ ucwords($term->terminal->status) }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-2"
                                                            style="font-size: 11px">{{ ucwords($term->terminal->status) }}</span>
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
