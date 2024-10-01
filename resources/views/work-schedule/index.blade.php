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
        .badge-success{
            color: rgba(160, 219, 93, 1) !important;
            background: rgba(160, 219, 93, 0.1) !important;
            padding: 16px;
            width: 62%;
            font-weight: 700;
        }
        .badge-primary{
            color: rgba(93, 106, 219, 1);
            background: rgba(93, 106, 219, 0.1);
            padding: 16px;
            width: 62%;
            font-weight: 700;
        }
        .badge-danger{
            color: rgba(219, 93, 93, 1);
            background: rgba(219, 93, 93, 0.1);
            padding: 16px;
            width: 62%;
            font-weight: 700;
        }
        .badge-no-data{
            color: black;
            background: rgba(0, 0, 0, 0.1);
            padding: 16px;
            width: 62%;
            font-weight: 700;
        }
        .btn-create{
            background: rgba(79, 86, 211, 1);
            color: white;
            font-weight: 600;
            float: right
        }
    </style>
@endsection

@section('content')
    <div class="card br-20">
        <div class="card-body px-0">
            <div class="row align-items-start">
                <div class="col-sm d-flex justify-content-between align-items-center">
                    <div class="ms-3">
                        <h4 class="pb-0 mb-0">Work Schedule</h4>
                        {{-- <h5 class="text-secondary">Week 9 ( 26 February 2024 - 1 March 2024)</h5> --}}
                    </div>

                    {{-- @can('create-employee-salary') --}}
                    <div>
                        {{-- <a href="#" class="btn btn-light me-3"><i class="mdi mdi-plus me-1"></i> Create Work Schedule</a> --}}
                    </div>
                    {{-- @endcan --}}
                </div>
            </div>

            <hr>
            <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="work-schedule-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No</th>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Shift</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table><!-- end table -->
            </div>
            {{-- <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="customer-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span>26 February 2024</span>
                            </td>
                            <td>
                                <span class="badge badge-success">Shift 1</span>
                            </td>
                            <td>
                                <span class="badge badge-success">11:20</span>
                            </td>
                            <td>
                                <span class="badge badge-success">16:13</span>
                            </td>
                            <td>
                                <span>Description123</span>
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
                        <tr>
                            <td>
                                <span>27 February 2024</span>
                            </td>
                            <td>
                                <span class="badge badge-primary">Shift 2</span>
                            </td>
                            <td>
                                <span class="badge badge-success">11:20</span>
                            </td>
                            <td>
                                <span class="badge badge-success">16:13</span>
                            </td>
                            <td>
                                <span>Description123</span>
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
                        <tr>
                            <td>
                                <span>28 February 2024</span>
                            </td>
                            <td>
                                <span class="badge badge-danger">Shift 3</span>
                            </td>
                            <td>
                                <span class="badge badge-success">11:20</span>
                            </td>
                            <td>
                                <span class="badge badge-success">16:13</span>
                            </td>
                            <td>
                                <span>Description123</span>
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
            </div> --}}
        </div><!-- end card-body -->
    </div><!-- end card -->
@endsection

@section('script')
<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        var today = new Date().toISOString().split('T')[0];
        $('#work-schedule-table').DataTable({
            processing: false,
            serverSide: false,
            ajax: '{{ route('work-schedule-get-data-by-id') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'date', name: 'date' },
                { data: 'employee_name', name: 'employee_name' },
                { data: 'shift', name: 'shift' },
                { data: 'clock_in', name: 'clock_in' },
                { data: 'clock_out', name: 'clock_out' },
            ],
            rowCallback: function(row, data) {
                // Jika tanggal di data sama dengan hari ini
                if (data.date === today) {
                    // Tambahkan warna ke semua <td> dalam baris
                    $('td', row).each(function() {
                        $(this).addClass('highlight-today');
                    });
                }
            }
        });
});
</script>
@endsection
