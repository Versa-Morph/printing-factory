@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .text-heading{
            font-weight: 700;
            margin-bottom: 2%!important;
        }
        .btn.dropdown-toggle {
            border-radius: 16px!important;
            border-color: transparent !important;
        }
        .badge-ontime{
            color: rgba(160, 219, 93, 1) !important;
            background: rgba(160, 219, 93, 0.1) !important;
            padding: 16px;
            width: 91%;
            font-weight: 700;
        }
        .badge-late{
            color: rgba(219, 93, 93, 1);
            background: rgba(219, 93, 93, 0.1);
            padding: 16px;
            width: 91%;
            font-weight: 700;
        }
        .badge-no-data{
            color: black;
            background: rgba(0, 0, 0, 0.1);
            padding: 16px;
            width: 91%;
            font-weight: 700;
        }
    </style>
@endsection

@section('header-info-content')
    <div class="collapse show verti-dash-content" id="dashtoggle">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 sub-title">February 2024</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0 ">
                                <li class="breadcrumb-item page-head"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item page-head active">Attendance</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start dash info -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card dash-header-box shadow-none border-0">
                        <div class="card-body p-0">
                            <div class="row row-cols-1 g-0">
                                <div class="col-lg-3">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="text-white-50 mb-2 text-truncate">Attendance</p>
                                                <h3 class="text-white mb-0">197</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="chart-attendance" style="width: 100%; height: 100px;"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="text-white-50 mb-2 text-truncate">Tardiness</p>
                                                <h3 class="text-white mb-0">197</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="chart-tardiness" style="width: 100%; height: 100px;"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="text-white-50 mb-2 text-truncate">Overtime</p>
                                                <h3 class="text-white mb-0">197</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="chart-overtime" style="width: 100%; height: 100px;"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mt-md-0 py-3 px-4 mx-2">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p class="text-white-50 mb-2 text-truncate">Permission</p>
                                                <h3 class="text-white mb-0">197</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="chart-permission" style="width: 100%; height: 100px;"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div><!-- end row -->
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end dash info -->
        </div>
    </div>

    <!-- start dash troggle-icon -->
    <div>
        <a class="dash-troggle-icon" id="dash-troggle-icon" data-bs-toggle="collapse" href="#dashtoggle"
            aria-expanded="true" aria-controls="dashtoggle">
            <i class="bx bx-up-arrow-alt"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row align-items-start">
                <div class="col-sm">
                </div>
            </div>

            <div class="table-responsive mt-4 mt-sm-0">
                <h5 class="text-white mb-2 text-heading">Week 9 ( 26 February 2024 - 1 March 2024) </h5>
                <table class="table align-middle table-nowrap table-check" id="customer-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>Date</th>
                            <th>Clock In</th>
                            <th>Break</th>
                            <th>After Break</th>
                            <th>Clock Out</th>
                            <th>Overtime In</th>
                            <th>Overtime Out</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span>26 February 2024</span>
                            </td>
                            <td>
                                <span class="badge badge-ontime">08:00</span>
                            </td>
                            <td>
                                <span class="badge badge-ontime">08:00</span>
                            </td>
                            <td>
                                <span class="badge badge-no-data">-</span>
                            </td>
                            <td>
                                <span class="badge badge-late">08:00</span>
                            </td>
                            <td>
                                <span class="badge badge-late">08:00</span>
                            </td>
                            <td>
                                <span class="badge badge-ontime">08:00</span>
                            </td>
                            <td>
                                <center>
                                    <div class='dropdown'>
                                        <button class='btn btn-light btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='true'>
                                            <i class='uil uil-ellipsis-h'></i>
                                        </button>
                                        <ul class='dropdown-menu dropdown-menu-end'>
                                            <li><a class='dropdown-item edit' href='$editUrl'>Edit</a></li>
                                            <li><a class='dropdown-item delete' href='javascript:void(0);' data-url='$deleteUrl'>Delete</a></li>
                                        </ul>
                                    </div>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table><!-- end table -->
            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    {{-- CHART HEADER  --}}
    <!-- Chart code -->
    <script>
        am5.ready(function() {
            // Chart configurations
            const chartConfigs = [{
                    id: "chart-attendance",
                    data: [{
                        value: 10,
                        category: "Present"
                    }, {
                        value: 5,
                        category: "Absent"
                    }]
                },
                {
                    id: "chart-tardiness",
                    data: [{
                        value: 8,
                        category: "On Time"
                    }, {
                        value: 7,
                        category: "Late"
                    }]
                },
                {
                    id: "chart-overtime",
                    data: [{
                        value: 12,
                        category: "Regular Hours"
                    }, {
                        value: 3,
                        category: "Overtime"
                    }]
                },
                {
                    id: "chart-permission",
                    data: [{
                        value: 9,
                        category: "Approved"
                    }, {
                        value: 6,
                        category: "Pending"
                    }]
                }
            ];

            // Loop through each chart configuration and create a pie chart
            chartConfigs.forEach(config => {
                // Create root element
                var root = am5.Root.new(config.id);

                // Set themes
                root.setThemes([
                    am5themes_Animated.new(root)
                ]);

                // Create chart
                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                    layout: root.verticalLayout,
                    innerRadius: am5.percent(50)
                }));

                // Create series
                var series = chart.series.push(am5percent.PieSeries.new(root, {
                    valueField: "value",
                    categoryField: "category",
                    alignLabels: false
                }));

                // Disable the labels
                series.labels.template.setAll({
                    forceHidden: true
                });

                // Set data
                series.data.setAll(config.data);

                // Enable tooltips
                series.slices.template.set("tooltipText", "{category}: {value}");

                // Play initial series animation
                series.appear(1000, 100);
            });
        }); // end am5.ready()
    </script>


    <script>
        $(document).ready(function() {
            $('#customer-table').DataTable({ });
        });

        // Delete action
        $(document).on('click', '.delete', function() {
            var url = $(this).data('url');
            Swal.fire({
                title: 'Are you sure you want to delete this data?',
                text: "Deleted data cannot be returned!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.success,
                                    'success'
                                )
                                $('#pelanggan-table').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.error,
                                    'error'
                                )
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
