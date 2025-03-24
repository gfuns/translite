<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="apps" content="Xtratech Global Solution">
    <meta name="author" content="Xtratech Global Solution">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>KYC Application | TransLite</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.css') }}?ver=20241116180">
    <link rel="stylesheet" href="{{ asset('assets/css/kyc.css') }}?ver=20241116180">
    <link rel="stylesheet" href="{{ asset('assets/css/kyc-new.css') }}?ver=20241116180">

    <style>
        .document-item {
            display: flex;
            margin-bottom: 10px;
            min-height: 40px;
            padding: 10px;
            -webkit-box-pack: justify;
            justify-content: space-between;
            -webkit-box-align: center;
            align-items: center;
            border-radius: 5px;
            background: rgb(245, 246, 248);
            flex: 1 1 0%;
            width: 100%;
            font-size: 12px;
            cursor: pointer;
            color: black;
            /* font-weight: bold; */
            /* display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-radius: 5px;
            background: #f8f9fa;
            margin-bottom: 10px;
            transition: 0.3s; */
        }

        .tool-tip {
            margin-left: 10px;
        }

        .document-item.uploaded {
            background-color: rgb(236, 242, 255);
        }

        .optional {
            color: #f4a261;
            font-weight: bold;
            font-size: 10px;
            margin-left: 5px;
        }

        .document-item i {
            color: #6c757d;
            cursor: pointer;
        }

        .delete-icon {
            color: red;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .folder-title {
            margin-left: 15px;
        }

        .eye-icon {
            margin-right: 10px;
        }
    </style>

</head>

<body class="page-ath theme-modern page-ath-modern">

    <div class="page-ath-wrap flex-row-reverse">
        <div class="page-ath-content customPageContent">
            <div class="page-ath-form center-div">
                <div class="progress-container">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                        <a href="{{ route('business.kyc.apply') }}?current=4">
                            <div class="btn-back mb-4"><i class="fas fa-angle-left"></i> &nbsp;Previous Step</div>
                        </a>
                        <div class="mb-5 mobileDoLater ">
                            <a href="{{ route('business.dashboard') }}" class="dolater">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none">
                                    <path
                                        d="M7.4165 6.29922C7.67484 3.29922 9.2165 2.07422 12.5915 2.07422H12.6998C16.4248 2.07422 17.9165 3.56589 17.9165 7.29089V12.7242C17.9165 16.4492 16.4248 17.9409 12.6998 17.9409H12.5915C9.2415 17.9409 7.69984 16.7326 7.42484 13.7826"
                                        stroke="#667085" stroke-width="1.25" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                    <path d="M12.4999 10H3.0166" stroke="#667085" stroke-width="1.25"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M4.87516 7.20898L2.0835 10.0007L4.87516 12.7923" stroke="#667085"
                                        stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span style="margin-left: 10px">I'll do this later.</span>
                            </a>
                        </div>
                    </div>

                    <div class="stepDisplay">Step 5 of 8</div>
                    <div class="processHeading">Upload Business Documents</div>
                    <p class="processDescription mb-3">Kindly upload the following required documents, so we can verify
                        your account and deposit your earnings. Only .pdf, .png, .jpg and .jpeg files are allowed (max
                        size 10mb each).</p>
                    <p class="processDescription mb-5">Proof of address cannot be older than 3 months (except for rental
                        agreement).</p>
                    <form id="formValidate" method="post" action="">
                        @csrf

                        <div class="document-container mb-5">
                            <!-- Document List -->
                            <div id="documentList">
                                <!-- Document Item -->
                                <div class="document-item" onclick="document.getElementById('cac').click()">
                                    <div class="folder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                            viewBox="0 0 17 16" fill="none">
                                            <path opacity="0.4"
                                                d="M10.9804 1.3335H6.02038C5.76704 1.3335 5.55371 1.54683 5.55371 1.80016C5.55371 2.0535 5.76704 2.26683 6.02038 2.26683H8.19371L9.12704 3.50683C9.33371 3.78016 9.36038 3.82016 9.74704 3.82016H12.227C12.4804 3.82016 12.727 3.8535 12.967 3.92016C12.9937 4.04016 13.007 4.16016 13.007 4.28683V4.52016C13.007 4.7735 13.2204 4.98683 13.4737 4.98683C13.727 4.98683 13.9404 4.7735 13.9404 4.52016V4.28016C13.927 2.6535 12.607 1.3335 10.9804 1.3335Z"
                                                fill="#98A2B3"></path>
                                            <path
                                                d="M13.9263 4.36016C13.6397 4.1535 13.313 4.00016 12.9597 3.9135C12.7263 3.84683 12.473 3.8135 12.2197 3.8135H9.73967C9.35301 3.8135 9.32634 3.7735 9.11967 3.50016L8.18634 2.26016C7.75301 1.68683 7.41301 1.3335 6.32634 1.3335H4.77967C3.15301 1.3335 1.83301 2.6535 1.83301 4.28016V11.7202C1.83301 13.3468 3.15301 14.6668 4.77967 14.6668H12.2197C13.8463 14.6668 15.1663 13.3468 15.1663 11.7202V6.76016C15.1663 5.76683 14.6797 4.8935 13.9263 4.36016ZM10.053 10.6668H6.94634C6.68634 10.6668 6.47967 10.4602 6.47967 10.2002C6.47967 9.94683 6.68634 9.7335 6.94634 9.7335H10.0463C10.2997 9.7335 10.513 9.94683 10.513 10.2002C10.513 10.4602 10.3063 10.6668 10.053 10.6668Z"
                                                fill="#98A2B3"></path>
                                        </svg>
                                        <span id="cac-document" class="folder-title">CAC Certificate of
                                            Registration</span>

                                        <span class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Certificate of Registration issued by CAC.">
                                            <i class="fas fa-info-circle"></i>
                                        </span>

                                    </div>
                                    <div>
                                        <input type="file" id="cac" class="hidden-input"
                                            onchange="updateFileName('cac-document', this)">

                                        {{-- <input type="file" id="file1" class="d-none"
                                            onchange="handleFileUpload(event, 1)"> --}}
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                            viewBox="0 0 16 14" fill="none">
                                            <path
                                                d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                stroke="#0765FF" stroke-width="1.45455" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>

                                    </div>
                                </div>

                                <div class="document-item" onclick="document.getElementById('memorandum').click()">
                                    <div class="folder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                            viewBox="0 0 17 16" fill="none">
                                            <path opacity="0.4"
                                                d="M10.9804 1.3335H6.02038C5.76704 1.3335 5.55371 1.54683 5.55371 1.80016C5.55371 2.0535 5.76704 2.26683 6.02038 2.26683H8.19371L9.12704 3.50683C9.33371 3.78016 9.36038 3.82016 9.74704 3.82016H12.227C12.4804 3.82016 12.727 3.8535 12.967 3.92016C12.9937 4.04016 13.007 4.16016 13.007 4.28683V4.52016C13.007 4.7735 13.2204 4.98683 13.4737 4.98683C13.727 4.98683 13.9404 4.7735 13.9404 4.52016V4.28016C13.927 2.6535 12.607 1.3335 10.9804 1.3335Z"
                                                fill="#98A2B3"></path>
                                            <path
                                                d="M13.9263 4.36016C13.6397 4.1535 13.313 4.00016 12.9597 3.9135C12.7263 3.84683 12.473 3.8135 12.2197 3.8135H9.73967C9.35301 3.8135 9.32634 3.7735 9.11967 3.50016L8.18634 2.26016C7.75301 1.68683 7.41301 1.3335 6.32634 1.3335H4.77967C3.15301 1.3335 1.83301 2.6535 1.83301 4.28016V11.7202C1.83301 13.3468 3.15301 14.6668 4.77967 14.6668H12.2197C13.8463 14.6668 15.1663 13.3468 15.1663 11.7202V6.76016C15.1663 5.76683 14.6797 4.8935 13.9263 4.36016ZM10.053 10.6668H6.94634C6.68634 10.6668 6.47967 10.4602 6.47967 10.2002C6.47967 9.94683 6.68634 9.7335 6.94634 9.7335H10.0463C10.2997 9.7335 10.513 9.94683 10.513 10.2002C10.513 10.4602 10.3063 10.6668 10.053 10.6668Z"
                                                fill="#98A2B3"></path>
                                        </svg>
                                        <span id="memorandum-doc" class="folder-title">Memorandum of Association</span>
                                        <span class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Memorandum of Association."><i class="fas fa-info-circle"></i></span>

                                    </div>
                                    <div>
                                        <input type="file" id="memorandum" class="hidden-input"
                                            onchange="updateFileName('memorandum-doc', this)">

                                        {{-- <input type="file" id="file1" class="d-none"
                                            onchange="handleFileUpload(event, 1)"> --}}
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                            viewBox="0 0 16 14" fill="none">
                                            <path
                                                d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                stroke="#0765FF" stroke-width="1.45455" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>

                                    </div>
                                </div>


                                <div class="document-item" onclick="document.getElementById('cac7').click()">
                                    <div class="folder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                            viewBox="0 0 17 16" fill="none">
                                            <path opacity="0.4"
                                                d="M10.9804 1.3335H6.02038C5.76704 1.3335 5.55371 1.54683 5.55371 1.80016C5.55371 2.0535 5.76704 2.26683 6.02038 2.26683H8.19371L9.12704 3.50683C9.33371 3.78016 9.36038 3.82016 9.74704 3.82016H12.227C12.4804 3.82016 12.727 3.8535 12.967 3.92016C12.9937 4.04016 13.007 4.16016 13.007 4.28683V4.52016C13.007 4.7735 13.2204 4.98683 13.4737 4.98683C13.727 4.98683 13.9404 4.7735 13.9404 4.52016V4.28016C13.927 2.6535 12.607 1.3335 10.9804 1.3335Z"
                                                fill="#98A2B3"></path>
                                            <path
                                                d="M13.9263 4.36016C13.6397 4.1535 13.313 4.00016 12.9597 3.9135C12.7263 3.84683 12.473 3.8135 12.2197 3.8135H9.73967C9.35301 3.8135 9.32634 3.7735 9.11967 3.50016L8.18634 2.26016C7.75301 1.68683 7.41301 1.3335 6.32634 1.3335H4.77967C3.15301 1.3335 1.83301 2.6535 1.83301 4.28016V11.7202C1.83301 13.3468 3.15301 14.6668 4.77967 14.6668H12.2197C13.8463 14.6668 15.1663 13.3468 15.1663 11.7202V6.76016C15.1663 5.76683 14.6797 4.8935 13.9263 4.36016ZM10.053 10.6668H6.94634C6.68634 10.6668 6.47967 10.4602 6.47967 10.2002C6.47967 9.94683 6.68634 9.7335 6.94634 9.7335H10.0463C10.2997 9.7335 10.513 9.94683 10.513 10.2002C10.513 10.4602 10.3063 10.6668 10.053 10.6668Z"
                                                fill="#98A2B3"></path>
                                        </svg>
                                        <span id="cac7-doc" class="folder-title">CAC 7 (Registered Directors) or CAC
                                            Status
                                            Report</span>
                                        <span class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="CAC 7 (Registered Directors) or CAC Status
                                        Report"><i class="fas fa-info-circle"></i></span>

                                    </div>
                                    <div>
                                        <input type="file" id="cac7" class="hidden-input"
                                            onchange="updateFileName('cac7-doc', this)">

                                        {{-- <input type="file" id="file1" class="d-none"
                                            onchange="handleFileUpload(event, 1)"> --}}
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                            viewBox="0 0 16 14" fill="none">
                                            <path
                                                d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                stroke="#0765FF" stroke-width="1.45455" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>

                                    </div>
                                </div>

                                <div class="document-item" onclick="document.getElementById('cac2').click()">
                                    <div class="folder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                            viewBox="0 0 17 16" fill="none">
                                            <path opacity="0.4"
                                                d="M10.9804 1.3335H6.02038C5.76704 1.3335 5.55371 1.54683 5.55371 1.80016C5.55371 2.0535 5.76704 2.26683 6.02038 2.26683H8.19371L9.12704 3.50683C9.33371 3.78016 9.36038 3.82016 9.74704 3.82016H12.227C12.4804 3.82016 12.727 3.8535 12.967 3.92016C12.9937 4.04016 13.007 4.16016 13.007 4.28683V4.52016C13.007 4.7735 13.2204 4.98683 13.4737 4.98683C13.727 4.98683 13.9404 4.7735 13.9404 4.52016V4.28016C13.927 2.6535 12.607 1.3335 10.9804 1.3335Z"
                                                fill="#98A2B3"></path>
                                            <path
                                                d="M13.9263 4.36016C13.6397 4.1535 13.313 4.00016 12.9597 3.9135C12.7263 3.84683 12.473 3.8135 12.2197 3.8135H9.73967C9.35301 3.8135 9.32634 3.7735 9.11967 3.50016L8.18634 2.26016C7.75301 1.68683 7.41301 1.3335 6.32634 1.3335H4.77967C3.15301 1.3335 1.83301 2.6535 1.83301 4.28016V11.7202C1.83301 13.3468 3.15301 14.6668 4.77967 14.6668H12.2197C13.8463 14.6668 15.1663 13.3468 15.1663 11.7202V6.76016C15.1663 5.76683 14.6797 4.8935 13.9263 4.36016ZM10.053 10.6668H6.94634C6.68634 10.6668 6.47967 10.4602 6.47967 10.2002C6.47967 9.94683 6.68634 9.7335 6.94634 9.7335H10.0463C10.2997 9.7335 10.513 9.94683 10.513 10.2002C10.513 10.4602 10.3063 10.6668 10.053 10.6668Z"
                                                fill="#98A2B3"></path>
                                        </svg>
                                        <span id="cac2-doc" class="folder-title">CAC 2 (Registered Shareholders) or CAC Status Report</span>
                                        <span class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="CAC 2 (Registered Shareholders) or CAC Status Report"><i class="fas fa-info-circle"></i></span>

                                    </div>
                                    <div>
                                        <input type="file" id="cac2" class="hidden-input"
                                            onchange="updateFileName('cac2-doc', this)">

                                        {{-- <input type="file" id="file1" class="d-none"
                                            onchange="handleFileUpload(event, 1)"> --}}
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                            viewBox="0 0 16 14" fill="none">
                                            <path
                                                d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                stroke="#0765FF" stroke-width="1.45455" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>

                                    </div>
                                </div>

                                <div class="document-item" onclick="document.getElementById('tin-evidence').click()">
                                    <div class="folder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                            viewBox="0 0 17 16" fill="none">
                                            <path opacity="0.4"
                                                d="M10.9804 1.3335H6.02038C5.76704 1.3335 5.55371 1.54683 5.55371 1.80016C5.55371 2.0535 5.76704 2.26683 6.02038 2.26683H8.19371L9.12704 3.50683C9.33371 3.78016 9.36038 3.82016 9.74704 3.82016H12.227C12.4804 3.82016 12.727 3.8535 12.967 3.92016C12.9937 4.04016 13.007 4.16016 13.007 4.28683V4.52016C13.007 4.7735 13.2204 4.98683 13.4737 4.98683C13.727 4.98683 13.9404 4.7735 13.9404 4.52016V4.28016C13.927 2.6535 12.607 1.3335 10.9804 1.3335Z"
                                                fill="#98A2B3"></path>
                                            <path
                                                d="M13.9263 4.36016C13.6397 4.1535 13.313 4.00016 12.9597 3.9135C12.7263 3.84683 12.473 3.8135 12.2197 3.8135H9.73967C9.35301 3.8135 9.32634 3.7735 9.11967 3.50016L8.18634 2.26016C7.75301 1.68683 7.41301 1.3335 6.32634 1.3335H4.77967C3.15301 1.3335 1.83301 2.6535 1.83301 4.28016V11.7202C1.83301 13.3468 3.15301 14.6668 4.77967 14.6668H12.2197C13.8463 14.6668 15.1663 13.3468 15.1663 11.7202V6.76016C15.1663 5.76683 14.6797 4.8935 13.9263 4.36016ZM10.053 10.6668H6.94634C6.68634 10.6668 6.47967 10.4602 6.47967 10.2002C6.47967 9.94683 6.68634 9.7335 6.94634 9.7335H10.0463C10.2997 9.7335 10.513 9.94683 10.513 10.2002C10.513 10.4602 10.3063 10.6668 10.053 10.6668Z"
                                                fill="#98A2B3"></path>
                                        </svg>
                                        <span id="tin-doc" class="folder-title">Evidence of Tax Identification
                                            Number</span>
                                        <span class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Evidence of Tax Identification Number"><i class="fas fa-info-circle"></i></span>

                                    </div>
                                    <div>
                                        <input type="file" id="tin-evidence" class="hidden-input"
                                            onchange="updateFileName('tin-doc', this)">

                                        {{-- <input type="file" id="file1" class="d-none"
                                            onchange="handleFileUpload(event, 1)"> --}}
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                            viewBox="0 0 16 14" fill="none">
                                            <path
                                                d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                stroke="#0765FF" stroke-width="1.45455" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>

                                    </div>
                                </div>

                                <div class="document-item uploaded">
                                    <div class="folder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                            viewBox="0 0 17 16" fill="none">
                                            <path
                                                d="M8.5 0C4.092 0 0.5 3.592 0.5 8C0.5 12.408 4.092 16 8.5 16C12.908 16 16.5 12.408 16.5 8C16.5 3.592 12.908 0 8.5 0ZM12.324 6.16L7.788 10.696C7.676 10.808 7.524 10.872 7.364 10.872C7.204 10.872 7.052 10.808 6.94 10.696L4.676 8.432C4.444 8.2 4.444 7.816 4.676 7.584C4.908 7.352 5.292 7.352 5.524 7.584L7.364 9.424L11.476 5.312C11.708 5.08 12.092 5.08 12.324 5.312C12.556 5.544 12.556 5.92 12.324 6.16Z"
                                                fill="#0644CC"></path>
                                        </svg>
                                        <span id="tin-doc" class="folder-title">Proof of Address</span>
                                        <span class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Proof of Address"><i class="fas fa-info-circle"></i></span>

                                    </div>
                                    <div>
                                        <input type="file" id="tin-evidence" class="hidden-input">

                                        {{-- <input type="file" id="file1" class="d-none"
                                            onchange="handleFileUpload(event, 1)"> --}}
                                    </div>
                                    <div>
                                        <span class="eye-icon">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.9998 4.58301C14.7824 4.58301 16.9376 7.28514 17.8851 8.89571C18.178 9.39017 18.3332 9.96001 18.3332 10.5413C18.3332 11.1227 18.178 11.6925 17.8851 12.187C16.9376 13.7975 14.7824 16.4997 10.9998 16.4997C7.21724 16.4997 5.06204 13.7975 4.11455 12.187C3.82165 11.6925 3.6665 11.1227 3.6665 10.5413C3.6665 9.96001 3.82165 9.39017 4.11455 8.89571C5.06204 7.28514 7.21724 4.58301 10.9998 4.58301ZM10.9998 15.2245C14.188 15.2245 16.0299 12.9004 16.8436 11.5194C17.0176 11.2255 17.1098 10.8868 17.1098 10.5413C17.1098 10.1958 17.0176 9.85717 16.8436 9.56327C16.0299 8.17969 14.188 5.8582 10.9998 5.8582C7.81163 5.8582 5.96981 8.18224 5.15611 9.56327C4.98209 9.85717 4.88992 10.1958 4.88992 10.5413C4.88992 10.8868 4.98209 11.2255 5.15611 11.5194C5.96981 12.9004 7.81163 15.2245 10.9998 15.2245ZM9.3029 7.89073C9.80519 7.54043 10.3957 7.35346 10.9998 7.35346C11.8096 7.35447 12.586 7.69067 13.1586 8.28832C13.7312 8.88596 14.0533 9.69625 14.0543 10.5414C14.0543 11.172 13.8751 11.7883 13.5395 12.3126C13.2039 12.8368 12.7268 13.2455 12.1687 13.4867C11.6106 13.728 10.9965 13.7912 10.404 13.6682C9.81146 13.5452 9.26721 13.2415 8.84004 12.7957C8.41287 12.3498 8.12197 11.7818 8.00411 11.1634C7.88625 10.545 7.94674 9.90398 8.17792 9.32145C8.40911 8.73893 8.8006 8.24103 9.3029 7.89073ZM9.98168 12.1319C10.2831 12.342 10.6374 12.4542 10.9998 12.4542C11.4859 12.4542 11.952 12.2527 12.2957 11.894C12.6394 11.5353 12.8325 11.0487 12.8325 10.5414C12.8325 10.1631 12.725 9.79331 12.5236 9.47875C12.3223 9.1642 12.036 8.91903 11.7012 8.77425C11.3663 8.62948 10.9978 8.5916 10.6423 8.66541C10.2868 8.73921 9.96026 8.92139 9.70396 9.18889C9.44766 9.4564 9.27312 9.79723 9.2024 10.1683C9.13169 10.5393 9.16798 10.9239 9.30669 11.2734C9.4454 11.6229 9.6803 11.9217 9.98168 12.1319Z"
                                                    fill="#200E32"></path>
                                            </svg>
                                        </span>

                                        <span>
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.5 5.0013H4.16667M4.16667 5.0013H17.5M4.16667 5.0013V16.668C4.16667 17.11 4.34226 17.5339 4.65482 17.8465C4.96738 18.159 5.39131 18.3346 5.83333 18.3346H14.1667C14.6087 18.3346 15.0326 18.159 15.3452 17.8465C15.6577 17.5339 15.8333 17.11 15.8333 16.668V5.0013H4.16667ZM6.66667 5.0013V3.33464C6.66667 2.89261 6.84226 2.46868 7.15482 2.15612C7.46738 1.84356 7.89131 1.66797 8.33333 1.66797H11.6667C12.1087 1.66797 12.5326 1.84356 12.8452 2.15612C13.1577 2.46868 13.3333 2.89261 13.3333 3.33464V5.0013M8.33333 9.16797V14.168M11.6667 9.16797V14.168"
                                                    stroke="#F97066" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>

                                        </span>

                                    </div>
                                </div>


                                <div class="document-item"
                                    onclick="document.getElementById('business-license').click()">
                                    <div class="folder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                            viewBox="0 0 17 16" fill="none">
                                            <path opacity="0.4"
                                                d="M10.9804 1.3335H6.02038C5.76704 1.3335 5.55371 1.54683 5.55371 1.80016C5.55371 2.0535 5.76704 2.26683 6.02038 2.26683H8.19371L9.12704 3.50683C9.33371 3.78016 9.36038 3.82016 9.74704 3.82016H12.227C12.4804 3.82016 12.727 3.8535 12.967 3.92016C12.9937 4.04016 13.007 4.16016 13.007 4.28683V4.52016C13.007 4.7735 13.2204 4.98683 13.4737 4.98683C13.727 4.98683 13.9404 4.7735 13.9404 4.52016V4.28016C13.927 2.6535 12.607 1.3335 10.9804 1.3335Z"
                                                fill="#f4a261"></path>
                                            <path
                                                d="M13.9263 4.36016C13.6397 4.1535 13.313 4.00016 12.9597 3.9135C12.7263 3.84683 12.473 3.8135 12.2197 3.8135H9.73967C9.35301 3.8135 9.32634 3.7735 9.11967 3.50016L8.18634 2.26016C7.75301 1.68683 7.41301 1.3335 6.32634 1.3335H4.77967C3.15301 1.3335 1.83301 2.6535 1.83301 4.28016V11.7202C1.83301 13.3468 3.15301 14.6668 4.77967 14.6668H12.2197C13.8463 14.6668 15.1663 13.3468 15.1663 11.7202V6.76016C15.1663 5.76683 14.6797 4.8935 13.9263 4.36016ZM10.053 10.6668H6.94634C6.68634 10.6668 6.47967 10.4602 6.47967 10.2002C6.47967 9.94683 6.68634 9.7335 6.94634 9.7335H10.0463C10.2997 9.7335 10.513 9.94683 10.513 10.2002C10.513 10.4602 10.3063 10.6668 10.053 10.6668Z"
                                                fill="#f4a261"></path>
                                        </svg>
                                        <span id="license-doc" class="folder-title">Business License <span
                                                class="optional">(Optional)</span></span>
                                        <span class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" title="Business License"><i class="fas fa-info-circle"></i></span>

                                    </div>
                                    <div>
                                        <input type="file" id="business-license" class="hidden-input"
                                            onchange="updateFileName('license-doc', this)">

                                        {{-- <input type="file" id="file1" class="d-none"
                                            onchange="handleFileUpload(event, 1)"> --}}
                                    </div>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14"
                                            viewBox="0 0 16 14" fill="none">
                                            <path
                                                d="M10.6666 9.66698L7.99997 7.00031M7.99997 7.00031L5.33331 9.66698M7.99997 7.00031V13.0003M13.5933 11.2603C14.2435 10.9058 14.7572 10.3449 15.0532 9.66606C15.3492 8.98723 15.4108 8.22914 15.2281 7.51144C15.0454 6.79375 14.629 6.15732 14.0444 5.70261C13.4599 5.2479 12.7405 5.0008 12 5.00031H11.16C10.9582 4.21981 10.5821 3.4952 10.0599 2.88098C9.5378 2.26675 8.8832 1.77888 8.14537 1.45405C7.40754 1.12922 6.60567 0.975887 5.80005 1.00557C4.99443 1.03525 4.20602 1.24718 3.49409 1.62543C2.78216 2.00367 2.16525 2.53838 1.68972 3.18937C1.2142 3.84036 0.892433 4.59067 0.748627 5.38391C0.60482 6.17715 0.64271 6.99267 0.859449 7.76915C1.07619 8.54564 1.46613 9.26289 1.99997 9.86698"
                                                stroke="#0765FF" stroke-width="1.45455" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </svg>

                                    </div>
                                </div>

                                <div class="document-item uploaded">
                                    <div class="folder-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                            viewBox="0 0 17 16" fill="none">
                                            <path
                                                d="M8.5 0C4.092 0 0.5 3.592 0.5 8C0.5 12.408 4.092 16 8.5 16C12.908 16 16.5 12.408 16.5 8C16.5 3.592 12.908 0 8.5 0ZM12.324 6.16L7.788 10.696C7.676 10.808 7.524 10.872 7.364 10.872C7.204 10.872 7.052 10.808 6.94 10.696L4.676 8.432C4.444 8.2 4.444 7.816 4.676 7.584C4.908 7.352 5.292 7.352 5.524 7.584L7.364 9.424L11.476 5.312C11.708 5.08 12.092 5.08 12.324 5.312C12.556 5.544 12.556 5.92 12.324 6.16Z"
                                                fill="#0644CC"></path>
                                        </svg>
                                        <span id="tin-doc" class="folder-title">Other Documents</span>
                                        <span class="tool-tip" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Other Documents"><i class="fas fa-info-circle"></i></span>

                                    </div>
                                    <div>
                                        <input type="file" id="tin-evidence" class="hidden-input">

                                    </div>
                                    <div>
                                        <span class="eye-icon">
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.9998 4.58301C14.7824 4.58301 16.9376 7.28514 17.8851 8.89571C18.178 9.39017 18.3332 9.96001 18.3332 10.5413C18.3332 11.1227 18.178 11.6925 17.8851 12.187C16.9376 13.7975 14.7824 16.4997 10.9998 16.4997C7.21724 16.4997 5.06204 13.7975 4.11455 12.187C3.82165 11.6925 3.6665 11.1227 3.6665 10.5413C3.6665 9.96001 3.82165 9.39017 4.11455 8.89571C5.06204 7.28514 7.21724 4.58301 10.9998 4.58301ZM10.9998 15.2245C14.188 15.2245 16.0299 12.9004 16.8436 11.5194C17.0176 11.2255 17.1098 10.8868 17.1098 10.5413C17.1098 10.1958 17.0176 9.85717 16.8436 9.56327C16.0299 8.17969 14.188 5.8582 10.9998 5.8582C7.81163 5.8582 5.96981 8.18224 5.15611 9.56327C4.98209 9.85717 4.88992 10.1958 4.88992 10.5413C4.88992 10.8868 4.98209 11.2255 5.15611 11.5194C5.96981 12.9004 7.81163 15.2245 10.9998 15.2245ZM9.3029 7.89073C9.80519 7.54043 10.3957 7.35346 10.9998 7.35346C11.8096 7.35447 12.586 7.69067 13.1586 8.28832C13.7312 8.88596 14.0533 9.69625 14.0543 10.5414C14.0543 11.172 13.8751 11.7883 13.5395 12.3126C13.2039 12.8368 12.7268 13.2455 12.1687 13.4867C11.6106 13.728 10.9965 13.7912 10.404 13.6682C9.81146 13.5452 9.26721 13.2415 8.84004 12.7957C8.41287 12.3498 8.12197 11.7818 8.00411 11.1634C7.88625 10.545 7.94674 9.90398 8.17792 9.32145C8.40911 8.73893 8.8006 8.24103 9.3029 7.89073ZM9.98168 12.1319C10.2831 12.342 10.6374 12.4542 10.9998 12.4542C11.4859 12.4542 11.952 12.2527 12.2957 11.894C12.6394 11.5353 12.8325 11.0487 12.8325 10.5414C12.8325 10.1631 12.725 9.79331 12.5236 9.47875C12.3223 9.1642 12.036 8.91903 11.7012 8.77425C11.3663 8.62948 10.9978 8.5916 10.6423 8.66541C10.2868 8.73921 9.96026 8.92139 9.70396 9.18889C9.44766 9.4564 9.27312 9.79723 9.2024 10.1683C9.13169 10.5393 9.16798 10.9239 9.30669 11.2734C9.4454 11.6229 9.6803 11.9217 9.98168 12.1319Z"
                                                    fill="#200E32"></path>
                                            </svg>
                                        </span>

                                        <span>
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M2.5 5.0013H4.16667M4.16667 5.0013H17.5M4.16667 5.0013V16.668C4.16667 17.11 4.34226 17.5339 4.65482 17.8465C4.96738 18.159 5.39131 18.3346 5.83333 18.3346H14.1667C14.6087 18.3346 15.0326 18.159 15.3452 17.8465C15.6577 17.5339 15.8333 17.11 15.8333 16.668V5.0013H4.16667ZM6.66667 5.0013V3.33464C6.66667 2.89261 6.84226 2.46868 7.15482 2.15612C7.46738 1.84356 7.89131 1.66797 8.33333 1.66797H11.6667C12.1087 1.66797 12.5326 1.84356 12.8452 2.15612C13.1577 2.46868 13.3333 2.89261 13.3333 3.33464V5.0013M8.33333 9.16797V14.168M11.6667 9.16797V14.168"
                                                    stroke="#F97066" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>

                                        </span>

                                    </div>
                                </div>


                            </div>
                        </div>


                        <a href="{{ route('business.kyc.apply') }}?current=6">
                            <button type="button" class="btn btn-primary btn-block">Save & Continue</button>
                        </a>

                        <div class="center-button">
                            <a href="{{ route('business.kyc.apply') }}?current=6" class="skip">Skip to Support
                                Information
                                Upload <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </form>

                </div>

            </div>

        </div>
        <div class="page-ath-gfx">
            <div class="w-100 d-flex ">
                <div class="col-12">
                    <div class="mt-5">
                        <img class="page-ath-logo-img" src="images/logos.png" alt="TransLite Logo">
                    </div>


                    <div class="kycinstruction">
                        <h5><span class="kycheading">Set up your business account</span></h5>
                        <p class="kycheadingsmall">Activate your business payments in quick and simple steps</p>
                    </div>

                    <div class="">
                        <a href="{{ route('business.dashboard') }}" class="dolater">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="none">
                                <path
                                    d="M7.4165 6.29922C7.67484 3.29922 9.2165 2.07422 12.5915 2.07422H12.6998C16.4248 2.07422 17.9165 3.56589 17.9165 7.29089V12.7242C17.9165 16.4492 16.4248 17.9409 12.6998 17.9409H12.5915C9.2415 17.9409 7.69984 16.7326 7.42484 13.7826"
                                    stroke="#667085" stroke-width="1.25" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M12.4999 10H3.0166" stroke="#667085" stroke-width="1.25"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M4.87516 7.20898L2.0835 10.0007L4.87516 12.7923" stroke="#667085"
                                    stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span style="margin-left: 10px">I'll do this later.</span>
                        </a>
                    </div>



                    <div class="copyright">
                        <span style="margin-right: 10px">&copy; {{ date('Y') }} TransLite</span> |
                        <span style="margin-left: 10px"><a href="#" target="_blank">Terms &
                                Conditions</a></span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.bundle.js') }}?ver=20241116180"></script>
    <script src="{{ asset('assets/js/script.js') }}?ver=20241116180"></script>
    <script src="{{ asset('assets/js/kyc.js') }}?ver=20241116180"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        jQuery(function() {
            var $frv = jQuery('.validate');
            if ($frv.length > 0) {
                $frv.validate({
                    errorClass: "input-bordered-error error"
                });
            }
        });



        function updateFileName(elementId, input) {
            const fileName = input.files.length > 0 ? input.files[0].name : "";
            document.getElementById(elementId).textContent = fileName;
        }


        document.addEventListener("DOMContentLoaded", function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

</body>

</html>
