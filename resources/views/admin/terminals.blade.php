@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Manage POS Terminals</h4>
                                @if (app('Menu')->canCreate(Auth::user()->role_id, 5) == true)
                                    <button class="btn btn-primary ms-auto btn-sm" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight">
                                        <i class="fa fa-plus"></i>
                                        New POS Terminal
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('admin.filterTerminals') }}">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="currentPassword"><strong>Assignment Status</strong></label>
                                                <select id="terminal" name="status" class="form-select" data-width="100%"
                                                    required>
                                                    <option value="">Select Assignment Status</option>
                                                    <option value="1">Assigned Terminals</option>
                                                    <option value="0">Unassigned Terminals</option>
                                                </select>

                                                @error('assignment_status')
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

                            @if (isset($status))
                                <h6 class="mt-4 mb-4 ms-4">
                                    <strong>
                                        List Of {{ $status == 1 ? 'Assigned' : 'Unassigned' }} Terminals
                                    </strong>
                                </h6>
                            @endif
                            <div class="table-responsive">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Model</td>
                                            <td class="th">Terminal ID</td>
                                            <td class="th">Serial Number</td>
                                            <td class="th">SIM No.</td>
                                            <td class="th">Assigned</td>
                                            <td class="th">Status</td>
                                            <td class="th">Date Created</td>
                                            <td class="th">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($terminals as $term)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $term->model }}</td>
                                                <td>{{ $term->terminal_id }}</td>
                                                <td>{{ $term->serial_number }}</td>
                                                <td>{{ $term->sim ?? 'Nil' }}</td>
                                                <td>{{ $term->assigned == 1 ? 'Assigned' : 'Not Assigned' }}</td>
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
                                                <td>{{ date_format($term->created_at, 'jS M, Y') }}</td>

                                                <td class="align-middle">

                                                    <div class="btn-group dropdown">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="">
                                                            <li>
                                                                <a class="dropdown-item mb-2" href="#"
                                                                    data-bs-toggle="modal" data-bs-target="#viewTerminal"
                                                                    data-backdrop="static" data-myid="{{ $term->id }}"
                                                                    data-model="{{ $term->model }}"
                                                                    data-terminalid="{{ $term->terminal_id }}"
                                                                    data-serialno="{{ $term->serial_number }}"
                                                                    data-assigned="{{ $term->assigned == 1 ? 'Assigned' : 'Not Assigned' }}"
                                                                    data-status="{{ ucwords($term->status) }}"
                                                                    data-ip="{{ $term->ip }}"
                                                                    data-port="{{ $term->port }}"
                                                                    data-date="{{ date_format($term->created_at, 'jS F, Y') }}"
                                                                    data-sim="{{ $term->sim }}"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>
                                                                @if (app('Menu')->canEdit(Auth::user()->role_id, 5) == true)
                                                                    <a class="dropdown-item mb-2" href="#"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#editTerminal"
                                                                        data-backdrop="static"
                                                                        data-myid="{{ $term->id }}"
                                                                        data-model="{{ $term->model }}"
                                                                        data-terminalid="{{ $term->terminal_id }}"
                                                                        data-serialno="{{ $term->serial_number }}"
                                                                        data-ip="{{ $term->ip }}"
                                                                        data-port="{{ $term->port }}"
                                                                        data-sim="{{ $term->sim }}"><i
                                                                            class="fe fe-eye dropdown-item-icon"></i>Edit
                                                                        Details</a>
                                                                    @if ($term->status == 'active')
                                                                        <a class="dropdown-item mb-2"
                                                                            href="{{ route('admin.deactivateTerminal', [$term->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to deactivate this terminal?')">Deactivate
                                                                            Terminal</a>
                                                                    @elseif($term->status == 'deactived')
                                                                        <a class="dropdown-item mb-2"
                                                                            href="{{ route('admin.activateTerminal', [$term->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to activate this terminal?')">Activate
                                                                            Terminal</a>
                                                                    @endif
                                                                @endif
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


    <div class="modal fade" id="viewTerminal" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="newCatgoryLabel">
                        Terminal Details
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class=""><strong>Model:</strong></td>
                                <td class=""><span id="vmodel"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Terminal ID:</strong></td>
                                <td class=""><span id="vterminalid"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>IP Addresss:</strong></td>
                                <td class=""><span id="vip"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Port:</strong></td>
                                <td class=""><span id="vport"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Serial Number</strong></td>
                                <td class=""><span id="vserialno"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>SIM Number</strong></td>
                                <td class=""><span id="vsim"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Date Created</strong></td>
                                <td class=""><span id="vdate"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Assigned?</strong></td>
                                <td class=""><span id="vassigned"></span></td>
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
    @if (app('Menu')->canCreate(Auth::user()->role_id, 5) == true)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Add New Terminal</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.storeTerminal') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>POS Model</strong> <span
                                        class="text-danger">*</span></label>
                                <select id="accountType" name="pos_model" class="form-select" data-width="100%"
                                    required>
                                    <option value="">Select POS Model</option>
                                    <option value="PAX">PAX</option>
                                    <option value="PRO">PRO</option>
                                    <option value="K11">K11</option>
                                    <option value="NetPOS">NetPOS</option>
                                    <option value="MP35P">MP35P</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Terminal ID </strong><span
                                        class="text-danger">*</span></label>
                                <input type="text" name="terminal_id" class="form-control" placeholder="Terminal ID"
                                    required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Serial Number</strong> <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="serial_number" class="form-control"
                                    placeholder="Serial Number" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>IP Address</strong></label>
                                <input type="text" name="ip" class="form-control" placeholder="IP Address">
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Port</strong></label>
                                <input type="text" name="port" class="form-control" placeholder="Port">
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>SIM Number</strong></label>
                                <input type="text" name="sim_number" class="form-control" placeholder="SIM Number">
                            </div>

                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">Add Terminal</button>
                                <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if (app('Menu')->canEdit(Auth::user()->role_id, 5) == true)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="editTerminal" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Update Terminal Details</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.updateTerminal') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>POS Model</strong> <span
                                        class="text-danger">*</span></label>
                                <select id="model" name="pos_model" class="form-select" data-width="100%" required>
                                    <option value="">Select POS Model</option>
                                    <option value="PAX">PAX</option>
                                    <option value="PRO">PRO</option>
                                    <option value="K11">K11</option>
                                    <option value="NetPOS">NetPOS</option>
                                    <option value="MP35P">MP35P</option>
                                </select>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Terminal ID </strong><span
                                        class="text-danger">*</span></label>
                                <input id="terminalid" type="text" name="terminal_id" class="form-control"
                                    placeholder="Terminal ID" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Serial Number</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="serialno" type="text" name="serial_number" class="form-control"
                                    placeholder="Serial Number" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>IP Address</strong></label>
                                <input id="ip" type="text" name="ip" class="form-control" placeholder="IP Address">
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Port</strong></label>
                                <input id="port" type="text" name="port" class="form-control" placeholder="Port">
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>SIM Number</strong></label>
                                <input id='sim' type="text" name="sim_number" class="form-control"
                                    placeholder="SIM Number">
                            </div>



                            <input id="myid" type="hidden" name="term_id" class="form-control" required>

                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        document.getElementById("terminals").classList.add('active');
    </script>
@endsection
