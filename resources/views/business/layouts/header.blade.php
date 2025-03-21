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

        @media (max-width: 575px) {
            .custombox {
                padding: 10px 10px 10px 10px;
                margin: 0px 7px 20px 0px;
            }
        }
    </style>
</head>
