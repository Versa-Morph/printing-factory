@extends('layouts.app')

@section('style')

@endsection

@section('header-info-content')
    <div class="collapse show verti-dash-content" id="dashtoggle">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 sub-title">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0 ">
                                <li class="breadcrumb-item page-head"><a href="javascript: void(0);">layouts</a></li>
                                <li class="breadcrumb-item page-head active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card dash-header-box shadow-none border-0">
                        <div class="card-body p-0">
                            <div class="row row-cols-xxl-6 row-cols-md-3 row-cols-1 g-0">
                                <div class="col">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Leads</p>
                                        <h3 class="text-white mb-0">197</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Quotation</p>
                                        <h3 class="text-white mb-0">200</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Customer</p>
                                        <h3 class="text-white mb-0">20</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-md-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Order</p>
                                        <h3 class="text-white mb-0">30</h3>
                                    </div>
                                </div><!-- end col -->

                                <div class="col">
                                    <div class="mt-3 mt-lg-0 py-3 px-4 mx-2">
                                        <p class="text-white-50 mb-2 text-truncate">Income</p>
                                        <h3 class="text-white mb-0">Rp. 50.000.000</h3>
                                    </div>
                                </div><!-- end col -->

                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <form action="#!" method="GET" class="w-100 d-flex row">
                    <div class="form-group col-12 col-md-4">
                        <label for="type">Select Type:</label>
                        <select name="type" id="type" class="form-control">
                            <option value="day">Day</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                    </div>

                    <div id="dateFields" class="col-12 col-md-7">
                        <div class="d-flex gap-3 w-100">
                            <div class="form-group w-100">
                                <label for="dateFrom">Date From:</label>
                                <input type="date" name="dateFrom" id="dateFrom" class="form-control"
                                       value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-group w-100">
                                <label for="dateTo">Date To:</label>
                                <input type="date" name="dateTo" id="dateTo" class="form-control"
                                       value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <div id="monthField" style="display: none;" class="col-12 col-md-7">
                        <div class="form-group">
                            <label for="month">Select Month:</label>
                            <input type="month" name="month" id="month" class="form-control" value="{{ date('Y-m') }}">
                        </div>
                    </div>

                    <div id="yearField" style="display: none;" class="col-12 col-md-7">
                        <div class="form-group">
                            <label for="year">Select Year:</label>
                            <input type="year" name="year" id="year" class="form-control" value="{{ 2024 }}">
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-1">
                        <label>&nbsp;</label> <!-- Empty label to align the button -->
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 col-md-8">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">Order Activity</h4>
                     </div><!-- end card header -->
                    <div class="card-body">
                        <div id="bar_chart" data-colors='["--bs-primary", "--bs-info", "--bs-success"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!--end card-->
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body pb-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-2">Report Orders</h5>
                            </div>
                            {{-- <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Monthly<i class="mdi mdi-chevron-down ms-1"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="">
                            <div class="table-responsive">
                                <table class="table project-list-table table-nowrap align-middle table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 210px">Customer</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden me-4">
                                                        <h5 class="font-size-15 mb-1 text-truncate">PT. Agung Sedayu</h5>
                                                        <p class="text-truncate text-muted mb-2">Jl. Sedayu 3...</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                              <span>#526552</span>
                                            </td>
                                            <td>
                                                Augst 12, 2024
                                            </td>
                                            <td>
                                                Rp.10.000.000
                                            </td>
                                            <td>
                                                <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>Available</p>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Print</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden me-4">
                                                        <h5 class="font-size-15 mb-1 text-truncate">PT. Agung Sedayu</h5>
                                                        <p class="text-truncate text-muted mb-2">Jl. Sedayu 3...</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                              <span>#526552</span>
                                            </td>
                                            <td>
                                                Augst 12, 2024
                                            </td>
                                            <td>
                                                Rp.10.000.000
                                            </td>
                                            <td>
                                                <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>Available</p>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Print</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden me-4">
                                                        <h5 class="font-size-15 mb-1 text-truncate">PT. Agung Sedayu</h5>
                                                        <p class="text-truncate text-muted mb-2">Jl. Sedayu 3...</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                              <span>#526552</span>
                                            </td>
                                            <td>
                                                Augst 12, 2024
                                            </td>
                                            <td>
                                                Rp.10.000.000
                                            </td>
                                            <td>
                                                <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>Available</p>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Print</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden me-4">
                                                        <h5 class="font-size-15 mb-1 text-truncate">PT. Agung Sedayu</h5>
                                                        <p class="text-truncate text-muted mb-2">Jl. Sedayu 3...</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                              <span>#526552</span>
                                            </td>
                                            <td>
                                                Augst 12, 2024
                                            </td>
                                            <td>
                                                Rp.10.000.000
                                            </td>
                                            <td>
                                                <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>Available</p>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Print</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden me-4">
                                                        <h5 class="font-size-15 mb-1 text-truncate">PT. Agung Sedayu</h5>
                                                        <p class="text-truncate text-muted mb-2">Jl. Sedayu 3...</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                              <span>#526552</span>
                                            </td>
                                            <td>
                                                Augst 12, 2024
                                            </td>
                                            <td>
                                                Rp.10.000.000
                                            </td>
                                            <td>
                                                <p class="mb-0"><i class="mdi mdi-square-rounded font-size-10 text-success me-2"></i>Available</p>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="text-muted dropdown-toggle font-size-18" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">Print</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
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
    </div>
    <div class="col-12 col-md-4">
        <div class="row">
            <div class="col-12">
                <div class="card border">
                    <div class="card-body">
                        <div class="">
                            <div class="d-flex align-items-center">
                                <div class="avatar align-self-center me-3">
                                    <div class="avatar-title rounded bg-primary-subtle text-primary font-size-24">
                                        <i class="mdi mdi-google-drive"></i>
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <h5 class="font-size-18 mb-1">Target of Sales</h5>
                                </div>
                                {{-- <div class="flex-shrink-0 ms-auto">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Monthly<i class="mdi mdi-chevron-down ms-1"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Weekly</a>
                                            <a class="dropdown-item" href="#">Today</a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="mt-3 pt-1">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-start">
                                        <p class="text-muted font-size-13 mb-1">August</p>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <p class="text-muted font-size-13 mb-1">20</p>/
                                        <p class="text-muted font-size-13 mb-1">50</p>
                                    </div>
                                </div>
                                <div class="progress animated-progess custom-progress">
                                    <div class="progress-bar bg-gradient bg-primary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="90">
                                    </div>
                                </div>
                                {{-- <div class="flex-1 mt-3">
                                    <h5 class="font-size-15 mb-1">Target of Sales</h5>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">Sales Percentage</h4>
                        </div><!-- end card header -->
                    <div class="card-body">
                        <div id="updating_donut_chart" data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-danger", "--bs-info"]' class="apex-charts" dir="ltr"></div>

                        <div class="d-flex align-items-start flex-wrap gap-2 justify-content-center mt-4">
                            <button id="add" class="btn btn-light btn-sm">
                                Plate
                            </button>

                            <button id="remove" class="btn btn-light btn-sm">
                                Consumable
                            </button>

                            <button id="randomize" class="btn btn-light btn-sm">
                                Product
                            </button>
                        </div>
                    </div>
                </div><!--end card-->
            </div><!-- end col -->
        </div>
    </div>
    <!-- end col -->
@endsection

@section('script')
<script src="{{ asset('assets/js/pages/apexcharts-pie.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/apexcharts-mixed.init.js') }}"></script>
@endsection
