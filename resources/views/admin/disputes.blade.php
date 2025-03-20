@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Customer Disputes</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table mb-0 text-nowrap table-hover table-centered">
                                    <thead>
                                        <tr>
                                            <td class="th">S/No.</td>
                                            <td class="th">Customer</td>
                                            <td class="th">Reference</td>
                                            <td class="th">Complaint/Issue Description</td>
                                            <td class="th">Status</td>
                                            <td class="th">Date Reported</td>
                                            <td class="th">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($disputes as $at)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $at->business->businessName }}</td>
                                                <td>{{ $at->reference }}</td>
                                                <td>{{ $at->description }}</td>
                                                <td>
                                                    @if ($at->status == 'closed')
                                                        <span class="badge badge-success p-2"
                                                            style="font-size: 10px">{{ ucwords($at->status) }}</span>
                                                    @else
                                                        <span class="badge badge-warning p-2"
                                                            style="font-size: 10px">{{ ucwords($at->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ date_format($at->created_at, 'jS M, Y') }}</td>

                                                <td class="align-middle">

                                                    <div class="btn-group dropdown">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" style="">
                                                            <li>
                                                                <a class="dropdown-item mb-2" href="#"
                                                                    data-bs-toggle="modal" data-bs-target="#viewDispute"
                                                                    data-backdrop="static" data-myid="{{ $at->id }}"
                                                                    data-customer="{{ $at->business->businessName }}"
                                                                    data-reference="{{ $at->reference }}"
                                                                    data-description="{{ $at->description }}"
                                                                    data-date="{{ date_format($at->created_at, 'jS F, Y') }}"
                                                                    data-feedback="{{ $at->support_feedback ?? 'Nil' }}"
                                                                    data-status="{{ ucwords($at->status) }}"><i
                                                                        class="fe fe-eye dropdown-item-icon"></i>View
                                                                    Details</a>
                                                                @if (app('Menu')->canEdit(Auth::user()->role_id, 9) == true)
                                                                    @if ($at->status == 'pending')
                                                                        <a class="dropdown-item mb-2" href="#"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#closeDispute"
                                                                            data-backdrop="static"
                                                                            data-myid="{{ $at->id }}"><i
                                                                                class="fe fe-eye dropdown-item-icon"></i>Mark
                                                                            As
                                                                            Closed</a>
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


    <div class="modal fade" id="viewDispute" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="newCatgoryLabel">
                        Customer Dispute Details
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class=""><strong>Customer:</strong></td>
                                <td class=""><span id="vcustomer"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Transaction Reference:</strong></td>
                                <td class=""><span id="vreference"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Complaint/Issue Description</strong></td>
                                <td class=""><span id="vdescription"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Status</strong></td>
                                <td class=""><span id="vstatus"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Date Reported</strong></td>
                                <td class=""><span id="vdate"></span></td>
                            </tr>

                            <tr>
                                <td class=""><strong>Support Feedback</strong></td>
                                <td class=""><span id="vfeedback"></span></td>
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

    @if (app('Menu')->canEdit(Auth::user()->role_id, 9) == true)
        <div class="modal fade" id="closeDispute" tabindex="-1" role="dialog" aria-labelledby="newCatgoryLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mb-0" id="newCatgoryLabel">
                            Provide Feedback To Customer Dispute
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <form method="post" action="{{ route('admin.closeDispute') }}">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <!-- form group -->
                                <div class="mb-3 col-12">
                                    <label class="form-label"><strong>Feedback </strong><span
                                            class="text-danger">*</span></label>
                                    <textarea name="feedback" class="form-control" placeholder="Feedback" required rows="10" style="resize: none"></textarea>
                                </div>
                                <input id="myid" type="hidden" name="dispute_id" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary ms-2"
                                data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Close Dispute</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script type="text/javascript">
        document.getElementById("disputes").classList.add('active');
    </script>
@endsection

@section('customjs')
    <script type="text/javascript">
        // Usage on an input field
        document.querySelector(".feeAmount").addEventListener("keydown", allowOnlyNumbersAndDecimal);
    </script>
@endsection
