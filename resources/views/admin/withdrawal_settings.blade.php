@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Withdrawal Fee Configuration</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Transaction Type</td>
                                            <td class="th">Narration</td>
                                            <td class="th">Configuration Type</td>
                                            <td class="th">Trx. Fee</td>
                                            <td class="th">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($withdrawalSettings as $at)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ strtoupper($at->category) }} Withdrawals</td>
                                                <td>{{ $at->narration }}</td>
                                                <td>{{ ucwords($at->config) }}</td>
                                                @if ($at->config == 'fixed')
                                                    <td>&#8358;{{ number_format($at->fee_amount, 2) }}</td>
                                                @else
                                                    <td>{{ number_format($at->fee_amount, 2) }}<strong>%</strong></td>
                                                @endif

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
                                                                    data-bs-target="#editFeeAmount" data-backdrop="static"
                                                                    data-myid="{{ $at->id }}"
                                                                    data-narration="{{ $at->narration }}"
                                                                    data-transtype="{{ strtoupper($at->category) }} Withdrawals"
                                                                    data-config="{{ $at->config }}"
                                                                    data-amount="{{ $at->fee_amount }}"><i
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

    <div class="offcanvas offcanvas-end" tabindex="-1" id="editFeeAmount" style="width: 600px;">
        <div class="offcanvas-body" data-simplebar>
            <div class="offcanvas-header px-2 pt-0">
                <h3 class="offcanvas-title" id="offcanvasExampleLabel">Update Fee Amount</h3>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <!-- card body -->
            <div class="container">
                <!-- form -->
                <form method="post" action="{{ route('admin.updateFeeAmount') }}">
                    @csrf
                    <div class="row">
                        <!-- form group -->
                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Transaction Type </strong><span class="text-danger">*</span></label>
                            <input id="transType" type="text" name="transaction_type" class="form-control" placeholder="Transaction Type" required readonly>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Narration </strong><span
                                    class="text-danger">*</span></label>
                            <input id="narration" type="text" name="narration" class="form-control"
                                placeholder="Narration" required>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Configuration Type </strong><span
                                    class="text-danger">*</span></label>
                            <select id="configType" name="configType" class="form-select" data-width="100%" required>
                                <option value="">Select Configuration Type</option>
                                <option value="fixed">Fixed</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label"><strong>Trx. Fee</strong> <span class="text-danger">*</span></label>
                            <input id="feeAmount" type="text" name="fee_amount" class="form-control" placeholder="Fee Amount" required>
                        </div>

                        <input id="myid" type="hidden" name="fee_id" class="form-control" required>

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
        document.getElementById("wdrfee").classList.add('active');
    </script>
@endsection

@section('customjs')
    <script type="text/javascript">
        // Usage on an input field
        document.querySelector(".feeAmount").addEventListener("keydown", allowOnlyNumbersAndDecimal);
    </script>
@endsection
