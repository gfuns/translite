@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Webhook Logs')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">Webhook Logs</h6>
                <div class="custom-alert fade show custom-alert-primary">
                    <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                    &nbsp;Your Business is under Review!
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="d-flex justify-content-end w-100">

                                <div class="dropdown">
                                    <div class="custombox dropdown-toggle" id="dateDropdown"
                                        data-bs-toggle="dropdown">
                                        <span class="atext">Past 7 days: Mar 13 to Mar 20, 2025</span>
                                    </div>
                                    <ul class="dropdown-menu" aria-labelledby="dateDropdown">
                                        <li><a class="dropdown-item" href="#">Yesterday: Mar 19, 2025</a>
                                        </li>
                                        <hr class="dropdown-divider">
                                        <li><a class="dropdown-item" href="#">Today: Mar 20, 2025</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a class="dropdown-item" href="#">Past 7 days: Mar 13 to Mar
                                                20, 2025</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a class="dropdown-item" href="#">This Week: Mar 17 to Mar 20,
                                                2025</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a class="dropdown-item" href="#">Last Week: Mar 17 to Mar 20,
                                                2025</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a class="dropdown-item" href="#">This Month: Mar 17 to Mar
                                                20,
                                                2025</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a class="dropdown-item" href="#">Last Month: Mar 17 to Mar
                                                20,
                                                2025</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a class="dropdown-item" href="#">Custom Date Range</a></li>
                                    </ul>
                                </div>

                        </div>

                    </div>
                </div>

                <div class="element-box" style="padding: 1px">
                    <div class="table-responsive">
                        <table id="" width="100%" class="table table-striped table-lightfont">
                            <thead>
                                <tr>
                                    <th>S/No</th>
                                    <th>Trans. Date</th>
                                    <th>Trans. ID</th>
                                    <th>Service</th>
                                    <th>Payload</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white">
                                    <td colspan="7">
                                        <div class="text-center rounded pdt-5x pdb-5x">
                                            <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No
                                                Webhook Logs Found!
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div aria-hidden="true" aria-labelledby="raiseDispute" class="modal fade" id="raiseDispute" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Raise a Dispute
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true"> &times;</span>
                </button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Transaction ID</label>
                                <input type="text" name="transaction_id" value="" placeholder="Transaction ID"
                                    class="form-control" required />

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Reason For Dispute</label>
                                <select id="pm" name="payment_method" class="select form-control" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="Customer paid twice errorneously and both were successful">Customer
                                        paid twice errorneously and both were successful</option>
                                    <option value="Customer paid and merchant is unable to deliver value">Customer paid
                                        and merchant is unable to deliver value</option>
                                    <option value="Customer and merchant agree to refund a successful transaction">
                                        Customer and merchant agree to refund a successful transaction</option>
                                    <option value="Customer is displeased with merchant on goods and services rendered">
                                        Customer is displeased with merchant on goods and services rendered</option>
                                    <option value="Merchant needs to refund a customer">Merchant needs to refund a
                                        customer</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Upload Supporting Document</label>
                                <input type="file" name="supporting_document" value=""
                                    placeholder="Upload Supporting Document" class="form-control " required />

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Notes</label>
                                <textarea type="text" name="notes" class="form-control" rows="5" style="resize:none" required
                                    placeholder="Describe the situation"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Close</button>
                    <button class="btn btn-primary" type="submit">
                        Submit Dispute
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title" id="offcanvasLabel">Filters</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fa fa-times"></i></button>
    </div>
    <div class="offcanvas-body">
        <!-- Add your filter form or content here -->
        <form method="POST" action="">
            @csrf
            <div class="mb-3">
                <label for="dateRange" class="form-label">Date Range</label>
                <input type="text" class="form-control" id="dateRange" placeholder="Select Date Range"
                    name="date_range">
            </div>

            <div class="mb-3">
                <label for="transId" class="form-label">Transaction ID</label>
                <input type="text" class="form-control" id="transId" placeholder="Transaction ID"
                    name="transaction_id">
            </div>
            <div class="mb-5">
                <label for="status" class="form-label">Status</label>
                <select id="status" class="form-control" name="status">
                    <option value="">Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>
            <hr/>
            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-outline-primary" id="clearFilters"><i class="fa fa-trash"></i> Clear Filters</button>
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </div>
        </form>
    </div>
</div>
@endsection
