@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Account Types</h4>
                                <button class="btn btn-primary ms-auto btn-sm" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRight">
                                    <i class="fa fa-plus"></i>
                                    New Account Type
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Account Type</td>
                                            <td class="th">Utility Limit</td>
                                            <td class="th">Transfer Limit</td>
                                            <td class="th">Withdrawal Limit</td>
                                            <td class="th">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($accountTypes as $at)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $at->level }}</td>
                                                <td>&#8358;{{ number_format($at->utility_limit, 2) }}</td>
                                                <td>&#8358;{{ number_format($at->transfer_limit, 2) }}</td>
                                                <td>&#8358;{{ number_format($at->withdrawal_limit, 2) }}</td>

                                                <td class="align-middle">

                                                    <div class="btn-group dropdown">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="">
                                                            <li>
                                                                <a class="dropdown-item mb-2" href="#"
                                                                    data-bs-toggle="offcanvas"
                                                                    data-bs-target="#editAccountType" data-backdrop="static"
                                                                    data-myid="{{ $at->id }}"
                                                                    data-level="{{ $at->level }}"
                                                                    data-utility="{{ $at->utility_limit }}"
                                                                    data-transfer="{{ $at->transfer_limit }}"
                                                                    data-withdrawal="{{ $at->withdrawal_limit }}"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>Edit
                                                                    Details</a>
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

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel">Add New Account Type</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form method="post" action="{{ route('admin.storeAccountType') }}">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Account Type </strong><span class="text-danger">*</span></label>
                            <input type="text" name="account_type" class="form-control" placeholder="Account Type" required>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Utility Limit</strong> <span class="text-danger">*</span></label>
                            <input id="utilityLimit" type="text" name="utility_limit" class="form-control" placeholder="Utility Limit" required>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Transfer Limit</strong></label>
                            <input id="transferLimit" type="text" name="transfer_limit" class="form-control" placeholder="Transfer Limit">
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Withdrawal Limit</strong> <span
                                    class="text-danger">*</span></label>
                            <input id="withdrawalLimit" type="text" name="withdrawal_limit" class="form-control" placeholder="Withdrawal Limit" required>
                        </div>


                        <div class="col-md-12 border-bottom"></div>
                        <!-- button -->
                        <div class="col-12 mt-4">
                            <button class="btn btn-primary" type="submit">Add Account Type</button>
                            <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas"
                                aria-label="Close">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="editAccountType" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel">Update Customer Details</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form method="post" action="{{ route('admin.updateAccountType') }}">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Account Type </strong><span class="text-danger">*</span></label>
                            <input id="accountType" type="text" name="account_type" class="form-control" placeholder="Account Type" required>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Utility Limit</strong> <span class="text-danger">*</span></label>
                            <input id="utilityLimit" type="text" name="utility_limit" class="form-control utilityLimit" placeholder="Utility Limit" required>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Transfer Limit</strong></label>
                            <input id="transferLimit" type="text" name="transfer_limit" class="form-control transferLimit" placeholder="Transfer Limit">
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Withdrawal Limit</strong> <span
                                    class="text-danger">*</span></label>
                            <input id="withdrawalLimit" type="text" name="withdrawal_limit" class="form-control withdrawalLimit" placeholder="Withdrawal Limit" required>
                        </div>

                        <input id="myid" type="hidden" name="account_type_id" class="form-control" required>

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

    <script type="text/javascript">
        document.getElementById("settings").classList.add('active');
        document.getElementById("platform").classList.add('show');
        document.getElementById("acctype").classList.add('active');
    </script>
@endsection

@section('customjs')
    <script type="text/javascript">
        // Usage on an input field
        document.getElementById("utilityLimit").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.querySelector(".utilityLimit").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.getElementById("transferLimit").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.querySelector(".transferLimit").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.getElementById("withdrawalLimit").addEventListener("keydown", allowOnlyNumbersAndDecimal);
        document.querySelector(".withdrawalLimit").addEventListener("keydown", allowOnlyNumbersAndDecimal);
    </script>
@endsection
