@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Customer Businesses</h4>
                                @if (app('Menu')->canCreate(Auth::user()->role_id, 4) == true)
                                    <button class="btn btn-primary ms-auto btn-sm" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight">
                                        <i class="fa fa-plus"></i>
                                        New Business
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="min-height: 250px">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Business ID</td>
                                            <td class="th">Business Name</td>
                                            <td class="th">Terminal Model</td>
                                            <td class="th">Terminal ID</td>
                                            <td class="th">Terminal SNo.</td>
                                            <td class="th">Status</td>
                                            <td class="th">Date Created</td>
                                            <td class="th">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($businesses as $biz)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $biz->agentId }}</td>
                                                <td>{{ $biz->businessName }}</td>
                                                <td>{{ $biz->terminal->model ?? 'Nil' }}</td>
                                                <td>{{ $biz->terminal->terminal_id ?? 'Nil' }}</td>
                                                <td>{{ $biz->terminal->serial_number ?? 'Nil' }}</td>
                                                <td>
                                                    @if ($biz->status == 'active')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 10px">{{ ucwords($biz->status) }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-2"
                                                            style="font-size: 10px">{{ ucwords($biz->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ date_format($biz->created_at, 'jS M, Y') }}</td>

                                                <td class="align-middle">

                                                    <div class="btn-group dropdown">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="">
                                                            <li>
                                                                <a class="dropdown-item mb-2" href="#"
                                                                    data-bs-toggle="modal" data-bs-target="#viewBusiness"
                                                                    data-backdrop="static" data-myid="{{ $biz->id }}"
                                                                    data-bizid="{{ $biz->agentId }}"
                                                                    data-balance="{{ number_format($biz->balance->account_balance, 2) }}"
                                                                    data-name="{{ $biz->businessName }}"
                                                                    data-address="{{ $biz->businessAddress }}"
                                                                    data-email="{{ $biz->email }}"
                                                                    data-phone="{{ $biz->agentPhoneNumber }}"
                                                                    data-acctno="{{ $biz->accountNumber }}"
                                                                    data-model="{{ $biz->terminal->model ?? 'Nil' }}"
                                                                    data-tid="{{ $biz->terminal->terminal_id ?? 'Nil' }}"
                                                                    data-sno="{{ $biz->terminal->serial_number ?? 'Nil' }}"
                                                                    data-status="{{ ucwords($biz->status) }}"
                                                                    data-operator="{{ $biz->agentLastName . ', ' . $biz->agentFirstName . ' ' . $biz->agentOtherNames }}"
                                                                    data-date="{{ date_format($biz->created_at, 'jS F, Y') }}"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>
                                                                @if (app('Menu')->canEdit(Auth::user()->role_id, 4) == true)
                                                                    <a class="dropdown-item mb-2" href="#"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#editBusiness"
                                                                        data-backdrop="static"
                                                                        data-myid="{{ $biz->id }}"
                                                                        data-bizname="{{ $biz->businessName }}"
                                                                        data-bizaddress="{{ $biz->businessAddress }}"
                                                                        data-email="{{ $biz->email }}"
                                                                        data-phone="{{ $biz->agentPhoneNumber }}"
                                                                        data-oln="{{ $biz->agentLastName }}"
                                                                        data-ofn="{{ $biz->agentFirstName }}"
                                                                        data-oon="{{ $biz->agentOtherNames }}"><i
                                                                            class="fe fe-eye dropdown-item-icon"></i>Edit
                                                                        Details</a>
                                                                    @if (isset($biz->terminal))
                                                                        <a class="dropdown-item mb-2"
                                                                            href="{{ route('admin.releaseTerminal', [$biz->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to release the terminal assigned to this business?')">Release
                                                                            Terminal</a>
                                                                    @else
                                                                        <a class="dropdown-item mb-2" href="#"
                                                                            data-bs-toggle="offcanvas"
                                                                            data-bs-target="#assignTerminal"
                                                                            data-backdrop="static"
                                                                            data-myid="{{ $biz->id }}">Assign
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


    <div class="modal fade" id="viewBusiness" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="newCatgoryLabel">
                        Business Details
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class=""><strong>Account Balance:</strong></td>
                                <td class="">&#8358;<span id="vbalance"></span></td>
                            </tr>
                            <tr>
                                <td class=""><strong>Business ID:</strong></td>
                                <td class=""><span id="vbizid"></span></td>
                            </tr>
                            <tr>
                                <td class=""><strong>Business Name:</strong></td>
                                <td class=""><span id="vname"></span></td>
                            </tr>
                            <tr>
                                <td class=""><strong>Business Address:</strong></td>
                                <td class=""><span id="vaddress"></span></td>
                            </tr>
                            <tr>
                                <td class=""><strong>Business Email:</strong></td>
                                <td class=""><span id="vemail"></span></td>
                            </tr>
                            <tr>
                                <td class=""><strong>Business Phone Number:</strong></td>
                                <td class=""><span id="vphone"></span></td>
                            </tr>
                            <tr>
                                <td class=""><strong>POS Operator:</strong></td>
                                <td class=""><span id="voperator"></span></td>
                            </tr>
                            <tr>
                                <td class=""><strong>Account Number:</strong></td>
                                <td class=""><span id="vacctno"></span></td>
                            </tr>
                            <tr>
                                <td class=""><strong>POS Model:</strong></td>
                                <td class=""><span id="vmodel"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>POS Terminal ID:</strong></td>
                                <td class=""><span id="vterminalid"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>POS Terminal Serial Number</strong></td>
                                <td class=""><span id="vserialno"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Status</strong></td>
                                <td class=""><span id="vstatus"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Date Created</strong></td>
                                <td class=""><span id="vdate"></span></td>
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

    @if (app('Menu')->canCreate(Auth::user()->role_id, 4) == true)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Add New Business</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.storeBusiness') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>Business Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="bizname" type="text" name="business_name" class="form-control"
                                    placeholder="Business Name" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Business Address </strong><span
                                        class="text-danger">*</span></label>
                                <input id="bizaddress" type="text" name="business_address" class="form-control"
                                    placeholder="Business Address" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Business Email</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="email" type="email" name="email" class="form-control"
                                    placeholder="Business Email" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Business Phone Number</strong> <span
                                        class="text-danger">*</span></label>
                                <input id='phone' type="text" name="agentPhoneNumber" class="form-control"
                                    placeholder="Business Phone Number" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Operator Last Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input id='oln' type="text" name="last_name" class="form-control"
                                    placeholder="Operator Last Name" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Operator First Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input id='ofn' type="text" name="first_name" class="form-control"
                                    placeholder="Business Phone Number" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Operator Other Names</strong></label>
                                <input id='oon' type="text" name="other_names" class="form-control"
                                    placeholder="Business Phone Number">
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Gender</strong></label>
                                <select id="gender" name="gender" class="form-select" data-width="100%" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Bank Verification Number (BVN)</strong></label>
                                <input id='bvn' type="text" name="bvn" class="form-control"
                                    placeholder="Bank Verification Number (BVN)" required minlength="11">
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Date Of Birth</strong></label>
                                <input id='dob' type="date" name="dob" class="form-control"
                                    placeholder="Date Of Birth" required>
                            </div>

                            <input id="userid" type="hidden" value="{{ $id }}" name="user_id"
                                class="form-control" required>

                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">Save Business</button>
                                <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if (app('Menu')->canEdit(Auth::user()->role_id, 4) == true)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="assignTerminal" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Assign Terminal</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.assignTerminal') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>POS Terminal</strong> <span
                                        class="text-danger">*</span></label>
                                <select id="postTerminal" name="pos_terminal" class="form-select" data-width="100%"
                                    required>
                                    <option value="">Select POS Terminal</option>
                                    @foreach ($terminals as $terminal)
                                        <option value="{{ $terminal->id }}">
                                            {{ $terminal->model . ' - ' . $terminal->terminal_id }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input id="myid" type="hidden" name="business_id" class="form-control" required>

                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">Assign Terminal</button>
                                <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="offcanvas offcanvas-end" tabindex="-1" id="editBusiness" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Update Business Details</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.updateBusiness') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>Business Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="bizname" type="text" name="business_name" class="form-control"
                                    placeholder="Business Name" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Business Address </strong><span
                                        class="text-danger">*</span></label>
                                <input id="bizaddress" type="text" name="business_address" class="form-control"
                                    placeholder="Business Address" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Business Email</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="email" type="email" name="email" class="form-control"
                                    placeholder="Business Email" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Business Phone Number</strong></label>
                                <input id='phone' type="text" name="phone_number" class="form-control"
                                    placeholder="Business Phone Number" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Operator Last Name</strong></label>
                                <input id='oln' type="text" name="first_name" class="form-control"
                                    placeholder="Operator Last Name" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Operator First Name</strong></label>
                                <input id='ofn' type="text" name="last_name" class="form-control"
                                    placeholder="Business Phone Number" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Operator Other Names</strong></label>
                                <input id='oon' type="text" name="other_names" class="form-control"
                                    placeholder="Business Phone Number">
                            </div>

                            <input id="myid" type="hidden" name="business_id" class="form-control" required>

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
        document.getElementById("customers").classList.add('active');
    </script>
@endsection

@section('customjs')
    <script type="text/javascript">
        document.getElementById("bvn").addEventListener("keydown", allowOnlyNumbersAndDecimal);
    </script>
@endsection
