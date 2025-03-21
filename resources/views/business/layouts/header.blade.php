<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <link rel="shortcut icon" href="{{ asset('img/Version3/favicon.svg') }}" type="image/x-icon">
    <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/slick-carousel/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main5739.css') }}?version=4.5.1" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <title>@yield('title')</title>

    <style type="text/css">
        .eb {
            padding: 30px 20px 0px 20px !important;
        }

        .uld {
            list-style: none !important;
            padding-bottom: 30px;
            padding-right: 10px
        }

        .onbh {
            color: rgb(7, 101, 255);
            /* font-weight: bold; */

        }

        .onbs {
            font-size: 12px;
        }

        .step-element {
            margin-top: 10px;
        }

        .progress-container {
            position: relative;
            padding-left: 25px;
            padding-right: 20px
        }

        .progress-step {
            display: flex;
            align-items: center;
            gap: 25px;
            position: relative;
            padding-bottom: 30px;
        }

        .progress-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            font-weight: bold;
            position: relative;
            z-index: 2;
        }

        .completed {
            background-color: #007bff;
        }

        .current {
            background-color: #ffcc00;
        }

        .pending {
            background-color: #ddd;
        }

        .progress-line {
            position: absolute;
            left: 14px;
            width: 2px;
            background-color: #ddd;
            top: 30px;
            bottom: -30px;
            z-index: 1;
        }

        /* Remove line after last item */
        .progress-step:last-child .progress-line {
            display: none;
        }

        .atext {
            text-decoration: none;
            color: rgb(79, 79, 79) !important;
            cursor: pointer;
            font-size: 12px;
        }

        .atext:hover {
            text-decoration: none;
        }

        .custom-alert {
            position: relative;
            padding: .3rem 1.25rem;
            margin-bottom: 30px;
            border: 1px solid transparent;
            border-radius: 6px;
        }

        .custom-alert-primary {
            color: #02366d;
            background: rgb(206, 221, 254);
            border-color: #54a5fa;
        }

        .tabactive {
            color: #0964ff;
            cursor: pointer;
            position: relative;
            width: max-content;
            background: rgba(9, 100, 255, 0.1);
            border-radius: 5px !important;
            text-decoration: none;
            padding: 5px 10px;
            font-size: 12px;
        }

        .tabactive:hover {
            text-decoration: none;
            /* Prevents underline on hover */
        }

        .tabinactive {
            color: rgb(79, 79, 79) !important;
            cursor: pointer;
            text-decoration: none;
            padding: 5px 10px;
            font-size: 12px;
        }

        .tabinactive:hover {
            text-decoration: none;
            background-color: #E2E8F0;
            border-radius: 5px !important;
            /* Prevents underline on hover */
        }


        .dashbox {
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(126, 142, 177, 0.12);
            padding: 10px 10px 10px 10px;
            margin: 0px 0px 10px 10px;
        }

        .custombox {
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            background-color: #fff;
            box-shadow: 0px 2px 4px rgba(126, 142, 177, 0.12);
            padding: 10px 10px 10px 10px;
            margin: 0px 0px 30px 10px;
        }

        .nopadding {
            padding: 0px !important;
            margin: 0px !important;
        }

        .dropdown-item {
            padding: 5px 10px 5px 10px;
            font-size: 12px;
            /* Adjust the top and bottom margin */
        }

        .dropdown-divider {
            margin: 0px 0;
            /* Adjust the top and bottom margin */
        }

        .tabtext {
            font-size: 11px;
        }

        .btn-default {
            background-color: #E2E8F0;
        }

        input[type="file"]::-webkit-file-upload-button {
            font-size: 10px;
            margin: 5px;
            height: 20px;
            width: 80px;
        }

        input[type="file"]::file-selector-button {
            font-size: 11px;
            padding: 0px;
            height: 23px;
            width: 80px;
        }



        #filterOffcanvas {
            position: fixed;
            top: 0;
            right: -300px;
            /* Start hidden */
            width: 300px;
            height: 100vh;
            background: white;
            box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.1);
            transition: right 0.3s ease-in-out;
            /* Smooth transition */
            z-index: 1050;
        }

        #filterOffcanvas.show {
            right: 0;
            /* Slide into view */
        }

        /* Optional backdrop */
        .offcanvas-backdrop::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Dark overlay */
            z-index: 1040;
            transition: opacity 0.3s ease-in-out;
        }



        /* Offcanvas container */
        .offcanvas {
            position: fixed;
            bottom: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            visibility: hidden;
            background-color: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        /* Right side offcanvas */
        .offcanvas-end {
            top: 0;
            right: 0;
            width: 300px;
            /* Adjust width as needed */
            height: 100%;
            transform: translateX(100%);
        }

        /* Show offcanvas */
        .offcanvas.show {
            transform: translateX(0);
            visibility: visible;
        }

        /* Offcanvas header */
        .offcanvas-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        /* Close button */
        .offcanvas .btn-close {
            background: transparent;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }




        /* Ensure the offcanvas is 600px wide */
        .offcanvas.offcanvas-end {
            width: 550px !important;
            /* padding: 20px; */
        }

        /* Customize the header */
        .offcanvas-header {
            border-bottom: 1px solid #ddd;
            padding: 20px 10px 5px 25px;
        }

        /* Offcanvas body styling */
        .offcanvas-body {
            padding: 25px;
            font-size: 13px;
            color: #333;
        }

        /* Form styling */
        .offcanvas-body .form-label {
            font-weight: 500;
        }

        /* Form inputs */
        .offcanvas-body .form-control {
            padding: 7px;
            font-size: 14px;
            height: 40px !important;
        }

        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
            /* margin-top: 20px; */
            padding: 12px;
            font-size: 16px;
            /* border-radius: 8px; */
            transition: background 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }


        .sb {
            padding: 20px;
        }

        .sh {
            font-size: 15px;
            font-weight: bold;
        }

        .sd {
            font-size: 12px;
        }

        .slc {
            width: 40px;
            height: 40px;
            background: rgb(236, 242, 255);
            padding: 10px;
            border-radius: 50%;
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            align-items: center;
        }


        .noprod {
            padding: 180px;
        }

        .noprodimg {
            height: 100px;
        }

        /* .sl {
            height: 30px;
        } */


        .metrics-container {
            background-color: rgb(249, 250, 251);
            border-top: 1.3px solid rgb(234, 236, 240);
            margin: 0px;
        }

        .metrics-container div {
            border-right: 1.3px solid rgb(234, 236, 240);
            padding: 20px 20px 20px 30px;
        }

        .metrics-container div span {
            font-weight: bold;
            font-size: 20px
        }

        .revenuebox {
            padding: 10px 10px 30px 30px;
        }

        .revenue {
            font-size: 50px;
            font-weight: bolder;
        }

        .settlementval {
            font-size: 20px;
            font-weight: bolder;
        }

        .pmbox {
            background: white;
            border-radius: 8px;
            border: 1px solid #E2E8F0;
            padding: 20px;
            width: 100%;
        }

        .pmbox span{
            font-weight: bold;
            font-size: 17px
        }

        .poor{
            color:red;
        }

        .good{
            color:green;
        }

        @media (max-width: 575px) {
            .custombox {
                padding: 10px 10px 10px 10px;
                margin: 0px 7px 20px 0px;
            }


            .offcanvas.offcanvas-end {
                width: 400px !important;
                /* padding: 20px; */
            }


        }
    </style>
</head>
