@extends('business.layouts.app')

@section('content')
@section('title', 'TransLite | Settings / Representatives')

<div class="content-w">

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">Settings / Representatives </h6>
                <div class="custom-alert fade show custom-alert-primary">
                    <span class="os-icon os-icon-alert-circle" style="font-weight:bold"></span>
                    &nbsp;Your Business is under Review!
                </div>
                <div class="container nopadding">
                    <div class="row align-items-center">
                        <!-- All elements in a single row on desktop but stacked on mobile -->
                        <div
                            class="col-12 d-md-flex justify-content-between align-items-center flex-wrap gap-3 nopadding">

                            <div class="custombox" style="display: flex; gap: 10px">
                                <a href="{{ route('business.settings.businessType') }}" class="tabinactive">
                                    <div class="tabtext">Business Type</div>
                                </a>
                                <a href="{{ route('business.settings.about') }}" class="tabinactive">
                                    <div class="tabtext">Business Details</div>
                                </a>
                                <a href="{{ route('business.settings.bizDocuments') }}" class="tabinactive">
                                    <div class="tabtext">KYC Documents</div>
                                </a>

                                <a href="{{ route('business.settings.notifSettings') }}" class="tabinactive">
                                    <div class="tabtext">Notifications</div>
                                </a>

                                <a href="{{ route('business.settings.bizReps') }}" class="tabactive">
                                    <div class="tabtext">Representatives</div>
                                </a>

                                <a href="{{ route('business.settings.paymentSettings') }}" class="tabinactive">
                                    <div class="tabtext">Payment</div>
                                </a>
                            </div>


                            <!-- Right: Dropdowns and Filter (Will stack on mobile) -->
                            <div class="d-flex flex-wrap gap-3">


                                <!-- Filter Button -->
                                <div class="custombox" style="margin-right: 10px" data-toggle="modal"
                                    data-target="#addRep" data-backdrop="static" data-keyboard="false">
                                    <span class="atext">
                                        <i class="far fa-plus-square" style="font-size: 12px"></i> Add Representative
                                    </span>&nbsp;

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
                                    <th>S/No</th>
                                    <th>BVN</th>
                                    <th>Date of Birth</th>
                                    <th>Full Name</th>
                                    <th>Designation</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Identity</th>
                                    <th>Photo</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="bg-white">
                                    <td colspan="8">
                                        <div class="text-center rounded pdt-5x pdb-5x">
                                            <p><em class="far fa-sad-tear" style="font-size:46px"></em><br><br>No
                                                Representative Information Found!
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

