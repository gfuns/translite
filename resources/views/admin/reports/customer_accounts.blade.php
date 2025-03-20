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
                            <div class="card-title">Customer Accounts</div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('report.searchCustomers') }}">
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
                                                Customer Records</button>
                                        </div>
                                    </div>


                                </form>
                            </div>


                            <hr />
                            <h6 class="mt-4 mb-4 ms-4"><strong>

                                    @if (isset($startDate) && isset($endDate))
                                         Customer Accounts Created Between
                                        {{ date_format($startDate, 'jS M, Y') }} And
                                        {{ date_format($endDate, 'jS M, Y') }}
                                    @endif
                                </strong></h6>
                            <div class="table-responsive mb-5" style="padding-bottom: 100px">
                                <table class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Last Name</td>
                                            <td class="th">First Name</td>
                                            <td class="th">Other Names</td>
                                            <td class="th">Email</td>
                                            <td class="th">Phone No.</td>
                                            <td class="th">Businesses</td>
                                            <td class="th">Reg. Date</td>
                                            <td class="th">Status</td>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach ($customers as $cust)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $cust->lastName }}</td>
                                                <td>{{ $cust->firstName }}</td>
                                                <td>{{ $cust->otherNames ?? 'Nil' }}</td>
                                                <td>{{ $cust->email }}</td>
                                                <td>{{ $cust->phoneNumber ?? 'Nil' }}</td>
                                                <td>{{ $cust->business->count() }} Business(es)</td>
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
