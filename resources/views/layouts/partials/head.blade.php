
<meta charset="utf-8" />
<title>Printing Factory | {{ $page_title ?? '-' }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesdesign" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

<!-- plugin css -->
<link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />

<!-- swiper css -->
<link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css')}}">

<!-- Bootstrap Css -->
<link href="{{ asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
@yield('style')
@stack('styles')

<style>
    .br-20 {
        border-radius: 20px !important;
    }

    .br-top-20 {
        border-radius: 20px 20px 0 0 !important;
    }
    .br-bot-20 {
        border-radius: 0 0 20px 20px !important;
    }
    .dataTables_length {
        margin-left: 20px !important;
    }
    .dataTables_filter {
        margin-right: 20px !important;
    }
    .dataTables_length select {
        border-radius: 5px !important;
        padding: 5px 10px;
        color: #ffffff;
        background: #001F3F;
    }
    .dataTables_info {
        margin-top: 10px !important;
        margin-left: 20px !important;
    }
    .dataTables_paginate {
        margin-top: 10px !important;
        margin-right: 20px !important;
    }
    thead tr th {
        padding: 15px !important;
        background-color: #001F3F !important;
        color: white !important;
        text-transform: uppercase !important;
    }
    .highlight-today {
        background-color: #d4edda !important; /* Warna hijau muda */
    }
</style>
