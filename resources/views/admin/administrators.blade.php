@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Administrative Users</h4>
                                @if (app('Menu')->canCreate(Auth::user()->role_id, 2) == true)
                                    <button class="btn btn-primary ms-auto btn-sm" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasRight">
                                        <i class="fa fa-plus"></i>
                                        New Administrative User
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Surname</td>
                                            <td class="th">First Name</td>
                                            <td class="th">Other Names</td>
                                            <td class="th">Email</td>
                                            <td class="th">Assigned Role</td>
                                            <td class="th">Status</td>
                                            <td class="th">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($administrators as $admin)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $admin->lastName }}</td>
                                                <td>{{ $admin->firstName }}</td>
                                                <td>{{ $admin->otherNames ?? 'Nil' }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>{{ $admin->userRole->role }}</td>
                                                <td>
                                                    @if ($admin->status == 'active')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 12px">{{ ucwords($admin->status) }}</span>
                                                    @else
                                                        <span class="badge badge-danger p-2"
                                                            style="font-size: 12px">{{ ucwords($admin->status) }}</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if ($admin->role_id != 1)
                                                        <div class="btn-group dropdown">
                                                            <button class="btn btn-primary btn-sm dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu" style="">
                                                                <li>
                                                                    <a class="dropdown-item mb-2" href="#"
                                                                        data-bs-toggle="modal" data-bs-target="#viewAdmin"
                                                                        data-backdrop="static"
                                                                        data-myid="{{ $admin->id }}"
                                                                        data-surname="{{ $admin->lastName }}"
                                                                        data-firstname="{{ $admin->firstName }}"
                                                                        data-othernames="{{ $admin->otherNames }}"
                                                                        data-email="{{ $admin->email }}"
                                                                        data-phone="{{ $admin->phoneNumber }}"
                                                                        data-role="{{ $admin->userRole->role }}"
                                                                        data-datecreated="{{ date_format($admin->created_at, 'jS F, Y g:ia') }}"
                                                                        data-photo="{{ $admin->photo == null ? asset('backend/assets/img/profile.jpg') : $admin->photo }}"
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                        Details</a>

                                                                    @if (app('Menu')->canEdit(Auth::user()->role_id, 2) == true)
                                                                        <a class="dropdown-item mb-2" href="#"
                                                                            data-bs-toggle="offcanvas"
                                                                            data-bs-target="#editAdmin"
                                                                            data-backdrop="static"
                                                                            data-myid="{{ $admin->id }}"
                                                                            data-surname="{{ $admin->lastName }}"
                                                                            data-firstname="{{ $admin->firstName }}"
                                                                            data-othernames="{{ $admin->otherNames }}"
                                                                            data-email="{{ $admin->email }}"
                                                                            data-phone="{{ $admin->phoneNumber }}"
                                                                            data-role="{{ $admin->role_id }}"><i
                                                                                class="fe fe-eye dropdown-item-icon"></i>Edit
                                                                            Details</a>
                                                                    @endif
                                                                </li>

                                                                @if (app('Menu')->canEdit(Auth::user()->role_id, 2) == true)
                                                                    @if ($admin->status == 'active')
                                                                        <a class="dropdown-item mb-2"
                                                                            href="{{ route('admin.suspendAdmin', [$admin->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to suspend this account?')">Suspend
                                                                            Account</a>
                                                                    @else
                                                                        <a class="dropdown-item mb-2"
                                                                            href="{{ route('admin.activateAdmin', [$admin->id]) }}"
                                                                            onclick="return confirm('Are you sure you want to activate this account?')">Activate
                                                                            Account</a>
                                                                    @endif
                                                                @endif

                                                            </ul>
                                                        </div>
                                                    @else
                                                        <button class="btn btn-primary btn-sm dropdown-toggle disabled"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
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

    @if (app('Menu')->canCreate(Auth::user()->role_id, 2) == true)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">New Administrative User</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.storeAdmin') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Surname </strong><span
                                        class="text-danger">*</span></label>
                                <input type="text" name="surname" class="form-control" placeholder="Surname" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>First Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                    required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Other Names</strong></label>
                                <input type="text" name="other_names" class="form-control" placeholder="Other Names">
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Email Address</strong> <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Email Address"
                                    required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Phone Number</strong></label>
                                <input id="numberInput" type="text" name="phone_number" class="form-control"
                                    placeholder="Phone Number">
                            </div>

                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>Assigned Role</strong> <span
                                        class="text-danger">*</span></label>
                                <select id="role" name="assigned_role" class="form-select" data-width="100%"
                                    required>
                                    <option value="">Select Role</option>
                                    @foreach ($userRoles as $ur)
                                        <option value="{{ $ur->id }}">{{ $ur->role }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 border-bottom"></div>
                            <!-- button -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary" type="submit">Add User</button>
                                <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                                    aria-label="Close">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="viewAdmin" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="newCatgoryLabel">
                        View User Account Details
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
                                <td class="" rowspan="7" align="right"
                                    style="text-align: center; vertical-align: top"><img src="" id="vphoto"
                                        class="img-responsive" style="max-width: 150px" />
                                </td>
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
                                <td class="">Email</td>
                                <td class=""><span id="vemail"></span></td>
                            </tr>

                            <tr>
                                <td class="">Phone Number</td>
                                <td class=""><span id="vphone"></span></td>
                            </tr>

                            <tr>
                                <td class="">Assigned Role</td>
                                <td class=""><span id="vrole"></span></td>
                            </tr>

                            <tr>
                                <td class="">Date Created</td>
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

    @if (app('Menu')->canEdit(Auth::user()->role_id, 2) == true)
        <div class="offcanvas offcanvas-end" tabindex="-1" id="editAdmin" style="width: 600px;">
            <div class="offcanvas-body" data-simplebar>
                <div class="offcanvas-header px-2 pt-0">
                    <h3 class="offcanvas-title" id="offcanvasExampleLabel">Update Administrative User Details</h3>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- card body -->
                <div class="container">
                    <!-- form -->
                    <form method="post" action="{{ route('admin.updateAdmin') }}">
                        @csrf
                        <div class="row">
                            <!-- form group -->
                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Surname </strong><span
                                        class="text-danger">*</span></label>
                                <input id='surname' type="text" name="surname" class="form-control"
                                    placeholder="Surname" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>First Name</strong> <span
                                        class="text-danger">*</span></label>
                                <input id="firstname" type="text" name="first_name" class="form-control"
                                    placeholder="First Name" required>
                            </div>

                            <div class="mb-3 col-12">
                                <label class="form-label"><strong>Other Names</strong></label>
                                <input id="othernames" type="text" name="other_names" class="form-control"
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
                                <input id="phone" type="text" name="phone_number"
                                    class="form-control numberInput" placeholder="Phone Number">
                            </div>


                            <div class="mb-4 col-12">
                                <label class="form-label"><strong>Assigned Role</strong> <span
                                        class="text-danger">*</span></label>
                                <select id="assignedrole" name="assigned_role" class="form-select" data-width="100%"
                                    required>
                                    @foreach ($userRoles as $ur)
                                        <option value="{{ $ur->id }}">{{ $ur->role }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input id="myid" type="hidden" name="admin_id" class="form-control" required>

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
        document.getElementById("admins").classList.add('active');
    </script>
@endsection
