@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Settings / Dynamic Settlements')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">Settings / Dynamic Settlements</h6>
                <div class="custom-alert fade show custom-alert-primary">
                    <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                    &nbsp;Your Business is under Review!
                </div>
                <div class="container nopadding">
                    <div class="row align-items-center">
                        <!-- All elements in a single row on desktop but stacked on mobile -->
                        <div class="col-12 d-md-flex justify-content-between align-items-center flex-wrap gap-3 nopadding">

                            <div class="custombox" style="display: flex; gap: 10px">
                                <a href="{{ route('business.settings.settlement') }}" class="tabinactive">
                                    <div class="tabtext">Default Settlement Configuration</div>
                                </a>
                                <a href="{{ route('business.settings.dynamicSettlement') }}" class="tabactive">
                                    <div class="tabtext">Dynamic Settlement Configuration</div>
                                </a>
                                <a href="{{ route('business.settings.settlementAccounts') }}" class="tabinactive">
                                    <div class="tabtext">Settlement Accounts</div>
                                </a>
                            </div>


                            <!-- Right: Dropdowns and Filter (Will stack on mobile) -->
                            <div class="d-flex flex-wrap gap-3">


                                <!-- Filter Button -->
                                <div class="custombox" style="margin-right: 10px" data-toggle="modal" data-target="#createService"
                                data-backdrop="static" data-keyboard="false">
                                    <span class="atext">
                                        <i class="far fa-plus-square" style="font-size: 12px"></i> Create Service
                                    </span>&nbsp;

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
                                        <th>Service Name</th>
                                        <th>Service ID</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Service</th>
                                        <th>Split Type</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="bg-white">
                                        <td colspan="8">
                                            <div class="text-center rounded pdt-5x pdb-5x">
                                                <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No
                                                    Settlement Service Found!
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

    <div aria-hidden="true" aria-labelledby="createService" class="modal fade" id="createService" role="dialog"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Add a new settlement service
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
                                <label for="">Service Name</label>
                                <input type="text" name="service_name" value="" placeholder="Service Name"
                                    class="form-control" required />

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Service Description</label>
                                <textarea type="text" name="service_description" class="form-control" rows="3" style="resize:none" required
                                    placeholder="Service Description"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-primary" type="submit" style="font-size:13px">Add New Settlement Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
