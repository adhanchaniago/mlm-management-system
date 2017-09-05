<head>
    <meta charset="UTF-8">
    <title>@yield('htmlheader_title', 'Your title here') - Admin</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" href="{{ asset('favico.ico') }}" type="image/ico" sizes="16x16">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('plugins/iCheck/skins/flat/blue.css') }}" rel="stylesheet" type="text/css" />

    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqueryui/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    @stack('css')

    <style>
        /**/
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            vertical-align: middle;
        }
        .invoice {
            margin: 0px 0px;
        }
        hr {
            margin-top: 5px; 
            margin-bottom: 5px; 
            border: 0;
            border-top: 1px solid #eeeeee;
        }
        .loadersmall {
          border: 5px solid #f3f3f3;
          -webkit-animation: spin 1s linear infinite;
          animation: spin 1s linear infinite;
          border-top: 5px solid #555;
          border-radius: 50%;
          width: 50px;
          height: 50px;
        }


        @-webkit-keyframes spin {
          0% { 
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
          }

          100% {
            -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }

        @keyframes spin {
          0% { 
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
          }

          100% {
            -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            transform: rotate(360deg);
          }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
</head>
