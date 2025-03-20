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
                            <div class="card-title">Audit Trail Report</div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('report.searchAuditTrails') }}">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>Activity Performed</strong></label>
                                                <select id="event" name="event_type" class="form-select"
                                                    data-width="100%" required>
                                                    <option value="null">Select Actiity Type</option>
                                                    <option value="null">All Activities</option>
                                                    <option value="created">New Record Creation</option>
                                                    {{-- <option value="retrieved">Record Retrieval</option> --}}
                                                    <option value="updated">Record Update</option>
                                                    <option value="deleted">Record Deletion</option>
                                                    <option value="restored">Record Restoration</option>
                                                </select>

                                                @error('event_type')
                                                    <span class="" role="alert">
                                                        <strong
                                                            style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>Start Date</strong></label>
                                                <input type="date" name="start_date" class="form-control"
                                                    placeholder="Start Date">

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
                                                    placeholder="End Date">

                                                @error('end_date')
                                                    <span class="" role="alert">
                                                        <strong
                                                            style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-3 filterButton">
                                            <button type="submit" class="btn btn-primary btn-md">Filter Audit Trail
                                                Records</button>
                                        </div>
                                    </div>


                                </form>
                            </div>


                            <hr />
                            <h6 class="mt-4 mb-4 ms-4"><strong>
                                    Audit Trail For
                                    <u>{{ ucwords(isset($eventType) ? 'User Activity: ' . $eventType : 'All User Activities') }}</u>
                                    @if (isset($startDate) && isset($endDate))
                                        - Between
                                        {{ date_format($startDate, 'jS M, Y') }} And
                                        {{ date_format($endDate, 'jS M, Y') }}
                                    @endif
                                </strong></h6>
                            <div class="table-responsive mb-5" style="padding-bottom: 100px">
                                <table class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Surname</td>
                                            <td class="th">First Name</td>
                                            <td class="th">Other Names</td>
                                            <td class="th">User Role</td>
                                            <td class="th">Activity</td>
                                            <td class="th">Activity Date</td>
                                            <td class="th">Action</td>
                                        </tr>
                                    </thead>
                                    @if (isset($activities))
                                        <tbody>

                                            @foreach ($activities as $act)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $act->user->lastName }}</td>
                                                    <td>{{ $act->user->firstName }}</td>
                                                    <td>{{ $act->user->otherNames ?? 'Nil' }}</td>
                                                    <td>{{ $act->user->userRole->role }}</td>
                                                    <td>{{ $act->event() }}</td>
                                                    <td>{{ date_format($act->created_at, 'jS M, Y g:ia') }}</td>
                                                    <td class="align-middle">
                                                        <button class="btn btn-primary btn-xs" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#viewAuditDetails"
                                                            data-backdrop="static" data-myid="{{ $act->id }}"
                                                            data-surname="{{ $act->user->lastName }}"
                                                            data-firstname="{{ $act->user->firstName }}"
                                                            data-othernames="{{ $act->user->otherNames ?? 'Nil' }}"
                                                            data-role="{{ $act->user->userRole->role }}"
                                                            data-event="{{ $act->event() }}"
                                                            data-table="{{ preg_replace('/App\\\\Models\\\\/', '', $act->auditable_type) }}"
                                                            data-oldrecord="{{ $act->oldValues() }}"
                                                            data-newrecord="{{ $act->newValues() }}"
                                                            data-ip="{{ $act->ip_address }}"
                                                            data-agent="{{ $act->user_agent }}"
                                                            data-datecreated="{{ date_format($act->created_at, 'jS F, Y g:ia') }}">View
                                                            Details</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="viewAuditDetails" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="newCatgoryLabel">
                        View Audit Trail Details
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="">Surname</td>
                                <td class=""><span id="vsurname"></span></td>
                            </tr>

                            <tr>
                                <td class="">First Name</td>
                                <td class=""><span id="vfirstname"></span></td>
                            </tr>

                            <tr>
                                <td class="">Other Names</td>
                                <td class=""><span id="vothernames"></span></td>
                            </tr>

                            <tr>
                                <td class="">User Role</td>
                                <td class=""><span id="vrole"></span></td>
                            </tr>

                            <tr>
                                <td class="">Event Type</td>
                                <td class=""><span id="vevent"></span></td>
                            </tr>

                            <tr>
                                <td class="" style="white-space: nowrap">Affected Table</td>
                                <td class=""><span id="vmodel"></span> Table</td>
                            </tr>

                            <tr>
                                <td class="" style="white-space: nowrap">Old Values</td>
                                <td class=""><span id="voldvalues"></span></td>
                            </tr>

                            <tr>
                                <td class="" style="white-space: nowrap">New Values</td>
                                <td class=""><span id="vnewvalues"></span></td>
                            </tr>

                            <tr>
                                <td class="">IP Address</td>
                                <td class=""><span id="vip"></span></td>
                            </tr>

                            <tr>
                                <td class="">User Agent</td>
                                <td class=""><span id="vagent"></span></td>
                            </tr>

                            <tr>
                                <td class="">Activity Date</td>
                                <td class="" colspan="2"><span id="vdatecreated"></span></td>
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
        document.getElementById("reports").classList.add('active');
    </script>
@endsection
