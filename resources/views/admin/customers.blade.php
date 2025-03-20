@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Manage Customers</h4>
                                @if (app('Menu')->canCreate(Auth::user()->role_id, 3) == true)
                                    <button class="btn btn-primary ms-auto btn-sm" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight">
                                        <i class="fa fa-plus"></i>
                                        New Customer
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Last Name</td>
                                            <td class="th">First Name</td>
                                            <td class="th">Other Names</td>
                                            <td class="th">Email</td>
                                            <td class="th">Phone Number</td>
                                            <td class="th">Account Type</td>
                                            <td class="th">Status</td>
                                            <td class="th">Action</td>
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
                                                <td>{{ $cust->accountType->level ?? 'Nil' }}</td>
                                                <td>
                                                    @if ($cust->status == 'active')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 10px">{{ ucwords($cust->status) }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-2"
                                                            style="font-size: 10px">{{ ucwords($cust->status) }}</span>
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
                                                                <a class="dropdown-item mb-2"
                                                                    href="{{ route('admin.customerBusinesses', [$cust->id]) }}">View
                                                                    Businesses</a>
                                                                @if (app('Menu')->canEdit(Auth::user()->role_id, 3) == true)
                                                                    <a class="dropdown-item mb-2" href="#"
                                                                        data-bs-toggle="offcanvas"
                                                                        data-bs-target="#editCustomer"
                                                                        data-backdrop="static"
                                                                        data-myid="{{ $cust->id }}"
                                                                        data-lastname="{{ $cust->lastName }}"
                                                                        data-firstname="{{ $cust->firstName }}"
                                                                        data-othernames="{{ $cust->otherNames }}"
                                                                        data-email="{{ $cust->email }}"
                                                                        data-phone="{{ $cust->phoneNumber }}"
                                                                        data-accounttype="{{ $cust->account_type_id }}"><i
                                                                            class="fe fe-eye dropdown-item-icon"></i>Edit
                                                                        Details</a>
                                                                    @if ($cust->fee_type == 'generic')
                                                                        <a class="dropdown-item mb-2" href="#"
                                                                            data-bs-toggle="offcanvas"
                                                                            data-bs-target="#newCustomFees"
                                                                            data-backdrop="static"
                                                                            data-myid="{{ $cust->id }}"><i
                                                                                class="fe fe-eye dropdown-item-icon"></i>Configure
                                                                            Custom Fees</a>
                                                                    @else
                                                                        <a class="dropdown-item mb-2" href="#"
                                                                            data-bs-toggle="offcanvas"
                                                                            data-bs-target="#updateCustomFees"
                                                                            data-backdrop="static"
                                                                            data-myid="{{ $cust->fee->id }}"
                                                                            data-configtype="{{ $cust->fee->config_type }}"
                                                                            data-airtime="{{ $cust->fee->airtime_fee }}"
                                                                            data-data="{{ $cust->fee->data_fee }}"
                                                                            data-electricity="{{ $cust->fee->electricity_fee }}"
                                                                            data-tv="{{ $cust->fee->tv_fee }}"
                                                                            data-inward="{{ $cust->fee->inward_trf_fee }}"
                                                                            data-outward="{{ $cust->fee->outward_trf_fee }}"
                                                                            data-withdrawal="{{ $cust->fee->withdrawal_fee }}"><i
                                                                                class="fe fe-eye dropdown-item-icon"></i>Manage
                                                                            Custom Fees</a>
                                                                    @endif
                                                                    @if ($cust->status == 'active')
                                                                        <a class="dropdown-item mb-2"
                                                                            href="{{ route('admin.suspendCustomer', [$cust->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to suspend this account?')">Suspend
                                                                            Account</a>
                                                                    @else
                                                                        <a class="dropdown-item mb-2"
                                                                            href="{{ route('admin.activateCustomer', [$cust->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to activate this account?')">Activate
                                                                            Account</a>
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

    @if (app('Menu')->canCreate(Auth::user()->role_id, 3) == true)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Add New Customer</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.storeCustomer') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Last Name </strong><span
                                        class="text-danger">*</span></label>
                                <input type="text" name="lastName" class="form-control" placeholder="Last Name"
                                    required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>First Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="firstName" class="form-control" placeholder="First Name"
                                    required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Other Names</strong></label>
                                <input type="text" name="otherNames" class="form-control" placeholder="Other Names">
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Email Address</strong> <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Email Address"
                                    required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Phone Number</strong></label>
                                <input id="numberInput" type="text" name="phoneNumber" class="form-control"
                                    placeholder="Phone Number" required>
                            </div>

                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>Account Type</strong> <span
                                        class="text-danger">*</span></label>
                                <select id="accountType" name="accountType" class="form-select" data-width="100%"
                                    required>
                                    <option value="">Select Account Type</option>
                                    @foreach ($accountTypes as $level)
                                        <option value="{{ $level->id }}">{{ $level->level }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">Add Customer</button>
                                <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if (app('Menu')->canEdit(Auth::user()->role_id, 3) == true)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="editCustomer" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Update Customer Details</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.updateCustomer') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Last Name </strong><span
                                        class="text-danger">*</span></label>
                                <input id='surname' type="text" name="lastName" class="form-control"
                                    placeholder="Surname" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>First Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="firstname" type="text" name="firstName" class="form-control"
                                    placeholder="First Name" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Other Names</strong></label>
                                <input id="othernames" type="text" name="otherNames" class="form-control"
                                    placeholder="Other Names">
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Email Address</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="email" type="email" name="email" class="form-control"
                                    placeholder="Email Address" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Phone Number</strong></label>
                                <input id="phone" type="text" name="phoneNumber" class="form-control numberInput"
                                    placeholder="Phone Number">
                            </div>


                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>Account Type</strong> <span
                                        class="text-danger">*</span></label>
                                <select id="accountType" name="accountType" class="form-select" data-width="100%"
                                    required>
                                    @foreach ($accountTypes as $level)
                                        <option value="{{ $level->id }}">{{ $level->level }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input id="myid" type="hidden" name="customer_id" class="form-control" required>

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

        <div class="offcanvas offcanvas-end" tabindex="-1" id="newCustomFees" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Customer Custom Fee Configuration</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.storeCustomFee') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <div class="mb-3 col-6">
                                    <label class="form-label"><strong>Config Type </strong><span
                                            class="text-danger">*</span></label>
                                    <select id="configFormat" name="config_type" class="form-select" data-width="100%"
                                        required>
                                        <option value="">Select Configuration Type</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Airtime Fee </strong><span
                                        class="text-danger">*</span></label>
                                <input id='airtime' type="text" name="airtime_fee" class="form-control"
                                    placeholder="Airtime Fee" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Data Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="data" type="text" name="data_fee" class="form-control"
                                    placeholder="Date Fee" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Electricity Fee </strong> <span
                                        class="text-danger">*</span></label>
                                <input id="electricity" type="text" name="electricity_fee" class="form-control"
                                    placeholder="Electricity Fee">
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>TV Subscription Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="tv" type="text" name="tv_fee" class="form-control"
                                    placeholder="TV Subscription Fee" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Inward Transfer Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="inward" type="text" name="inward_transfer_fee" class="form-control"
                                    placeholder="Inward Transfer Fee">
                            </div>


                            <div class="mb-4 col-6">
                                <label class="form-label"><strong>Outward Transfer Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="outward" type="text" name="outward_transfer_fee" class="form-control"
                                    placeholder="Outward Transfer Fee">
                            </div>

                            <div class="mb-4 col-6">
                                <label class="form-label"><strong>POS Withdrawal Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="withdrawal" type="text" name="withdrawal_fee" class="form-control"
                                    placeholder="Outward Transfer Fee">
                            </div>

                            <input id="myid" type="hidden" name="customer_id" class="form-control" required>

                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">Save Fee Configuration</button>
                                <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="updateCustomFees" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Update Customer Custom Fee Configuration</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.updateCustomFee') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <div class="mb-3 col-6">
                                    <label class="form-label"><strong>Config Type </strong><span
                                            class="text-danger">*</span></label>
                                    <select id="configtype" name="config_type" class="form-select" data-width="100%"
                                        required>
                                        <option value="">Select Configuration Type</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Airtime Fee </strong><span
                                        class="text-danger">*</span></label>
                                <input id='airtime' type="text" name="airtime_fee" class="form-control"
                                    placeholder="Airtime Fee" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Data Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="data" type="text" name="data_fee" class="form-control"
                                    placeholder="Date Fee" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Electricity Fee </strong> <span
                                        class="text-danger">*</span></label>
                                <input id="electricity" type="text" name="electricity_fee" class="form-control"
                                    placeholder="Electricity Fee">
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>TV Subscription Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="tv" type="text" name="tv_fee" class="form-control"
                                    placeholder="TV Subscription Fee" required>
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label"><strong>Inward Transfer Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="inward" type="text" name="inward_transfer_fee" class="form-control"
                                    placeholder="Inward Transfer Fee">
                            </div>


                            <div class="mb-4 col-6">
                                <label class="form-label"><strong>Outward Transfer Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="outward" type="text" name="outward_transfer_fee" class="form-control"
                                    placeholder="Outward Transfer Fee">
                            </div>

                            <div class="mb-4 col-6">
                                <label class="form-label"><strong>POS Withdrawal Fee</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="withdrawal" type="text" name="withdrawal_fee" class="form-control"
                                    placeholder="Outward Transfer Fee">
                            </div>

                            <input id="myid" type="hidden" name="config_id" class="form-control" required>

                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">Update Fee Configuration</button>
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
        // Usage on an input field
        document.getElementById("airtime").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.getElementById("data").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.getElementById("electricity").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.getElementById("tv").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.getElementById("inward").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.getElementById("outward").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.getElementById("withdrawal").addEventListener("keydown", allowOnlyNumbersAndDecimal);
    </script>
@endsection
