@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Request POS Terminal')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">Request POS Terminal</h6>
                <div class="custom-alert fade show custom-alert-primary">
                    <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                    &nbsp;Your Business is under Review!
                </div>
                <div class="container nopadding">
                    <div class="row align-items-center">
                        <!-- All elements in a single row on desktop but stacked on mobile -->
                        <div class="col-12 d-md-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div>
                                <div class="custombox" style="display: flex; gap: 10px">
                                    <a href="{{ route('business.pos.terminals') }}" class="tabinactive">
                                        <div class="tabtext">Terminals</div>
                                    </a>
                                    <a href="{{ route('business.pos.branches') }}" class="tabinactive">
                                        <div class="tabtext">Branches</div>
                                    </a>

                                    <a href="{{ route('business.paymentTrxs') }}" class="tabinactive">
                                        <div class="tabtext">Transactions</div>
                                    </a>
                                </div>
                            </div>


                            <!-- Right: Dropdowns and Filter (Will stack on mobile) -->
                            <div class="d-flex flex-wrap gap-3">


                                <!-- Filter Button -->
                                <div class="custombox">
                                    <span class="atext" data-toggle="modal" data-target="#requestTerminal"
                                        data-backdrop="static" data-keyboard="false">
                                        <span class="os-icon os-icon-edit"></span> Request Terminal
                                    </span>&nbsp; | &nbsp;
                                    <span class="atext" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
                                        <span class="os-icon os-icon-filter"></span> Filter
                                    </span>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="element-box" style="padding: 1px">
                    <div class="table-responsive">
                        <table id="" width="100%" class="table table-striped table-lightfont">
                            <thead>
                                <tr>
                                    <th>S/No.</th>
                                    <th>Requesting Branch</th>
                                    <th>Quantity</th>
                                    <th>Request Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white">
                                    <td colspan="8">
                                        <div class="text-center rounded pdt-5x pdb-5x">
                                            <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No
                                                Terminal Request Found!
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


<div aria-hidden="true" aria-labelledby="requestTerminal" class="modal fade" id="requestTerminal" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Request Terminal
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true"> &times;</span>
                </button>
            </div>
            <form method="post" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Requesting Branch</label>
                                <select id="pm" name="branch" class="select form-control" required>
                                    <option value="">Select Branch</option>
                                    <option value="Kubwa">Kubwa</option>
                                    <option value="Wuse">Wuse</option>
                                    <option value="Gwarimpa">Gwarimpa</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="number" name="quanity" value="" placeholder="Quantity"
                                    class="form-control" required />

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Notes</label>
                                <textarea type="text" name="notes" class="form-control" rows="5" style="resize:none" required
                                    placeholder="Notes or Comments"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Close</button>
                    <button class="btn btn-primary" type="submit">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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
            <hr />
            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-outline-primary" id="clearFilters"><i class="fa fa-trash"></i>
                    Clear Filters</button>
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </div>
        </form>
    </div>
</div>

@endsection
