@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row align-items-start">
                <div class="col-sm">
                    @can('create-employee-salary')
                    <div>
                        <a href="{{ route('employee-salary-create') }}" class="btn btn-light mb-4 bg-primary text-light"><i class="mdi mdi-plus me-1"></i> Create Salary</a>
                    </div>
                    @endcan
                </div>
            </div>

            <div class="table-responsive mt-4 mt-sm-0">
                <table class="table align-middle table-nowrap table-check" id="employee-salary-table">
                    <thead>
                        <tr class="bg-transparent">
                            <th>No</th>
                            <th>Employee Name</th> <!-- Updated column name -->
                            <th>Payment Method</th>
                            <th>Rekening Number</th>
                            <th>Working Days</th>
                            <th>Overtime Per Hour</th>
                            <th>Additional Overtime</th>
                            <th>Basic Salary</th>
                            <th>Transportation Incentive</th>
                            <th>Daily Incentive</th>
                            <th>Position Incentive</th>
                            <th>BPJS Kesehatan Base</th>
                            <th>BPJS Kesehatan Employee</th>
                            <th>BPJS Kesehatan Employer</th>
                            <th>BPJS Ketenagakerjaan Base</th>
                            <th>BPJS Ketenagakerjaan Employee</th>
                            <th>BPJS Ketenagakerjaan Employer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table><!-- end table -->
            </div>
        </div><!-- end card-body -->
    </div><!-- end card -->

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#employee-salary-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employee-salary-get-data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'employee.first_name', name: 'employee.first_name' },
                    { data: 'payment_method', name: 'payment_method' },
                    { data: 'rekening_number', name: 'rekening_number' },
                    { data: 'working_days', name: 'working_days' },
                    { data: 'overtime_per_hour', name: 'overtime_per_hour' },
                    { data: 'additional_overtime', name: 'additional_overtime' },
                    { data: 'basic_salary', name: 'basic_salary' },
                    { data: 'transportation_incentive', name: 'transportation_incentive' },
                    { data: 'daily_incentive', name: 'daily_incentive' },
                    { data: 'position_incentive', name: 'position_incentive' },
                    { data: 'bpjs_kesehatan_base', name: 'bpjs_kesehatan_base' },
                    { data: 'bpjs_kesehatan_employee', name: 'bpjs_kesehatan_employee' },
                    { data: 'bpjs_kesehatan_employer', name: 'bpjs_kesehatan_employer' },
                    { data: 'bpjs_ketenagakerjaan_base', name: 'bpjs_ketenagakerjaan_base' },
                    { data: 'bpjs_ketenagakerjaan_employee', name: 'bpjs_ketenagakerjaan_employee' },
                    { data: 'bpjs_ketenagakerjaan_employer', name: 'bpjs_ketenagakerjaan_employer' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
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
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.msg,
                                    'success'
                                );
                                $('#employee-salary-table').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.msg,
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
