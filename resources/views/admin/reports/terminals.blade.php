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
                            <div class="card-title">Terminal Reports</div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('report.searchTerminals') }}">
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

                                            <input type="hidden" name="assigned" value="{{ $isAssigned }}"/>

                                        </div>
                                        <div class="col-md-3 filterButton">
                                            <button type="submit" class="btn btn-primary btn-md">Filter Terminals</button>
                                        </div>
                                    </div>


                                </form>
                            </div>


                            <hr />
                            <h6 class="mt-4 mb-4 ms-4"><strong>

                                    {{ ucwords(isset($assigned) ? "All ".$assigned." POS Terminals" : 'All Listed POS Terminals') }}
                                    @if (isset($startDate) && isset($endDate))
                                       Created Between
                                        {{ date_format($startDate, 'jS M, Y') }} And
                                        {{ date_format($endDate, 'jS M, Y') }}
                                    @endif
                                </strong></h6>
                            <div class="table-responsive mb-5" style="padding-bottom: 100px">
                                <table class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Model</td>
                                            <td class="th">Terminal ID</td>
                                            <td class="th">Serial Number</td>
                                            <td class="th">SIM Number</td>
                                            <td class="th">Assigned?</td>
                                            <td class="th">Status</td>
                                            <td class="th">Date Created</td>
                                        </tr>
                                    </thead>

                                        <tbody>

                                            @foreach ($terminals as $term)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $term->model }}</td>
                                                    <td>{{ $term->terminal_id }}</td>
                                                    <td>{{ $term->serial_number }}</td>
                                                    <td>{{ $term->sim }}</td>
                                                    <td>{{ $term->assigned == 1 ? "Assigned" : "Unassigned" }}</td>
                                                    <td>
                                                        @if ($term->status == 'active')
                                                        <span class="badge badge-success p-2"
                                                        style="font-size: 10px">{{ ucwords($term->status) }}</span>
                                                        @elseif($term->status == 'inactive')
                                                        <span class="badge badge-warning p-2"
                                                        style="font-size: 10px">{{ ucwords($term->status) }}</span>
                                                        @else
                                                        <span class="badge badge-danger p-2"
                                                        style="font-size: 10px">{{ ucwords($term->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ date_format($term->created_at, 'jS M, Y g:ia') }}</td>
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
