@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Disputes')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">Disputes</h6>
                <div class="custom-alert fade show custom-alert-primary">
                    <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                    &nbsp;Your Business is under Review!
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="d-flex justify-content-end w-100">
                            <div class="custombox">
                                <span class="atext" data-toggle="modal" data-target="#raiseDispute"
                                    data-backdrop="static" data-keyboard="false">
                                    <span class="os-icon os-icon-filter"></span> Raise a Dispute
                                </span> &nbsp; | &nbsp;
                                <span class="atext" data-bs-toggle="offcanvas" data-bs-target="#filter">
                                    <span class="os-icon os-icon-filter"></span> Filter
                                </span> &nbsp; | &nbsp;
                                <span class="atext">
                                    <a href="" class="atext"><span class="os-icon os-icon-download"></span>
                                        Download</a>
                                </span>
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
                                    <th>Reason</th>
                                    <th>Notes</th>
                                    <th>Document</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white">
                                    <td colspan="7">
                                        <div class="text-center rounded pdt-5x pdb-5x">
                                            <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No
                                                Dispute Found!
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


@endsection
