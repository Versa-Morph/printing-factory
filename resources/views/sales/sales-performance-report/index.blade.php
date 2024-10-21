@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .text-heading {
            font-weight: 700;
            margin-bottom: 2% !important;
        }

        .btn.dropdown-toggle {
            border-radius: 16px !important;
            border-color: transparent !important;
        }

        .badge-ontime {
            color: rgba(160, 219, 93, 1) !important;
            background: rgba(160, 219, 93, 0.1) !important;
            padding: 16px;
            width: 91%;
            font-weight: 700;
        }

        .badge-late {
            color: rgba(219, 93, 93, 1);
            background: rgba(219, 93, 93, 0.1);
            padding: 16px;
            width: 91%;
            font-weight: 700;
        }

        .badge-no-data {
            color: black;
            background: #e6e6e686;
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
                                                <p class="text-white-50 mb-2 text-truncate">Quotation</p>
                                                <h3 class="text-white mb-0">{{ $quotation_count }}</h3>
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
                                                <p class="text-white-50 mb-2 text-truncate">Customer</p>
                                                <h3 class="text-white mb-0">{{ $customer_count }}</h3>
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
                                                <p class="text-white-50 mb-2 text-truncate">Order</p>
                                                <h3 class="text-white mb-0">{{ $order_count }}</h3>
                                            </div>
                                            <div class="col-lg-6">
                                                <div id="chart-overtime" style="width: 100%; height: 100px;"></div>
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
                        <th>No</th>
                        <th>Quotation Number</th>
                        <th>Company Code</th>
                        <th>Product Type</th>
                        <th>Material Detail</th>
                        <th>Thickness</th>
                        <th>Po Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotations as $item)
                        <tr>
                            <td><span>{{ $loop->iteration  }}</span></td>
                            <td><span>{{ $item->quotation_number  }}</span></td>
                            <td><span>{{ $item->company_code  }}</span></td>
                            <td><span>{{ $item->product_type  }}</span></td>
                            <td><span>{{ $item->material_detail  }}</span></td>
                            <td><span>{{ $item->thickness  }}</span></td>
                            <td><span>{{ $item->po_number  }}</span></td>
                            
                        </tr>
                    @endforeach
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
            // Chart configurations for Sales Performance
            const chartConfigs = [{
                    id: "chart-attendance", // Update the chart ID if needed
                    data: [{
                        value: {{ $quotation_count }},
                        category: "Quotations"
                    }]
                },
                {
                    id: "chart-tardiness", // Update the chart ID if needed
                    data: [{
                        value: {{ $customer_count }},
                        category: "Customers"
                    }]
                },
                {
                    id: "chart-overtime", // Update the chart ID if needed
                    data: [{
                        value: {{ $order_count }},
                        category: "Orders"
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
@endsection