<div aria-hidden="true" aria-labelledby="addRep" class="modal fade" id="addRep" role="dialog"
tabindex="-1">
<div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                <strong>Add new business representative</strong>
            </h5>
            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                <span aria-hidden="true"> &times;</span>
            </button>
        </div>

        <div class="modal-body">

            <div class="tabs">
                <a href="#" class="tab-link active" data-tab="nigerian">Nigerian</a>
                <a href="#" class="tab-link" data-tab="other">Other Nationality</a>
            </div>

            {{-- <div class="tabs">
                    <button type="button" class="tab-btn active" data-tab="nigerian">Nigerian</button>
                    <button type="button" class="tab-btn" data-tab="other">Other Nationality</button>
                </div> --}}

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Nigerian Tab -->
                <div class="tab-panel active" id="nigerian">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        {{-- <label>
                            <input type="checkbox" id="under18">
                            Are you a registered director under 18 years old without a BVN?
                        </label> --}}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="formalabel" for="">Bank Verification Number
                                        (BVN)</label>
                                    <input type="text" name="BVN" value=""
                                        placeholder="Bank Verification Number" class="form-control"
                                        required />

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="formalabel" for="">Designation</label>
                                    <select id="designation" name="currency" required>
                                        <option value="">Select Designation</option>
                                        <option value="Business Owner">Business Owner</option>
                                        <option value="Authorized Signatory">Authorized Signatory</option>
                                        <option value="Director">Director</option>
                                        <option value="Director & Shareholder">Director & Shareholder
                                        </option>
                                        <option value="Shareholder">Shareholder</option>
                                        <option value="Member">Member</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="formalabel" for="">Verification Document</label>
                                    <select id="veridoc" name="bank" required
                                        onchange="setDocumentType('document-type', this.value)">
                                        <option value="">Select Document Type</option>
                                        <option value="Driver License">Driver License</option>
                                        <option value="Permanent Voter Card (PVC)">Permanent Voter Card
                                            (PVC)
                                        </option>
                                        <option value="National Identity Card">National Identity Card
                                        </option>
                                        <option value="International Passport">International Passport
                                        </option>
                                        <option value="Birth Certificate">Birth Certificate</option>
                                        <option value="Resident Permit">Resident Permit</option>
                                    </select>

                                </div>
                            </div>
                        </div>


                        <!-- File Upload Fields -->
                        <div class="row g-3">
                            <!-- Driver License Upload -->
                            <div class="col-12 col-md-6 mb-1">
                                <label class="custom-file-upload d-flex align-items-center gap-2"
                                    onclick="document.getElementById('driver-license').click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                        viewBox="0 0 16 14" fill="none">
                                        <path
                                            d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                            stroke="#0765FF" stroke-width="1.45455"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg> <span id="document-type">Select Document</span>
                                </label>
                                <input type="file" id="driver-license" class="hidden-input"
                                    onchange="updateFileName('document-type', this)">
                            </div>

                            <!-- Passport Photo Upload -->
                            <div class="col-12 col-md-6 mb-1">
                                <label class="custom-file-upload d-flex align-items-center gap-2"
                                    onclick="document.getElementById('passport-photo').click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                        viewBox="0 0 16 14" fill="none">
                                        <path
                                            d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                            stroke="#0765FF" stroke-width="1.45455"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg> <span id="passport-name">Passport Photo</span>
                                </label>
                                <input type="file" id="passport-photo" class="hidden-input"
                                    onchange="updateFileName('passport-name', this)">
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary w-100 mt-4">Save</button>
                    </form>
                </div>

                <!-- Other Nationality Tab -->
                <div class="tab-panel" id="other">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="formalabel" for="">Last Name</label>
                                    <input type="text" name="BVN" value=""
                                        placeholder="Last Name" class="form-control" required />

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="formalabel" for="">Other Names</label>
                                    <input type="text" name="BVN" value=""
                                        placeholder="Other Names" class="form-control" required />

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="formalabel" for="">Email Address</label>
                                    <input type="email" name="BVN" value=""
                                        placeholder="Email Address" class="form-control" required />

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="formalabel" for="">Phone Number</label>
                                    <input type="text" name="BVN" value=""
                                        placeholder="Phone Number" class="form-control" required />

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="formalabel" for="">Date of Birth</label>
                                    <input type="date" name="BVN" value=""
                                        placeholder="Date of Birth" class="form-control" required />

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="formalabel" for="">Designation</label>
                                    <select id="representative" name="currency" required>
                                        <option value="">Select Designation</option>
                                        <option value="Business Owner">Business Owner</option>
                                        <option value="Authorized Signatory">Authorized Signatory
                                        </option>
                                        <option value="Director">Director</option>
                                        <option value="Director & Shareholder">Director & Shareholder
                                        </option>
                                        <option value="Shareholder">Shareholder</option>
                                        <option value="Member">Member</option>
                                    </select>

                                </div>
                            </div>

                        </div>

                        <!-- File Upload Fields -->
                        <div class="row g-3">
                            <!-- Driver License Upload -->
                            <div class="col-12 col-md-6 mb-1">
                                <label class="custom-file-upload d-flex align-items-center gap-2"
                                    onclick="document.getElementById('foreigner-id').click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                        viewBox="0 0 16 14" fill="none">
                                        <path
                                            d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                            stroke="#0765FF" stroke-width="1.45455"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg> <span id="foreigner-document">Resident permit /
                                        International Passport</span>
                                </label>
                                <input type="file" id="foreigner-id" class="hidden-input"
                                    onchange="updateFileName('foreigner-document', this)">
                            </div>

                            <!-- Passport Photo Upload -->
                            <div class="col-12 col-md-6 mb-1">
                                <label class="custom-file-upload d-flex align-items-center gap-2"
                                    onclick="document.getElementById('foreigner-photo').click()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                        viewBox="0 0 16 14" fill="none">
                                        <path
                                            d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                            stroke="#0765FF" stroke-width="1.45455"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg> <span id="foreigner-passport">Passport Photo</span>
                                </label>
                                <input type="file" id="foreigner-photo" class="hidden-input"
                                    onchange="updateFileName('foreigner-passport', this)">
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
</div>



@endsection

@section('customjs')
<script src="{{ asset('js/bizreps.js') }}?version=4.5.0"></script>
@endsection

